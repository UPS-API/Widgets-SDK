# Widgets-SDK
This repository will host SDKs that help you generate an OAuth Token to use with Widgets developed by UPS.

# FAQ
> Which technologies are supported by UPS?
- UPS currently has developed SDKs for .Net (6.0). A script for PHP is also available.

> How does my team use your SDK?
- Find your supported technology in the [branches]([url](https://github.com/UPS-API/Widgets-SDK/branches)https://github.com/UPS-API/Widgets-SDK/branches) section. Follow the instructions in the ReadMe for your specific implementation.

> How long does a token last?
- A successfully created token is valid for four(4) hours. Within the token, there is a property called `refresh_token_expires_in` which can be used to calculate remaining time.
