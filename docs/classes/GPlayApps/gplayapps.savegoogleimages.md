[Documentation](../../README.md) > [GPlayApps](README.md) > **saveGoogleImages**

# Nelexa\GPlay\GPlayApps::saveGoogleImages
`Nelexa\GPlay\GPlayApps::saveGoogleImages` — Asynchronously saves images from googleusercontent.com and similar URLs to disk.

## Description
```php
Nelexa\GPlay\GPlayApps::saveGoogleImages ( Nelexa\GPlay\Model\GoogleImage[] $images , callable $destPathCallback [, bool $overwrite = false ] ) : Nelexa\GPlay\Model\ImageInfo[]
```
Before use, you can set the parameters of the width-height of images.

Example:
```php
$gplay->saveGoogleImages(
$images,
static function (\Nelexa\GPlay\Model\GoogleImage $image): string {
$hash = $image->getHashUrl($hashAlgo = 'md5', $parts = 2, $partLength = 2);
return 'path/to/screenshots/' . $hash . '.{ext}';
},
$overwrite = false
);
```

[Nelexa\GPlay\Model\GoogleImage](../GoogleImage/README.md) object is
passed, and you must return the full
output. path to save this file.

## Parameters
* **$images** ([Nelexa\GPlay\Model\GoogleImage](../GoogleImage/README.md)[])  
array of [Nelexa\GPlay\Model\GoogleImage](../GoogleImage/README.md) objects
* **$destPathCallback** (callable)  
The function to which the
* **$overwrite** (bool)  
overwrite files if exists

## Return Values
returns an array with information about saved images

## Examples
**Example 1 - Asynchronously save images**
```php
$app = $gplay->getAppInfo(new \Nelexa\GPlay\Model\AppId('com.rovio.angrybirds', 'ru'));
$screenshots = $app->getScreenshots();

// download and save images
$imageInfos = $gplay
    ->setConcurrency(10)
    ->saveGoogleImages($screenshots, static function (Nelexa\GPlay\Model\GoogleImage $image) {
        // set width or height 700px
        $image->setSize(700);
        $hash = $image->getHashUrl($hashAlgo = 'md5', $parts = 2, $partLength = 2);

        return 'screenshots/' . $hash . '.{ext}';
    })
;
```
<details>
  <summary>Results</summary>

```php
array:15 [
    0 => class Nelexa\GPlay\Model\ImageInfo {
      -getUrl(): string: "https://play-lh.googleusercontent.com/n7uqiWBp3ej01JpnR3ShqB6jfn_FIEjnDn0vM0b535O9DHk5wdtWGE3g1V9mpw4rG24=s700"
      -getFilename(): string: "screenshots/ec/45/ec45b381683d65cd43f269a03a7bc518.png"
      -getMimeType(): string: "image/png"
      -getExtension(): string: "png"
      -getWidth(): int: 394
      -getHeight(): int: 700
      -getFilesize(): int: 261138
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\ImageInfo {
      -getUrl(): string: "https://play-lh.googleusercontent.com/G1UMB--FegPRDxJfct7cS6-BWeMyh8-on--_aAiE_3ap6NveXAM-uj4ye-HX3HEQrqS3=s700"
      -getFilename(): string: "screenshots/6b/30/6b3042000b09d83f0cd27fe945914b26.png"
      -getMimeType(): string: "image/png"
      -getExtension(): string: "png"
      -getWidth(): int: 394
      -getHeight(): int: 700
      -getFilesize(): int: 312625
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    …
  ]
```

</details>

**Example 2 - Save one image**
```php
$app = $gplay->getAppInfo(new \Nelexa\GPlay\Model\AppId('com.rovio.angrybirds', 'ru'));

$imageInfo = $app->getIcon()
    ->setWidth(300)
    ->saveAs('icons/' . $app->getId() . '.{ext}')
;
```
<details>
  <summary>Results</summary>

```php
class Nelexa\GPlay\Model\ImageInfo {
  -getUrl(): string: "https://play-lh.googleusercontent.com/iOi6YJxQwMenT5UQWGPWTrFMQFm68IC4uKlFtARveZzVD5lTZ7fC47_rnnF7Tk48DpY=w300"
  -getFilename(): string: "icons/com.rovio.angrybirds.png"
  -getMimeType(): string: "image/png"
  -getExtension(): string: "png"
  -getWidth(): int: 300
  -getHeight(): int: 300
  -getFilesize(): int: 59706
  -asArray(): array: …
  -jsonSerialize(): array: …
}
```

</details>

## See Also
* [Nelexa\GPlay\Model\GoogleImage](../GoogleImage/README.md) - Contains a link to the image, allows you to customize its size and download it.
* [Nelexa\GPlay\Model\ImageInfo](../ImageInfo/README.md) - Contains information about the image.

[Documentation](../../README.md) > [GPlayApps](README.md) > **saveGoogleImages**
