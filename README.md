# .Net

The Nuget Package for the UPS Widget Token Generation SDK can be found in the `Packages` section on the right, or at [this](https://github.com/UPS-API/Widgets-SDK/pkgs/nuget/UpsWidgetSdk) url.

# Using the Token Generation Library

Two setup steps are needed to utilize this SDK.
- First, add the UPS GitHub as a Nuget Package Source. 
  `dotnet nuget add source https://nuget.pkg.github.com/ups-api/index.json --name <SOURCE_NAME> --username <USER>
    --password <PASSWORD>`
dotnet add package UpsWidgetSdk --version 1.0.1
