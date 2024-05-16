# Go

You can find the UPS Widget Token Generation for Go programing language here.

## Using the Token Generation Library

need to utilize this package.
- First, download token_generation.go from this repository. Add the file to your project under `your-project/ups/token_generation.go`
- Import the `ups` package and start using.

Once the package is added you will be able to use `ups.GenerateToken()` to request an oauth token from UPS.

## Parameters

| Definition | Description |
|------------|-------------|
| clientID | Your Client Id found in the UPS Developer portal |
| clientSecret | Your Client Secret found in the UPS Developer portal |
| additionalHeaders | A `map` of `[string]string` |
| postData | A `map` of `[string]string` |

## Funcs

| Definition | Description |
|------------|-------------|
| GenerateToken(clientId, clientSecret, headers, postData, queryParams) | Returns a token using the provided id, secret, additional request headers, additional requesty body properties, and additional query parameters |

## Example

```GO
clientId := "YOUR_CLIENT_ID";
clientSecret := "YOUR_CLIENT_SECRET";
headers := make(map[string]string)
headers["HEADER_KEY"] = "HEADER_VALUE"
postData := make(map[string]string)
postData["PROPERTY_NAME"] = "PROPERTY_VALUE"

response, err := TokenGeneration.GenerateToken(context.Background(), clientId, clientSecret, headers, postData)
```
