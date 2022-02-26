[Documentation](../../README.md) > **App**

# The `Nelexa\GPlay\Model\App` class

## Introduction
Contains basic information about the application from the Google Play store.

Some sections, such as search, similar applications, applications categories, etc. display
a list of applications with limited data. To get detailed information about the application,
you must call the appropriate method in the class [Nelexa\GPlay\GPlayApps](../GPlayApps/README.md).

## Class synopsis
```php
Nelexa\GPlay\Model\App extends Nelexa\GPlay\Model\AppId implements JsonSerializable {

    /* Methods */
    public getId ( void ) : string
    public getLocale ( void ) : string
    public getCountry ( void ) : string
    public getUrl ( void ) : string
    public getFullUrl ( void ) : string
    public getName ( void ) : string
    public getSummary ( void ) : string | null
    public getDeveloper ( void ) : Nelexa\GPlay\Model\Developer
    public getIcon ( void ) : Nelexa\GPlay\Model\GoogleImage
    public getScore ( void ) : float
    public getPriceText ( void ) : string | null
    public isFree ( void ) : bool
    public asArray ( void ) : array
    public jsonSerialize ( void ) : array
}
```

## Table of Contents
* [Nelexa\GPlay\Model\App::getId](app.getid.md) - Returns the application ID (android package name).
* [Nelexa\GPlay\Model\App::getLocale](app.getlocale.md) - Returns the locale (site language) for which the information was received.
* [Nelexa\GPlay\Model\App::getCountry](app.getcountry.md) - Returns the country of the request for information about the application.
* [Nelexa\GPlay\Model\App::getUrl](app.geturl.md) - Returns the URL of the application page in the Google Play store.
* [Nelexa\GPlay\Model\App::getFullUrl](app.getfullurl.md) - Returns the full URL of the app's page on Google Play, specifying the locale and country of the request.
* [Nelexa\GPlay\Model\App::getName](app.getname.md) - Returns application name.
* [Nelexa\GPlay\Model\App::getSummary](app.getsummary.md) - Returns application summary.
* [Nelexa\GPlay\Model\App::getDeveloper](app.getdeveloper.md) - Returns application developer.
* [Nelexa\GPlay\Model\App::getIcon](app.geticon.md) - Returns application icon.
* [Nelexa\GPlay\Model\App::getScore](app.getscore.md) - Returns application rating on a five-point scale.
* [Nelexa\GPlay\Model\App::getPriceText](app.getpricetext.md) - Returns the price of the application.
* [Nelexa\GPlay\Model\App::isFree](app.isfree.md) - Checks that this application is free.
* [Nelexa\GPlay\Model\App::asArray](app.asarray.md) - Returns class properties as an array.
* [Nelexa\GPlay\Model\App::jsonSerialize](app.jsonserialize.md) - Specify data which should be serialized to JSON.


## See Also
* [Nelexa\GPlay\Model\AppId](../AppId/README.md) - Application ID, application locale and country.
* [Nelexa\GPlay\GPlayApps::search()](../GPlayApps/gplayapps.search.md) - Returns a list of applications from the Google Play store for a search query.
* [Nelexa\GPlay\GPlayApps::getSimilarApps()](../GPlayApps/gplayapps.getsimilarapps.md) - Returns a list of similar applications in the Google Play store.
* [Nelexa\GPlay\GPlayApps::getDeveloperApps()](../GPlayApps/gplayapps.getdeveloperapps.md) - Returns a list of developer applications in the Google Play store.
* [Nelexa\GPlay\GPlayApps::getTopApps()](../GPlayApps/gplayapps.gettopapps.md) - Returns a list of applications with basic information from the category and collection of the Google Play store.
## Sample object content
```php
class Nelexa\GPlay\Model\App {
  -getId(): string: "jp.co.ofcr.cm00"
  -getLocale(): string: "en_US"
  -getCountry(): string: "us"
  -getUrl(): string: "https://play.google.com/store/apps/details?id=jp.co.ofcr.cm00"
  -getFullUrl(): string: "https://play.google.com/store/apps/details?id=jp.co.ofcr.cm00&hl=en_US&gl=us"
  -getName(): string: "Cooking Mama: Let's cook!"
  -getSummary(): ?string: "Make scrumptious food and serve it!"
  -getDeveloper(): Nelexa\GPlay\Model\Developer: {
    -getId(): string: "5667641639682181100"
    -getUrl(): string: "https://play.google.com/store/apps/dev?id=5667641639682181100"
    -getName(): string: "Office Create Corp."
    -getDescription(): ?string: null
    -getWebsite(): ?string: null
    -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
    -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
    -getEmail(): ?string: null
    -getAddress(): ?string: null
    -asArray(): array: …
    -jsonSerialize(): array: …
  }
  -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
    -__toString(): string: "https://play-lh.googleusercontent.com/51LDykvVt4B1EOfov5NmwGlHLbJ7kMd56kT7hcJb_-fUmgolJi8yJ4_mpaV8cijxSYw"
    -getUrl(): string: "https://play-lh.googleusercontent.com/51LDykvVt4B1EOfov5NmwGlHLbJ7kMd56kT7hcJb_-fUmgolJi8yJ4_mpaV8cijxSYw"
    -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/51LDykvVt4B1EOfov5NmwGlHLbJ7kMd56kT7hcJb_-fUmgolJi8yJ4_mpaV8cijxSYw=s0"
    -getBinaryImageContent(): string: …
  }
  -getScore(): float: 4.090022
  -getPriceText(): ?string: null
  -isFree(): bool: true
  -asArray(): array: …
  -jsonSerialize(): array: …
}
```
**Example result as `json`**
```php
<?php
echo json_encode($app, JSON_PRETTY_PRINT |  JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_LINE_TERMINATORS);
```
Output:
```json
{
    "id": "jp.co.ofcr.cm00",
    "url": "https://play.google.com/store/apps/details?id=jp.co.ofcr.cm00",
    "locale": "en_US",
    "country": "us",
    "name": "Cooking Mama: Let's cook!",
    "summary": "Make scrumptious food and serve it!",
    "developer": {
        "id": "5667641639682181100",
        "url": "https://play.google.com/store/apps/dev?id=5667641639682181100",
        "name": "Office Create Corp.",
        "description": null,
        "website": null,
        "icon": null,
        "cover": null,
        "email": null,
        "address": null
    },
    "icon": "https://play-lh.googleusercontent.com/51LDykvVt4B1EOfov5NmwGlHLbJ7kMd56kT7hcJb_-fUmgolJi8yJ4_mpaV8cijxSYw",
    "score": 4.090022,
    "priceText": null
}
```

[Documentation](../../README.md) > **App**
