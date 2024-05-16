package ups
// If ups decides to publish this as a go gettable package.
// package github.com/UPS-API/Widgets-SDK

import (
	"context"
	"encoding/json"
	"fmt"
	"io"
	"net/http"
	"net/url"
	"strings"
	"time"
)

// oauthHTTPClient is an http oauthHTTPClient used for oauth requests.
var oauthHTTPClient = &http.Client{
	Timeout: time.Second * 30,
	Transport: &http.Transport{
		// Set default timeouts
		TLSHandshakeTimeout:   time.Second * 10,
		IdleConnTimeout:       time.Second * 30,
		ResponseHeaderTimeout: time.Second * 30,
		ExpectContinueTimeout: time.Second * 30,
	},
}

// tokenEndpoint is the endpoint used to generate UPS oauth tokens.
const tokenEndpoint = "https://onlinetools.ups.com/security/v1/oauth/token"

// GenerateToken requests an Oauth Token from UPS.
// Returns an oauth token or an error.
// additionalHeaders and postData are optional additional data to send in the request.
func GenerateToken(
	ctx context.Context,
	clientID string,
	clientSecret string,
	additionalHeaders map[string]string,
	postData map[string]string,
) (string, error) {
	if clientID == "" || clientSecret == "" {
		return "", newTokenGenerationError("DTG002")
	}

	body := url.Values{}
	body.Set("grant_type", "client_credentials")
	body.Set("scope", "public")

	for keys := range postData {
		body.Add(keys, postData[keys])
	}
	encodedData := body.Encode()

	req, err := http.NewRequestWithContext(ctx, http.MethodPost, tokenEndpoint, strings.NewReader(encodedData))
	if err != nil {
		return "", fmt.Errorf("error creating request: %w", err)
	}

	req.SetBasicAuth(clientID, clientSecret)
	req.Header.Set("Content-Type", "application/x-www-form-urlencoded")

	for keys := range additionalHeaders {
		req.Header.Set(keys, additionalHeaders[keys])
	}

	res, err := oauthHTTPClient.Do(req)
	if err != nil {
		return "", fmt.Errorf("error executing request: %w", err)
	}
	defer res.Body.Close()

	response, err := io.ReadAll(res.Body)
	if err != nil {
		return "", fmt.Errorf("error reading http response body: %w", err)
	}

	if !(res.StatusCode >= 200 && res.StatusCode <= 299) {
		var errors1 oauthTokenError
		if err := json.Unmarshal(response, &errors1); err != nil {
			return "", fmt.Errorf("error decoding response: %w", err)
		}

		respStr := string(response)

		if strings.Contains(respStr, "ClientId is Invalid") {
			return "", newTokenGenerationError("DTG001")
		} else if strings.Contains(respStr, "grant") {
			return "", newTokenGenerationError("DTG003")
		} else if strings.Contains(respStr, "redirect") {
			return "", newTokenGenerationError("DTG004")
		} else if strings.Contains(respStr, "Authorization Code") {
			return "", newTokenGenerationError("DTG005")
		} else if strings.Contains(respStr, "Authorization Header") {
			return "", newTokenGenerationError("DTG006")
		} else if strings.Contains(respStr, "quota") {
			return "", newTokenGenerationError("DTG007")
		} else if strings.Contains(respStr, "Client credentials are invalid") {
			return "", newTokenGenerationError("DTG008")
		}

		return "", fmt.Errorf("%s: %s", respStr, "DTG009")
	}

	var result oauthTokenResponse

	if err := json.Unmarshal(response, &result); err != nil {
		return "", fmt.Errorf("error unmarshaling token response: %w", err)
	}

	return result.AccessToken, nil
}

// newTokenGenerationError creates a token generation error mesasge.
// errCode is a UPS error code to append to the end.
func newTokenGenerationError(errCode string) error {
	return fmt.Errorf("token generation has encountered an error. Please contact your UPS Relationship Manager: %s", errCode)
}

// oauthTokenResponse is the token response from UPS.
type oauthTokenResponse struct {
	TokenType   string `json:"token_type"`
	IssuedAt    string `json:"issued_at"`
	ClientID    string `json:"client_id"`
	AccessToken string `json:"access_token"`
	ExpiresIn   string `json:"expires_in"`
	Status      string `json:"status"`
}

// oauthTokenError is an error response during token generation from UPS.
type oauthTokenError struct {
	Response struct {
		Errors []struct {
			Code    string `json:"code"`
			Message string `json:"message"`
		} `json:"errors"`
	} `json:"response"`
}
