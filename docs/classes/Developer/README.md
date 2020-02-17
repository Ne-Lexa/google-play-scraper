[Documentation](../../README.md) > **Developer**

# The `Nelexa\GPlay\Model\Developer` class

## Introduction
Contains data on the application developer in the Google Play store.

## Class synopsis
```php
Nelexa\GPlay\Model\Developer implements JsonSerializable {

    /* Methods */
    public getId ( void ) : string
    public getUrl ( void ) : string
    public getName ( void ) : string
    public getDescription ( void ) : string | null
    public getWebsite ( void ) : string | null
    public getIcon ( void ) : Nelexa\GPlay\Model\GoogleImage | null
    public getCover ( void ) : Nelexa\GPlay\Model\GoogleImage | null
    public getEmail ( void ) : string | null
    public getAddress ( void ) : string | null
    public asArray ( void ) : array
    public jsonSerialize ( void ) : mixed
}
```

## Table of Contents
* [Nelexa\GPlay\Model\Developer::getId](developer.getid.md) - Returns developer id.
* [Nelexa\GPlay\Model\Developer::getUrl](developer.geturl.md) - Returns the URL of the developer’s page in Google Play.
* [Nelexa\GPlay\Model\Developer::getName](developer.getname.md) - Returns the name of the developer.
* [Nelexa\GPlay\Model\Developer::getDescription](developer.getdescription.md) - Returns a description of the developer.
* [Nelexa\GPlay\Model\Developer::getWebsite](developer.getwebsite.md) - Returns the developer's website.
* [Nelexa\GPlay\Model\Developer::getIcon](developer.geticon.md) - Returns the developer icon.
* [Nelexa\GPlay\Model\Developer::getCover](developer.getcover.md) - Returns the developer cover.
* [Nelexa\GPlay\Model\Developer::getEmail](developer.getemail.md) - Returns developer email.
* [Nelexa\GPlay\Model\Developer::getAddress](developer.getaddress.md) - Returns the address of the developer.
* [Nelexa\GPlay\Model\Developer::asArray](developer.asarray.md) - Returns class properties as an array.
* [Nelexa\GPlay\Model\Developer::jsonSerialize](developer.jsonserialize.md) - Specify data which should be serialized to JSON.


## See Also
* [Nelexa\GPlay\GPlayApps::getDeveloperInfo()](../GPlayApps/gplayapps.getdeveloperinfo.md) - Returns information about the developer: name, icon, cover, description and website address.
* [Nelexa\GPlay\GPlayApps::getDeveloperInfoForLocales()](../GPlayApps/gplayapps.getdeveloperinfoforlocales.md) - Returns information about the developer for the locale array.
* [Nelexa\GPlay\GPlayApps::getAppInfo()](../GPlayApps/gplayapps.getappinfo.md) - Returns detailed information about the Android application from the Google Play store.
* [Nelexa\GPlay\GPlayApps::getAppsInfo()](../GPlayApps/gplayapps.getappsinfo.md) - Returns detailed information about many android packages.
* [Nelexa\GPlay\GPlayApps::getAppInLocales()](../GPlayApps/gplayapps.getappinlocales.md) - Returns detailed information about an application from the Google Play store for an array of locales.
* [Nelexa\GPlay\GPlayApps::getAppInfoForAvailableLocales()](../GPlayApps/gplayapps.getappinfoforavailablelocales.md) - Returns detailed information about the application in all available locales.
## Sample object content
```php
class Nelexa\GPlay\Model\Developer {
  -getId(): string: "5667641639682181100"
  -getUrl(): string: "https://play.google.com/store/apps/dev?id=5667641639682181100"
  -getName(): string: "Office Create Corp."
  -getDescription(): ?string: "From the moment you tap START on an app, it&#39;s our mission to transport you to a world of incredible fun through the medium of games."
  -getWebsite(): ?string: "http://www.ofcr.co.jp/"
  -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: {
    -getUrl(): string: "https://lh3.googleusercontent.com/RUQ4B-dsqXPU_d7bmi7eI_liVPv8Ui9G0OALgX7Cgo9cuB33FaQF18p_Czb9JCzAGz1s"
    -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/RUQ4B-dsqXPU_d7bmi7eI_liVPv8Ui9G0OALgX7Cgo9cuB33FaQF18p_Czb9JCzAGz1s=s0"
    -getBinaryImageContent(): string: …
    -__toString(): string: "https://lh3.googleusercontent.com/RUQ4B-dsqXPU_d7bmi7eI_liVPv8Ui9G0OALgX7Cgo9cuB33FaQF18p_Czb9JCzAGz1s"
  }
  -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
    -getUrl(): string: "https://lh3.googleusercontent.com/FhKN9GIY1SVMTNhdFwX6iaPay2WNDF88hunE6r_cxK0hv1IiCzUPB4iyzGzIviN-DiY"
    -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/FhKN9GIY1SVMTNhdFwX6iaPay2WNDF88hunE6r_cxK0hv1IiCzUPB4iyzGzIviN-DiY=s0"
    -getBinaryImageContent(): string: …
    -__toString(): string: "https://lh3.googleusercontent.com/FhKN9GIY1SVMTNhdFwX6iaPay2WNDF88hunE6r_cxK0hv1IiCzUPB4iyzGzIviN-DiY"
  }
  -getEmail(): ?string: null
  -getAddress(): ?string: null
  -asArray(): array: …
  -jsonSerialize(): mixed: …
}
```
**Example result as `json`**
```php
<?php
echo json_encode($developer, JSON_PRETTY_PRINT |  JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_LINE_TERMINATORS);
```
Output:
```json
{
    "id": "5667641639682181100",
    "url": "https://play.google.com/store/apps/dev?id=5667641639682181100",
    "name": "Office Create Corp.",
    "description": "From the moment you tap START on an app, it&#39;s our mission to transport you to a world of incredible fun through the medium of games.",
    "website": "http://www.ofcr.co.jp/",
    "icon": "https://lh3.googleusercontent.com/RUQ4B-dsqXPU_d7bmi7eI_liVPv8Ui9G0OALgX7Cgo9cuB33FaQF18p_Czb9JCzAGz1s",
    "cover": "https://lh3.googleusercontent.com/FhKN9GIY1SVMTNhdFwX6iaPay2WNDF88hunE6r_cxK0hv1IiCzUPB4iyzGzIviN-DiY",
    "email": null,
    "address": null
}
```

[Documentation](../../README.md) > **Developer**
