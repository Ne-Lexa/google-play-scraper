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
    public jsonSerialize ( void ) : mixed
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
  -getId(): string: "com.kristanix.android.jigsawpuzzleepic"
  -getLocale(): string: "en_US"
  -getCountry(): string: "us"
  -getUrl(): string: "https://play.google.com/store/apps/details?id=com.kristanix.android.jigsawpuzzleepic"
  -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.kristanix.android.jigsawpuzzleepic&hl=en_US&gl=us"
  -getName(): string: "Jigsaw Puzzles Epic"
  -getSummary(): ?string: "Jigsaw Puzzles Epic: Jigsaw game with over 10,000 beautiful puzzles!"
  -getDeveloper(): Nelexa\GPlay\Model\Developer: {
    -getId(): string: "5808801354978445358"
    -getUrl(): string: "https://play.google.com/store/apps/dev?id=5808801354978445358"
    -getName(): string: "Kristanix Games"
    -getDescription(): ?string: null
    -getWebsite(): ?string: null
    -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
    -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
    -getEmail(): ?string: null
    -getAddress(): ?string: null
    -asArray(): array: …
    -jsonSerialize(): mixed: …
  }
  -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
    -getUrl(): string: "https://lh3.googleusercontent.com/-Qb2u9InIcCiH4obms_Np4tCgCVG0WWwQml6qNK70X4tT3Iabj5ggcXH3jhLchj2UEvr"
    -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/-Qb2u9InIcCiH4obms_Np4tCgCVG0WWwQml6qNK70X4tT3Iabj5ggcXH3jhLchj2UEvr=s0"
    -getBinaryImageContent(): string: …
    -__toString(): string: "https://lh3.googleusercontent.com/-Qb2u9InIcCiH4obms_Np4tCgCVG0WWwQml6qNK70X4tT3Iabj5ggcXH3jhLchj2UEvr"
  }
  -getScore(): float: 4.50017
  -getPriceText(): ?string: null
  -isFree(): bool: true
  -asArray(): array: …
  -jsonSerialize(): mixed: …
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
    "id": "com.kristanix.android.jigsawpuzzleepic",
    "url": "https://play.google.com/store/apps/details?id=com.kristanix.android.jigsawpuzzleepic",
    "locale": "en_US",
    "country": "us",
    "name": "Jigsaw Puzzles Epic",
    "summary": "Jigsaw Puzzles Epic: Jigsaw game with over 10,000 beautiful puzzles!",
    "developer": {
        "id": "5808801354978445358",
        "url": "https://play.google.com/store/apps/dev?id=5808801354978445358",
        "name": "Kristanix Games",
        "description": null,
        "website": null,
        "icon": null,
        "cover": null,
        "email": null,
        "address": null
    },
    "icon": "https://lh3.googleusercontent.com/-Qb2u9InIcCiH4obms_Np4tCgCVG0WWwQml6qNK70X4tT3Iabj5ggcXH3jhLchj2UEvr",
    "score": 4.50017,
    "priceText": null
}
```

[Documentation](../../README.md) > **App**
