# Python

The source for our Python SDK is available in this repo.

## Using the Token Generation Library

Two setup steps are needed to utilize this SDK.
- First, download the files in this repository and include them in your project.
- Second, include the package in your project.

  `from TokenGenerationLibrary.GetToken import generateToken`

Once the package is added and imported, you will be able to call the `generateToken` method.

# GetToken File
## Definition

Provides a method for generating an OAuth token to use with UPS Widgets.
```Python
def generateToken(clientId, clientSecret, headers, postData, queryParams)
```

## Methods
| Definition | Description |
|------------|-------------|
| generateToken(clientId, clientSecret, headers, postData, queryParams) | Returns a token using the provided data. |

## Example

```Python
myId = "YOUR_CLIENT_ID"
mySecret = "YOUR_CLIENT_SECRET"
headers = {
  { "HEADER_NAME": "HEADER_VALUE" }
}
body = {
  { "PROPERY_NAME": "PROPERTY_VALUE" }
}

def exampleUsage():
  response = generateToken(clientId= myId, clientSecret= mySecret, headers= headers, postData= body, queryParams= None)
  print(response)
```
