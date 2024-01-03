# PHP

You can find the UPS Widget Token Generation packagist link [here](https://packagist.org/packages/ups-api/php-widget-sdk). Be sure to use the latest version.

## Using the Token Generation Library

Steps needed to utilize this package.
- First, copy this composer command `composer require ups-api/php-widget-sdk`.
- Next, navigate to the root of your app or website.
- Finally, run the copied composer command. This will include the necessary files to utilize the package.

Once the package is added and installed, you will be able to use the `UPSSDK` class and call the `generateToken` method.

# UPSSDK Class
## Definition

Provides a class for generating an OAuth token to use with UPS Widgets.
```PHP
class UPSSDK
```

## Constructors

| Definition | Description |
|------------|-------------|
| UPSSDK() | Initializes a new instance of the UPSSDK class |

## Parameters

| Definition | Description |
|------------|-------------|
| $clientId | Your Client Id found in the UPS Developer portal |
| $clientSecret | Your Client Secret found in the UPS Developer portal |
| $headers | An associative `array` of `string => string` |
| $postData | An associative `array` of `string => string` |
| $queryParams | An associative `array` of `string => string` |

## Methods

| Definition | Description |
|------------|-------------|
| generateToken($clientId, $clientSecret) | Returns a token using only the provided id and secret |
| generateToken($clientId, $clientSecret, $headers) | Returns a token using the provided id, secret, and additional request headers. |
| generateToken($clientId, $clientSecret, null, $postData) | Returns a token using the provided id, secret, and additional request body properties|
| generateToken($clientId, $clientSecret, $headers, $postData) | Returns a token using the provided id, secret, additional request headers, and additional requesty body properties |
| generateToken($clientId, $clientSecret, $headers, $postData, $queryParams) | Returns a token using the provided id, secret, additional request headers, additional requesty body properties, and additional query parameters |

## Example

```PHP
$clientId = "YOUR_CLIENT_ID";
$clientSecret = "YOUR_CLIENT_SECRET";
$headers = array("HEADER_KEY" => "HEADER_VALUE");
$postData = array("PROPERTY_NAME" => "PROPERTY_VALUE");
$tokenService = new UPSSDK();

public function exampleTokenMethod() {
  $response = $tokenService.generateToken($clientId, $clientSecret, $headers, $postData);
  echo $response;
}
```

## Notes

- Arrays must be associative arrays.
