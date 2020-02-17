[Documentation](../../README.md) > **GoogleImage**

# The `Nelexa\GPlay\Model\GoogleImage` class

## Introduction
Contains a link to the image, allows you to customize its size and download it.

This class only works with images stored on googleusercontent.com.
To modify the image, special parameters are added to the URL, using a hyphen.

**Supported parameters:**

| Param | Name         | Description                                     | Example                       |
| :---: |:------------ | :---------------------------------------------- | ----------------------------: |
| sN | size            | Sets the longer of height or width to N pixels  | s70 ![][_s] ![][_s2] ![][_s3] |
| wN | width           | Sets width of image to N pixels                 | w70 ![][_w] ![][_w2] ![][_w3] |
| hN | height          | Sets height of image to N pixels                | h70 ![][_h] ![][_h2] ![][_h3] |
| c  | square crop     | Sets square crop                   | w40-h70-c ![][_c1.1] ![][_c1.2] ![][_c1.3] |
|    |                 |                                    | w70-h40-c ![][_c2.1] ![][_c2.2] ![][_c2.3] |
|    |                 |                                    | w70-h70-c ![][_c3.1] ![][_c3.2] ![][_c3.3] |
| p  | smart crop      | Sets smart crop                    | w40-h70-p ![][_p1.1] ![][_p1.2] ![][_p1.3] |
|    |                 |                                    | w70-h40-p ![][_p2.1] ![][_p2.2] ![][_p2.3] |
|    |                 |                                    | w70-h70-p ![][_p3.1] ![][_p3.2] ![][_p3.3] |
| bN | border          | Sets border of image to N pixels            | s70-b10 ![][_b] ![][_b2] ![][_b3] |
| fv | vertical flip   | Vertically flips the image                | s70-fv ![][_fv] ![][_fv2] ![][_fv3] |
| fh | horizontal flip | Horizontally flips the image              | s70-fh ![][_fh] ![][_fh2] ![][_fh3] |

[_s]:https://lh3.googleusercontent.com/6EtT4dght1QF9-XYvSiwx2uqkBiOnrwq-N-dPZLUw4x61Bh2Bp_w6BZ_d0dZPoTBVqM=s70
[_w]:https://lh3.googleusercontent.com/6EtT4dght1QF9-XYvSiwx2uqkBiOnrwq-N-dPZLUw4x61Bh2Bp_w6BZ_d0dZPoTBVqM=w70
[_h]:https://lh3.googleusercontent.com/6EtT4dght1QF9-XYvSiwx2uqkBiOnrwq-N-dPZLUw4x61Bh2Bp_w6BZ_d0dZPoTBVqM=h70
[_c1.1]:https://lh3.googleusercontent.com/6EtT4dght1QF9-XYvSiwx2uqkBiOnrwq-N-dPZLUw4x61Bh2Bp_w6BZ_d0dZPoTBVqM=w40-h70-c
[_c2.1]:https://lh3.googleusercontent.com/6EtT4dght1QF9-XYvSiwx2uqkBiOnrwq-N-dPZLUw4x61Bh2Bp_w6BZ_d0dZPoTBVqM=w70-h40-c
[_c3.1]:https://lh3.googleusercontent.com/6EtT4dght1QF9-XYvSiwx2uqkBiOnrwq-N-dPZLUw4x61Bh2Bp_w6BZ_d0dZPoTBVqM=w70-h70-c
[_p1.1]:https://lh3.googleusercontent.com/6EtT4dght1QF9-XYvSiwx2uqkBiOnrwq-N-dPZLUw4x61Bh2Bp_w6BZ_d0dZPoTBVqM=w40-h70-p
[_p2.1]:https://lh3.googleusercontent.com/6EtT4dght1QF9-XYvSiwx2uqkBiOnrwq-N-dPZLUw4x61Bh2Bp_w6BZ_d0dZPoTBVqM=w70-h40-p
[_p3.1]:https://lh3.googleusercontent.com/6EtT4dght1QF9-XYvSiwx2uqkBiOnrwq-N-dPZLUw4x61Bh2Bp_w6BZ_d0dZPoTBVqM=w70-h70-p
[_b]:https://lh3.googleusercontent.com/6EtT4dght1QF9-XYvSiwx2uqkBiOnrwq-N-dPZLUw4x61Bh2Bp_w6BZ_d0dZPoTBVqM=s70-b10
[_fv]:https://lh3.googleusercontent.com/6EtT4dght1QF9-XYvSiwx2uqkBiOnrwq-N-dPZLUw4x61Bh2Bp_w6BZ_d0dZPoTBVqM=s70-fv
[_fh]:https://lh3.googleusercontent.com/6EtT4dght1QF9-XYvSiwx2uqkBiOnrwq-N-dPZLUw4x61Bh2Bp_w6BZ_d0dZPoTBVqM=s70-fh

[_s2]:https://lh3.googleusercontent.com/7tB9mdZ61rXn1uhgPVeGDV39FMtce_bDxyFcRMKlbZy_AbGP6rHn8BknJI4n-U4hki8p=s70
[_w2]:https://lh3.googleusercontent.com/7tB9mdZ61rXn1uhgPVeGDV39FMtce_bDxyFcRMKlbZy_AbGP6rHn8BknJI4n-U4hki8p=w70
[_h2]:https://lh3.googleusercontent.com/7tB9mdZ61rXn1uhgPVeGDV39FMtce_bDxyFcRMKlbZy_AbGP6rHn8BknJI4n-U4hki8p=h70
[_c1.2]:https://lh3.googleusercontent.com/7tB9mdZ61rXn1uhgPVeGDV39FMtce_bDxyFcRMKlbZy_AbGP6rHn8BknJI4n-U4hki8p=w40-h70-c
[_c2.2]:https://lh3.googleusercontent.com/7tB9mdZ61rXn1uhgPVeGDV39FMtce_bDxyFcRMKlbZy_AbGP6rHn8BknJI4n-U4hki8p=w70-h40-c
[_c3.2]:https://lh3.googleusercontent.com/7tB9mdZ61rXn1uhgPVeGDV39FMtce_bDxyFcRMKlbZy_AbGP6rHn8BknJI4n-U4hki8p=w70-h70-c
[_p1.2]:https://lh3.googleusercontent.com/7tB9mdZ61rXn1uhgPVeGDV39FMtce_bDxyFcRMKlbZy_AbGP6rHn8BknJI4n-U4hki8p=w40-h70-p
[_p2.2]:https://lh3.googleusercontent.com/7tB9mdZ61rXn1uhgPVeGDV39FMtce_bDxyFcRMKlbZy_AbGP6rHn8BknJI4n-U4hki8p=w70-h40-p
[_p3.2]:https://lh3.googleusercontent.com/7tB9mdZ61rXn1uhgPVeGDV39FMtce_bDxyFcRMKlbZy_AbGP6rHn8BknJI4n-U4hki8p=w70-h70-p
[_b2]:https://lh3.googleusercontent.com/7tB9mdZ61rXn1uhgPVeGDV39FMtce_bDxyFcRMKlbZy_AbGP6rHn8BknJI4n-U4hki8p=s70-b10
[_fv2]:https://lh3.googleusercontent.com/7tB9mdZ61rXn1uhgPVeGDV39FMtce_bDxyFcRMKlbZy_AbGP6rHn8BknJI4n-U4hki8p=s70-fv
[_fh2]:https://lh3.googleusercontent.com/7tB9mdZ61rXn1uhgPVeGDV39FMtce_bDxyFcRMKlbZy_AbGP6rHn8BknJI4n-U4hki8p=s70-fh

[_s3]:https://lh3.googleusercontent.com/tCijG_gfFddONMX6aDD8RjnohoVy0TNbx5wc_Jn9ERSBBXIVtMqO_vs1h-v_FPFrzA0=s70
[_w3]:https://lh3.googleusercontent.com/tCijG_gfFddONMX6aDD8RjnohoVy0TNbx5wc_Jn9ERSBBXIVtMqO_vs1h-v_FPFrzA0=w70
[_h3]:https://lh3.googleusercontent.com/tCijG_gfFddONMX6aDD8RjnohoVy0TNbx5wc_Jn9ERSBBXIVtMqO_vs1h-v_FPFrzA0=h70
[_c1.3]:https://lh3.googleusercontent.com/tCijG_gfFddONMX6aDD8RjnohoVy0TNbx5wc_Jn9ERSBBXIVtMqO_vs1h-v_FPFrzA0=w40-h70-c
[_c2.3]:https://lh3.googleusercontent.com/tCijG_gfFddONMX6aDD8RjnohoVy0TNbx5wc_Jn9ERSBBXIVtMqO_vs1h-v_FPFrzA0=w70-h40-c
[_c3.3]:https://lh3.googleusercontent.com/tCijG_gfFddONMX6aDD8RjnohoVy0TNbx5wc_Jn9ERSBBXIVtMqO_vs1h-v_FPFrzA0=w70-h70-c
[_p1.3]:https://lh3.googleusercontent.com/tCijG_gfFddONMX6aDD8RjnohoVy0TNbx5wc_Jn9ERSBBXIVtMqO_vs1h-v_FPFrzA0=w40-h70-p
[_p2.3]:https://lh3.googleusercontent.com/tCijG_gfFddONMX6aDD8RjnohoVy0TNbx5wc_Jn9ERSBBXIVtMqO_vs1h-v_FPFrzA0=w70-h40-p
[_p3.3]:https://lh3.googleusercontent.com/tCijG_gfFddONMX6aDD8RjnohoVy0TNbx5wc_Jn9ERSBBXIVtMqO_vs1h-v_FPFrzA0=w70-h70-p
[_b3]:https://lh3.googleusercontent.com/tCijG_gfFddONMX6aDD8RjnohoVy0TNbx5wc_Jn9ERSBBXIVtMqO_vs1h-v_FPFrzA0=s70-b10
[_fv3]:https://lh3.googleusercontent.com/tCijG_gfFddONMX6aDD8RjnohoVy0TNbx5wc_Jn9ERSBBXIVtMqO_vs1h-v_FPFrzA0=s70-fv
[_fh3]:https://lh3.googleusercontent.com/tCijG_gfFddONMX6aDD8RjnohoVy0TNbx5wc_Jn9ERSBBXIVtMqO_vs1h-v_FPFrzA0=s70-fh

If the URL has no parameters, by default GoogleUserContents uses the parameter **s512**.
This means that the width or height will not exceed 512px.

## Class synopsis
```php
Nelexa\GPlay\Model\GoogleImage {

    /* Methods */
    public __construct ( string $url [, bool $keepParams = true ] ) 
    public getUrl ( void ) : string
    public getOriginalSizeUrl ( void ) : string
    public getHashUrl ( [ string $hashAlgorithm = "md5" ] [, int $parts = 0 ] [, int $partLength = 2 ] ) : string
    public useOriginalSize ( void ) : Nelexa\GPlay\Model\GoogleImage
    public setSize ( int | null $size ) : Nelexa\GPlay\Model\GoogleImage
    public setWidth ( int | null $width ) : Nelexa\GPlay\Model\GoogleImage
    public setHeight ( int | null $height ) : Nelexa\GPlay\Model\GoogleImage
    public setWidthAndHeight ( int $width , int $height ) : Nelexa\GPlay\Model\GoogleImage
    public setBorder ( int | null $border ) : Nelexa\GPlay\Model\GoogleImage
    public setSquareCrop ( bool $squareCrop ) : Nelexa\GPlay\Model\GoogleImage
    public setSmartCrop ( bool $smartCrop ) : Nelexa\GPlay\Model\GoogleImage
    public setVerticalFlip ( bool $verticalFlip ) : Nelexa\GPlay\Model\GoogleImage
    public setHorizontalFlip ( bool $horizontalFlip ) : Nelexa\GPlay\Model\GoogleImage
    public reset ( void ) 
    public saveAs ( string $destPath ) : Nelexa\GPlay\Model\ImageInfo
    public static getImageExtension ( string $mimeType ) : string | null
    public getBinaryImageContent ( void ) : string
    public __toString ( void ) : string
}
```

## Examples
**Example 1 - Saving icons with different sizes**
```php
$app = $gplay->getAppInfo('com.rovio.angrybirds');

$iconSize = [
    'mdpi' => 48,
    'hdpi' => 72,
    'xhdpi' => 96,
    'xxhdpi' => 144,
    'xxxhdpi' => 192,
    'web' => 512,
];

$results = [];

foreach ($iconSize as $key => $size) {
    $results[$key] = $app->getIcon()->setSize($size)->saveAs(
        sprintf('icon/%s/%s.png', $app->getId(), $key)
    );
}
```
<details>
  <summary>Results</summary>

```php
array:6 [
    "mdpi" => class Nelexa\GPlay\Model\ImageInfo {
      -getUrl(): string: "https://lh3.googleusercontent.com/iOi6YJxQwMenT5UQWGPWTrFMQFm68IC4uKlFtARveZzVD5lTZ7fC47_rnnF7Tk48DpY=s48"
      -getFilename(): string: "icon/com.rovio.angrybirds/mdpi.png"
      -getMimeType(): string: "image/png"
      -getExtension(): string: "png"
      -getWidth(): int: 48
      -getHeight(): int: 48
      -getFilesize(): int: 4274
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    "hdpi" => class Nelexa\GPlay\Model\ImageInfo {
      -getUrl(): string: "https://lh3.googleusercontent.com/iOi6YJxQwMenT5UQWGPWTrFMQFm68IC4uKlFtARveZzVD5lTZ7fC47_rnnF7Tk48DpY=s72"
      -getFilename(): string: "icon/com.rovio.angrybirds/hdpi.png"
      -getMimeType(): string: "image/png"
      -getExtension(): string: "png"
      -getWidth(): int: 72
      -getHeight(): int: 72
      -getFilesize(): int: 7463
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    …
  ]
```

</details>

**Example 2 - Asynchronously save images**
```php
$app = $gplay->getAppInfo('com.rovio.angrybirds');
$screenshots = $app->getScreenshots();

// set the width to 700 for all screenshots
array_walk(
    $screenshots,
    static function (\Nelexa\GPlay\Model\GoogleImage $image): void {
        $image->setWidth(700);
    }
);

$results = $gplay
    ->setConcurrency(10)
    ->saveGoogleImages(
        $screenshots,
        static function (\Nelexa\GPlay\Model\GoogleImage $image): string {
            return 'screenshots/' . $image->getHashUrl('md5', $parts = 1, $partsLength = 3) . '.{ext}';
        }
    )
;
```
<details>
  <summary>Results</summary>

```php
array:15 [
    0 => class Nelexa\GPlay\Model\ImageInfo {
      -getUrl(): string: "https://lh3.googleusercontent.com/ykwlyF-Lvnla20Omus2o6hnI2E3V4f_dU_oqElqUZmAxRdIZxQS4iB0xPZ4Khy9TZuA=w700"
      -getFilename(): string: "screenshots/697/697778ef9aef9c243c0a5505f7c453e3.png"
      -getMimeType(): string: "image/png"
      -getExtension(): string: "png"
      -getWidth(): int: 700
      -getHeight(): int: 934
      -getFilesize(): int: 493845
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    1 => class Nelexa\GPlay\Model\ImageInfo {
      -getUrl(): string: "https://lh3.googleusercontent.com/LTPRCiZKBqBGfgxVCOPo5A6qgDdAjebkLU6tAkvirmBjHdlkY5SjOiBMUaIp7o8_K5k=w700"
      -getFilename(): string: "screenshots/e82/e8287583381d282d9688082aecf09f14.png"
      -getMimeType(): string: "image/png"
      -getExtension(): string: "png"
      -getWidth(): int: 700
      -getHeight(): int: 934
      -getFilesize(): int: 635907
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    …
  ]
```

</details>

## Table of Contents
* [Nelexa\GPlay\Model\GoogleImage::__construct](googleimage.construct.md) - Creates a GoogleImage object from the URL of the googleusercontent.com.
* [Nelexa\GPlay\Model\GoogleImage::getUrl](googleimage.geturl.md) - Returns the URL of the image with all the parameters set.
* [Nelexa\GPlay\Model\GoogleImage::getOriginalSizeUrl](googleimage.getoriginalsizeurl.md) - Returns a URL with the original image size.
* [Nelexa\GPlay\Model\GoogleImage::getHashUrl](googleimage.gethashurl.md) - Returns a hash value for this object.
* [Nelexa\GPlay\Model\GoogleImage::useOriginalSize](googleimage.useoriginalsize.md) - Sets the original image size.
* [Nelexa\GPlay\Model\GoogleImage::setSize](googleimage.setsize.md) - Sets the image size greater than height or width up to N pixels.
* [Nelexa\GPlay\Model\GoogleImage::setWidth](googleimage.setwidth.md) - Sets the width of the image.
* [Nelexa\GPlay\Model\GoogleImage::setHeight](googleimage.setheight.md) - Sets the height of the image.
* [Nelexa\GPlay\Model\GoogleImage::setWidthAndHeight](googleimage.setwidthandheight.md) - Sets the width and height of the image.
* [Nelexa\GPlay\Model\GoogleImage::setBorder](googleimage.setborder.md) - Sets the border around the image.
* [Nelexa\GPlay\Model\GoogleImage::setSquareCrop](googleimage.setsquarecrop.md) - Sets the use of square crop.
* [Nelexa\GPlay\Model\GoogleImage::setSmartCrop](googleimage.setsmartcrop.md) - Sets the use of smart crop.
* [Nelexa\GPlay\Model\GoogleImage::setVerticalFlip](googleimage.setverticalflip.md) - Sets the use of vertical flip.
* [Nelexa\GPlay\Model\GoogleImage::setHorizontalFlip](googleimage.sethorizontalflip.md) - Sets the use of horizontal flip.
* [Nelexa\GPlay\Model\GoogleImage::reset](googleimage.reset.md) - Reset all parameters.
* [Nelexa\GPlay\Model\GoogleImage::saveAs](googleimage.saveas.md) - Save image to disk.
* [Nelexa\GPlay\Model\GoogleImage::getImageExtension](googleimage.getimageextension.md)
* [Nelexa\GPlay\Model\GoogleImage::getBinaryImageContent](googleimage.getbinaryimagecontent.md) - Returns binary image contents.
* [Nelexa\GPlay\Model\GoogleImage::__toString](googleimage.tostring.md) - Returns the URL of the image.


## See Also
* :link: [https://developers.google.com/people/image-sizing](https://developers.google.com/people/image-sizing) - Goolge People API - Image Sizing.
* :link: [https://github.com/null-dev/libGoogleUserContent](https://github.com/null-dev/libGoogleUserContent) - Java library to create googleusercontent.com URLs.
* :link: [https://sites.google.com/site/picasaresources/Home/Picasa-FAQ/google-photos-1/how-to/how-to-get-a-direct-link-to-an-image](https://sites.google.com/site/picasaresources/Home/Picasa-FAQ/google-photos-1/how-to/how-to-get-a-direct-link-to-an-image) - Google Photos and Picasa: How to get a direct link to an image (of a specific size)

[Documentation](../../README.md) > **GoogleImage**
