# Widgets-SDK
This repository will host SDKs that help you generate an OAuth Token to use with Widgets developed by UPS.

# FAQ
> Which technologies are supported by UPS?
- UPS currently has developed SDKs for .Net (6.0). A script for PHP is also available.

> How does my team use your SDK?
- Find your supported technology in the [branches]([url](https://github.com/UPS-API/Widgets-SDK/branches)https://github.com/UPS-API/Widgets-SDK/branches) section. Follow the instructions in the ReadMe for your specific implementation.

> How long does a token last?
- A successfully created token is valid for four(4) hours. Within the token, there is a property called `refresh_token_expires_in` which can be used to calculate remaining time.

> What does a token look like?
- A valid token is represented by a string of random characters (max 1000).

> How do I create a token?
- The SDKs expose `generateToken()` which can be used to get a token. `generateToken()` requires two strings: `clientId` and `clientSecret`. Other configurable parameters include `headers`, `postData`, and `queryParams`.

> How do I get a Client Id and a Client Secret?
- Register on the [UPS Developer Portal]([url](https://developer.ups.com/)https://developer.ups.com/). Follow the steps to onboard and get an id and secret.


# Errors
