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
    public jsonSerialize ( void ) : mixed
}
```

## Table of Contents
* [Nelexa\GPlay\Model\ImageInfo::__construct](imageinfo.construct.md) - Creates an object with information about the image saved to disk.
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
  -getUrl(): string: "https://lh3.googleusercontent.com/eJRcpLl6mxZpq2VK0MjIwiSSv0fnVjgVtC_p2Z0pzgykn40oMG-RX3J8JdRLYGHHrQ"
  -getFilename(): string: "/tmp/screenshot.png"
  -getMimeType(): string: "image/jpeg"
  -getExtension(): string: "jpg"
  -getWidth(): int: 288
  -getHeight(): int: 512
  -getFilesize(): int: 49287
  -asArray(): array: …
  -jsonSerialize(): mixed: …
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
    "url": "https://lh3.googleusercontent.com/eJRcpLl6mxZpq2VK0MjIwiSSv0fnVjgVtC_p2Z0pzgykn40oMG-RX3J8JdRLYGHHrQ",
    "path": "/tmp/screenshot.png",
    "mimeType": "image/jpeg",
    "extension": "jpg",
    "width": 288,
    "height": 512
}
```

[Documentation](../../README.md) > **ImageInfo**
