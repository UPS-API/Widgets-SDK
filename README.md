# .Net

The Nuget Package for the UPS Widget Token Generation SDK can be found in the `Packages` section on the right, or at [this](https://github.com/UPS-API/Widgets-SDK/pkgs/nuget/UpsWidgetSdk) url.

## Using the Token Generation Library

Two setup steps are needed to utilize this SDK.
- First, add the UPS GitHub as a Nuget Package Source by using the command below. For more information about adding Nuget Package sources, refer for the [documentation](https://learn.microsoft.com/en-us/dotnet/core/tools/dotnet-nuget-add-source).
  
  `dotnet nuget add source https://nuget.pkg.github.com/ups-api/index.json --name <SOURCE_NAME> --username <USER>
    --password <PASSWORD>`
- Second, include the package in your project by using the command below.

  `dotnet add package DAPWidgets-dotnet-sdk --version 1.0.3`

Once the package is added and installed, you will be able to use the `GetToken` class and call the `GenerateToken` method.

# GetToken Class
## Definition

Provides a class for generating an OAuth token to use with UPS Widgets.
```C#
public class GetToken
```

## Constructors

| Definition | Description |
|------------|-------------|
| GetToken() | Initializes a new instance of the GetToken class |

## Methods
| Definition | Description |
|------------|-------------|
| GenerateToken(string, string) | Returns a token using only the provided id and secret |
| GenerateToken(string, string, Dictionary<string, string>) | Returns a token using the provided id, secret, and additional request headers. |
| GenerateToken(string, string, null, Dictionary<string, string>) | Returns a token using the provided id, secret, and additional request body properties|
| GenerateToken(string, string, Dictionary<string, string>, Dictionary<string, string>) | Returns a token using the provided id, secret, additional request headers, and additional requesty body properties |
| GenerateToken(string, string, Dictionary<string, string>, Dictionary<string, string>, Dictionary<string, string>) | Returns a token using the provided id, secret, additional request headers, additional requesty body properties, and additional query parameters |

## Example

```C#
string clientId = CredentialManager.GetCredential("ClientId");
string clientSecret = CredentialManager.GetCredential("ClientSecret");
private Dictionary<string, string> headers = new Dictionary<string, string>()
{
  { "HEADER_NAME", "HEADER_VALUE" }
};
private Dictionary<string, string> body = new Dictionary<string, string>()
{
  { "PROPERY_NAME", "PROPERTY_VALUE" }
};
private GetToken tokenService = new GetToken();

public void ExampleTokenMethod() {
  string response = tokenService.GenerateToken(clientId, clientSecret, headers, body);
  Console.WriteLine(response);
}
```
