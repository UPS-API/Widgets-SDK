# Java - Maven

The Maven Package for the UPS Widget Token Generation SDK can be found in the `Packages` section on the right, or at [this]([https://github.com/UPS-API/Widgets-SDK/pkgs/maven/](https://github.com/UPS-API/Widgets-SDK/packages/2066903)) url.

## Using the Token Generation Library

Two setup steps are needed to utilize this SDK.
- First, add the package as a dependency in your POM.xml file.
  
  `<dependency>
	<groupId>DAPWidgets</groupId>
  	<artifactId>java-sdk</artifactId>
	<version>1.0.0</version>
</dependency>`
- Second, install packages by running the following command

  `mvn install`

# JwtService Class
## Definition

Provides a class for generating an OAuth token to use with UPS Widgets.
```Java
public class JwtService
```

## Constructors

| Definition | Description |
|------------|-------------|
| JwtService() | Initializes a new instance of the JwtService class |

## Methods
| Definition | Description |
|------------|-------------|
| generateToken(string, string) | Returns a token using only the provided id and secret |
| generateToken(string, string, Dictionary<string, string>) | Returns a token using the provided id, secret, and additional request headers. |
| generateToken(string, string, null, Dictionary<string, string>) | Returns a token using the provided id, secret, and additional request body properties|
| generateToken(string, string, Dictionary<string, string>, Dictionary<string, string>) | Returns a token using the provided id, secret, additional request headers, and additional requesty body properties |
| generateToken(string, string, Dictionary<string, string>, Dictionary<string, string>, Dictionary<string, string>) | Returns a token using the provided id, secret, additional request headers, additional requesty body properties, and additional query parameters |

## Example

```Java
String clientId = "YOUR_CLIENT_ID";
String clientSecret = "YOUR_CLIENT_SECRET";
Dictionary<string, string> headers = new Hashtable<string, string>();
headers.put("HEADER_NAME", "HEADER_VALUE");
private Dictionary<string, string> body = new Hashtable<string, string>();
body.put("PROPERTY_NAME", "PROPERTY_VALUE");

private JwtService tokenService = new JwtService();

public void ExampleTokenMethod() {
  string response = tokenService.GenerateToken(clientId, clientSecret, headers, body);
  System.out.println(response);
}
```
