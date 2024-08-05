# Node.Js

The Node.Js Package for the UPS Widget Token Generation SDK can be found in the `Packages` section on the right, or at [this](https://github.com/UPS-API/Widgets-SDK/pkgs/npm/dapwidgets-node-sdk) url.

## Using the Token Generation Library

You can utilize this SDK by performing one of the following steps:
- Install the package by using the command below:
  
  `npm install @ups-api/dapwidgets-node-sdk@1.0.0`
  
- Install via package.json:

  `"@ups-api/dapwidgets-node-sdk": "1.0.0"`

Once the package is added and installed, you will be able to use the `AuthTokengenerator` class and call the `getToken` method.

# AuthTokengenerator Class
## Definition

Provides a class for generating an OAuth token to use with UPS Widgets.
```Javascript
class AuthTokengenerator
```

## Constructors

| Definition | Description |
|------------|-------------|
| AuthTokengenerator(config: AuthConfig) | Initializes a new instance of the AuthTokengenerator class |

## Methods
| Definition | Description |
|------------|-------------|
| getToken() | Returns a token. |
| getToken(body?, headers?) | Returns a token using optional, additional body or header data. |

## Example

```Javascript
clientId: string = credentialManager.getCredential("ClientId");
clientSecret: string = credentialManager.getCredential("ClientSecret");

let headers: Record<string, string> = {};
headers["HEADER_NAME"] = "HEADER_VALUE";

let body: Record<string, string> = {};
body["PROPERY_NAME"] = "PROPERTY_VALUE";

const tokenService: AuthTokengenerator = new AuthTokengenerator({
  clientId: clientId, clientSecret: clientSecret
  });

function example() {
  tokenService.generateToken(headers, body).then((response) => {
    console.log(response);
  });
}
```

<br>  

# AuthConfig Type
## Definition

Provides a configuration for the AuthTokengenerator class.
```Javascript
type AuthConfig
```

## Properties

| Name | Type |
|------|------|
| clientId | string |
| clientSecret | string |

## Example

```Javascript
{
  clientId = "<YOUR_CLIENT_ID>"
  clientSecret = "<YOUR_CLIENT_SECRET>"
}
```
