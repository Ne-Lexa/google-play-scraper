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
passed and you must return the full
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
    ->saveGoogleImages(
        $screenshots,
        static function (Nelexa\GPlay\Model\GoogleImage $image) {
            // set width or height 700px
            $image->setSize(700);
            $hash = $image->getHashUrl($hashAlgo = 'md5', $parts = 2, $partLength = 2);

            return 'screenshots/' . $hash . '.{ext}';
        }
    )
;
```
<details>
  <summary>Results</summary>

```php
array:15 [
    0 => class Nelexa\GPlay\Model\ImageInfo {
      -getUrl(): string: "https://lh3.googleusercontent.com/0Wp_JWb55MC6uygq04cbRi6sZp1ygf2tASy_NxCiVislgV0aECPtnVjkfJBSX48tOQE=s700"
      -getFilename(): string: "screenshots/5b/53/5b534ca8013eaa6eba692eb99a7d857a.png"
      -getMimeType(): string: "image/png"
      -getExtension(): string: "png"
      -getWidth(): int: 394
      -getHeight(): int: 700
      -getFilesize(): int: 308317
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    1 => class Nelexa\GPlay\Model\ImageInfo {
      -getUrl(): string: "https://lh3.googleusercontent.com/9OxTFiQV8AEPSlAkgkNu-Vz9wyEdvQCt3IjcuskfZ7neQACjFAHX9CpW7Th5RCT4n7lQ=s700"
      -getFilename(): string: "screenshots/3d/1b/3d1b9ce3cd4a8da69c351613142dc7ed.png"
      -getMimeType(): string: "image/png"
      -getExtension(): string: "png"
      -getWidth(): int: 525
      -getHeight(): int: 700
      -getFilesize(): int: 386558
      -asArray(): array: …
      -jsonSerialize(): mixed: …
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
  -getUrl(): string: "https://lh3.googleusercontent.com/iOi6YJxQwMenT5UQWGPWTrFMQFm68IC4uKlFtARveZzVD5lTZ7fC47_rnnF7Tk48DpY=w300"
  -getFilename(): string: "icons/com.rovio.angrybirds.png"
  -getMimeType(): string: "image/png"
  -getExtension(): string: "png"
  -getWidth(): int: 300
  -getHeight(): int: 300
  -getFilesize(): int: 59706
  -asArray(): array: …
  -jsonSerialize(): mixed: …
}
```

</details>

## See Also
* [Nelexa\GPlay\Model\GoogleImage](../GoogleImage/README.md) - Contains a link to the image, allows you to customize its size and download it.
* [Nelexa\GPlay\Model\ImageInfo](../ImageInfo/README.md) - Contains information about the image.

[Documentation](../../README.md) > [GPlayApps](README.md) > **saveGoogleImages**
