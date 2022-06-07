[Documentation](../../README.md) > **Video**

# The `Nelexa\GPlay\Model\Video` class

## Introduction
Contains promo video data.

## Class synopsis
```php
Nelexa\GPlay\Model\Video implements JsonSerializable {

    /* Methods */
    public __construct ( string $imageUrl , string $videoUrl ) 
    public getImageUrl ( void ) : string
    public getVideoUrl ( void ) : string
    public getYoutubeId ( void ) : string | null
    public asArray ( void ) : array
    public jsonSerialize ( void ) : array
}
```

## Table of Contents
* [Nelexa\GPlay\Model\Video::__construct](video.__construct.md) - Creates an object with information about the promo video for Android application.
* [Nelexa\GPlay\Model\Video::getImageUrl](video.getimageurl.md) - Returns the video thumbnail url.
* [Nelexa\GPlay\Model\Video::getVideoUrl](video.getvideourl.md) - Returns the video url.
* [Nelexa\GPlay\Model\Video::getYoutubeId](video.getyoutubeid.md) - Returns a YouTube id.
* [Nelexa\GPlay\Model\Video::asArray](video.asarray.md) - Returns class properties as an array.
* [Nelexa\GPlay\Model\Video::jsonSerialize](video.jsonserialize.md) - Specify data which should be serialized to JSON.


## See Also
* [Nelexa\GPlay\GPlayApps::getAppsInfo()](../GPlayApps/gplayapps.getappsinfo.md) - Returns detailed information about many android packages.
* [Nelexa\GPlay\GPlayApps::getAppInLocales()](../GPlayApps/gplayapps.getappinlocales.md) - Returns detailed information about an application from the Google Play store for an array of locales.
* [Nelexa\GPlay\GPlayApps::getAppInfoForAvailableLocales()](../GPlayApps/gplayapps.getappinfoforavailablelocales.md) - Returns detailed information about the application in all available locales.

[Documentation](../../README.md) > **Video**
