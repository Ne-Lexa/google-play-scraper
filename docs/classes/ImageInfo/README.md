[Documentation](../../README.md) > **ImageInfo**

# The `Nelexa\GPlay\Model\ImageInfo` class

## Introduction
Contains information about the image.

## Class synopsis
```php
Nelexa\GPlay\Model\ImageInfo implements JsonSerializable {

    /* Methods */
    public __construct ( string $url , string $filename ) 
    public getUrl ( void ) : string
    public getFilename ( void ) : string
    public getMimeType ( void ) : string
    public getExtension ( void ) : string
    public getWidth ( void ) : int
    public getHeight ( void ) : int
    public getFilesize ( void ) : int
    public asArray ( void ) : array
    public jsonSerialize ( void ) : array
}
```

## Table of Contents
* [Nelexa\GPlay\Model\ImageInfo::__construct](imageinfo.__construct.md) - Creates an object with information about the image saved to disk.
* [Nelexa\GPlay\Model\ImageInfo::getUrl](imageinfo.geturl.md) - Returns the url of the image.
* [Nelexa\GPlay\Model\ImageInfo::getFilename](imageinfo.getfilename.md) - Returns the path to save the image file.
* [Nelexa\GPlay\Model\ImageInfo::getMimeType](imageinfo.getmimetype.md) - Returns the mime type of the image.
* [Nelexa\GPlay\Model\ImageInfo::getExtension](imageinfo.getextension.md) - Returns the image file extension.
* [Nelexa\GPlay\Model\ImageInfo::getWidth](imageinfo.getwidth.md) - Returns the width of the image.
* [Nelexa\GPlay\Model\ImageInfo::getHeight](imageinfo.getheight.md) - Returns the height of the image.
* [Nelexa\GPlay\Model\ImageInfo::getFilesize](imageinfo.getfilesize.md) - Returns the size of the image file.
* [Nelexa\GPlay\Model\ImageInfo::asArray](imageinfo.asarray.md) - Returns class properties as an array.
* [Nelexa\GPlay\Model\ImageInfo::jsonSerialize](imageinfo.jsonserialize.md) - Specify data which should be serialized to JSON.


## Sample object content
```php
class Nelexa\GPlay\Model\ImageInfo {
  -getUrl(): string: "https://play-lh.googleusercontent.com/lplFiGt1WRP5Kj4JNP6yekHsNXFjRlt23hUtsrkBnPXL4mxJcFZDPY5Uu56wWHFMBQ4C"
  -getFilename(): string: "/tmp/screenshot.png"
  -getMimeType(): string: "image/png"
  -getExtension(): string: "png"
  -getWidth(): int: 512
  -getHeight(): int: 341
  -getFilesize(): int: 311963
  -asArray(): array: …
  -jsonSerialize(): array: …
}
```
**Example result as `json`**
```php
<?php
echo json_encode($imageInfo, JSON_PRETTY_PRINT |  JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_LINE_TERMINATORS);
```
Output:
```json
{
    "url": "https://play-lh.googleusercontent.com/lplFiGt1WRP5Kj4JNP6yekHsNXFjRlt23hUtsrkBnPXL4mxJcFZDPY5Uu56wWHFMBQ4C",
    "path": "/tmp/screenshot.png",
    "mimeType": "image/png",
    "extension": "png",
    "width": 512,
    "height": 341
}
```

[Documentation](../../README.md) > **ImageInfo**
