[Documentation](../../README.md) > **HistogramRating**

# The `Nelexa\GPlay\Model\HistogramRating` class

## Introduction
Contains application rating data as data for histogram creation.

## Class synopsis
```php
Nelexa\GPlay\Model\HistogramRating implements JsonSerializable {

    /* Methods */
    public __construct ( int $fiveStars , int $fourStars , int $threeStars , int $twoStars , int $oneStar ) 
    public getFiveStars ( void ) : int
    public getFourStars ( void ) : int
    public getThreeStars ( void ) : int
    public getTwoStars ( void ) : int
    public getOneStar ( void ) : int
    public asArray ( void ) : array
    public jsonSerialize ( void ) : mixed
}
```

## Table of Contents
* [Nelexa\GPlay\Model\HistogramRating::__construct](histogramrating.construct.md) - Creates an object with information about the rating of Android applications from the Google Play store.
* [Nelexa\GPlay\Model\HistogramRating::getFiveStars](histogramrating.getfivestars.md) - Returns the five-star rating of the application.
* [Nelexa\GPlay\Model\HistogramRating::getFourStars](histogramrating.getfourstars.md) - Returns the four-star rating of the application.
* [Nelexa\GPlay\Model\HistogramRating::getThreeStars](histogramrating.getthreestars.md) - Returns the three-star rating of the application.
* [Nelexa\GPlay\Model\HistogramRating::getTwoStars](histogramrating.gettwostars.md) - Returns the two-star rating of the application.
* [Nelexa\GPlay\Model\HistogramRating::getOneStar](histogramrating.getonestar.md) - Returns the one-star rating of the application.
* [Nelexa\GPlay\Model\HistogramRating::asArray](histogramrating.asarray.md) - Returns class properties as an array.
* [Nelexa\GPlay\Model\HistogramRating::jsonSerialize](histogramrating.jsonserialize.md) - Specify data which should be serialized to JSON.


## See Also
* [Nelexa\GPlay\GPlayApps::getAppsInfo()](../GPlayApps/gplayapps.getappsinfo.md) - Returns detailed information about many android packages.
* [Nelexa\GPlay\GPlayApps::getAppInLocales()](../GPlayApps/gplayapps.getappinlocales.md) - Returns detailed information about an application from the Google Play store for an array of locales.
* [Nelexa\GPlay\GPlayApps::getAppInfoForAvailableLocales()](../GPlayApps/gplayapps.getappinfoforavailablelocales.md) - Returns detailed information about the application in all available locales.
## Sample object content
```php
class Nelexa\GPlay\Model\HistogramRating {
  -getFiveStars(): int: 74180
  -getFourStars(): int: 12644
  -getThreeStars(): int: 5614
  -getTwoStars(): int: 2159
  -getOneStar(): int: 7191
  -asArray(): array: …
  -jsonSerialize(): mixed: …
}
```
**Example result as `json`**
```php
<?php
echo json_encode($histogramRating, JSON_PRETTY_PRINT |  JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_LINE_TERMINATORS);
```
Output:
```json
{
    "five": 74180,
    "four": 74180,
    "three": 5614,
    "two": 2159,
    "one": 7191
}
```

[Documentation](../../README.md) > **HistogramRating**
