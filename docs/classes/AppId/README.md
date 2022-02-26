[Documentation](../../README.md) > **AppId**

# The `Nelexa\GPlay\Model\AppId` class

## Introduction
Contains the application ID, as well as the locale and country for which the information was or will be obtained.

This class is the base class for [Nelexa\GPlay\Model\App](../App/README.md) and [Nelexa\GPlay\Model\AppInfo](../AppInfo/README.md).

## Class synopsis
```php
Nelexa\GPlay\Model\AppId {

    /* Methods */
    public __construct ( string $id [, string $locale = "en_US" ] [, string $country = "us" ] ) 
    public getId ( void ) : string
    public getLocale ( void ) : string
    public getCountry ( void ) : string
    public getUrl ( void ) : string
    public getFullUrl ( void ) : string
}
```

## Table of Contents
* [Nelexa\GPlay\Model\AppId::__construct](appid.__construct.md) - Creates an \Nelexa\GPlay\Model\AppId object.
* [Nelexa\GPlay\Model\AppId::getId](appid.getid.md) - Returns the application ID (android package name).
* [Nelexa\GPlay\Model\AppId::getLocale](appid.getlocale.md) - Returns the locale (site language) for which the information was received.
* [Nelexa\GPlay\Model\AppId::getCountry](appid.getcountry.md) - Returns the country of the request for information about the application.
* [Nelexa\GPlay\Model\AppId::getUrl](appid.geturl.md) - Returns the URL of the application page in the Google Play store.
* [Nelexa\GPlay\Model\AppId::getFullUrl](appid.getfullurl.md) - Returns the full URL of the app's page on Google Play, specifying the locale and country of the request.


## See Also
* [Nelexa\GPlay\Model\App](../App/README.md) - Contains basic information about the application from the Google Play store.
* [Nelexa\GPlay\Model\AppInfo](../AppInfo/README.md) - Contains detailed information about the application from the Google Play store.
## Sample object content
```php
class Nelexa\GPlay\Model\AppId {
  -getId(): string: "jp.co.ofcr.cm00"
  -getLocale(): string: "en_US"
  -getCountry(): string: "us"
  -getUrl(): string: "https://play.google.com/store/apps/details?id=jp.co.ofcr.cm00"
  -getFullUrl(): string: "https://play.google.com/store/apps/details?id=jp.co.ofcr.cm00&hl=en_US&gl=us"
}
```

[Documentation](../../README.md) > **AppId**
