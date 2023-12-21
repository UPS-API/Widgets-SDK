# .Net

The Nuget Package for the UPS Widget Token Generation SDK can be found in the `Packages` section on the right, or at [this](https://github.com/UPS-API/Widgets-SDK/pkgs/nuget/UpsWidgetSdk) url.

## Using the Token Generation Library

Two setup steps are needed to utilize this SDK.
- First, add the UPS GitHub as a Nuget Package Source by using the command below. For more information about adding Nuget Package sources, refer for the [documentation](https://learn.microsoft.com/en-us/dotnet/core/tools/dotnet-nuget-add-source).
  
  `dotnet nuget add source https://nuget.pkg.github.com/ups-api/index.json --name <SOURCE_NAME> --username <USER>
    --password <PASSWORD>`
- Second, include the package in your project by using the command below.

  `dotnet add package UpsWidgetSdk --version 1.0.1`

Once the package is added and installed, you will be able to use the `GetToken` class and call the `GenerateToken` method.

# GetToken Class
## Definition
