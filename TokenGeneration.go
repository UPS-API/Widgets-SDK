package main

import (
	b64 "encoding/base64"
	"encoding/json"
	"errors"
	"fmt"
	"io"
	"net/http"
	"net/url"
	"strings"
)

func GenerateToken(clientId string, clientSecret string, headers map[string]string, postData map[string]string, querryParams map[string]string) (string, error) {

	if clientId == "" || clientSecret == "" {
		return "", errors.New(errMsg("DTG002"))
	}
	data := clientId + ":" + clientSecret

	posturl := "https://onlinetools.ups.com/security/v1/oauth/token"

	body := url.Values{}
	body.Add("grant_type", "client_credentials")
	body.Add("scope", "public")

	for keys := range postData {
		claim := "{\"" + keys + "\":\"" + postData[keys] + "\"}"
		fmt.Println(claim)
		body.Add("custom_claims", claim)
		fmt.Println(body)
	}
	encodedData := body.Encode()

	r, err := http.NewRequest(http.MethodPost, posturl, strings.NewReader(encodedData))
	r.Header.Set("Content-Type", "application/x-www-form-urlencoded")
	r.Header.Set("Authorization", "Basic "+b64.StdEncoding.EncodeToString([]byte(data)))

	for keys := range headers {
		r.Header.Set(keys, headers[keys])
	}

	if err != nil {
		panic(err)
	}

	client := &http.Client{}
	res, err := client.Do(r)
	if err != nil {
		panic(err)
	}

	defer res.Body.Close()

	response, err := io.ReadAll(res.Body)
	if err != nil {
		return "", err
	}

	if !(res.StatusCode >= 200 && res.StatusCode <= 299) {
		var errors1 Error
		if err := json.Unmarshal(response, &errors1); err != nil {
			panic("Can not unmarshaled JSON")
		}
		if strings.Contains(string(response), "ClientId is Invalid") {
			return "", errors.New(errMsg("DTG001"))
		} else if strings.Contains(string(response), "grant") {
			return "", errors.New(errMsg("DTG003"))
		} else if strings.Contains(string(response), "redirect") {
			return "", errors.New(errMsg("DTG004"))
		} else if strings.Contains(string(response), "Authorization Code") {
			return "", errors.New(errMsg("DTG005"))
		} else if strings.Contains(string(response), "Authorization Header") {
			return "", errors.New(errMsg("DTG006"))
		} else if strings.Contains(string(response), "quota") {
			return "", errors.New(errMsg("DTG007"))
		} else if strings.Contains(string(response), "Client credentials are invalid") {
			return "", errors.New(errMsg("DTG008"))
		} else {
			return "", errors.New("{\"response\":{\"errors\":[{\"code\":\"DTG009\",\"message\":\"" + string(response) + "\"}]}}")
		}
	}

	var result Post
	if err := json.Unmarshal(response, &result); err != nil {
		fmt.Println("Can not unmarshaled JSON")
	}

	return result.AccessToken, nil
}

func errMsg(errCode string) string {

	msg := "{\"response\":{\"errors\":[{\"code\":\"" + errCode + "\",\"message\":\"Token generation has encountered an error. Please contact your UPS Relationship Manager.\"}]}}"
	return msg
}

type Post struct {
	TokenType   string `json:"token_type"`
	IssuedAt    string `json:"issued_at"`
	ClientID    string `json:"client_id"`
	AccessToken string `json:"access_token"`
	ExpiresIn   string `json:"expires_in"`
	Status      string `json:"status"`
}

type Error struct {
	Response struct {
		Errors []struct {
			Code    string `json:"code"`
			Message string `json:"message"`
		} `json:"errors"`
	} `json:"response"`
}
