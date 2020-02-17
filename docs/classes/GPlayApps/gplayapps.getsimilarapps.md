[Documentation](../../README.md) > [GPlayApps](README.md) > **getSimilarApps**

# Nelexa\GPlay\GPlayApps::getSimilarApps
`Nelexa\GPlay\GPlayApps::getSimilarApps` — Returns an array of similar applications with basic information about them in the Google Play store.

## Description
```php
Nelexa\GPlay\GPlayApps::getSimilarApps ( string | Nelexa\GPlay\Model\AppId $appId [, int $limit = 50 ] ) : Nelexa\GPlay\Model\App[]
```

## Parameters
* **$appId** (string | [Nelexa\GPlay\Model\AppId](../AppId/README.md))  
application ID (Android package name) as a string or [Nelexa\GPlay\Model\AppId](../AppId/README.md) object
* **$limit** (int)  
The maximum number of similar applications. To extract all similar applications, use [Nelexa\GPlay\GPlayApps::UNLIMIT](README.md#predefined-constants).

## Return Values
an array of applications with basic information about them


## Errors/Exceptions
* Throws [Nelexa\GPlay\Exception\GooglePlayException](../GooglePlayException/README.md) if the application is not exists or other HTTP error
## Examples
```php
$app = 'com.sololearn';
// either
$app = new \Nelexa\GPlay\Model\AppId('com.sololearn', 'ru');
// or
$app = $gplay->setDefaultLocale('ru')->getAppInfo('com.sololearn');

$similarApps = $gplay->getSimilarApps($app, $limit = \Nelexa\GPlay\GPlayApps::UNLIMIT);
```
<details>
  <summary>Results</summary>

```php
array:161 [
    0 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.freeit.java"
      -getLocale(): string: "ru_RU"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.freeit.java"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.freeit.java&hl=ru_RU&gl=us"
      -getName(): string: "Центр программирования: научиться кодировать"
      -getSummary(): ?string: "Изучайте HTML,Python,Javascript,C,C ++,C #, Java и другие языки программирования"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "8802462833480602617"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=8802462833480602617"
        -getName(): string: "Coding and Programming"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/fy2SPeYLij4AC8WFaGSq0uxol14F22F3BGUU_Dq-UY9WjUiDc6Tz2FDCuxsgyQ4HPQ"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/fy2SPeYLij4AC8WFaGSq0uxol14F22F3BGUU_Dq-UY9WjUiDc6Tz2FDCuxsgyQ4HPQ=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/fy2SPeYLij4AC8WFaGSq0uxol14F22F3BGUU_Dq-UY9WjUiDc6Tz2FDCuxsgyQ4HPQ"
      }
      -getScore(): float: 4.5951314
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    1 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.getmimo"
      -getLocale(): string: "ru_RU"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.getmimo"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.getmimo&hl=ru_RU&gl=us"
      -getName(): string: "Мимо: Научитесь программировать"
      -getSummary(): ?string: "Освой Python, JavaScript, Java, HTML, CSS, Swift, Kotlin, C++, SQL, PHP и C#!"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "5836148544871025856"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=5836148544871025856"
        -getName(): string: "Mimohello GmbH"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/4EbbMw6TnleJPtv4rc2C-8NVle1c9xxRkGfPLBzdqosNT61Fk7ag-TYXcVadm8V8uA4"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/4EbbMw6TnleJPtv4rc2C-8NVle1c9xxRkGfPLBzdqosNT61Fk7ag-TYXcVadm8V8uA4=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/4EbbMw6TnleJPtv4rc2C-8NVle1c9xxRkGfPLBzdqosNT61Fk7ag-TYXcVadm8V8uA4"
      }
      -getScore(): float: 4.6699705
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    …
  ]
```

</details>

## See Also
* [Nelexa\GPlay\GPlayApps::UNLIMIT](README.md#predefined-constants) - Limit for all available results.

[Documentation](../../README.md) > [GPlayApps](README.md) > **getSimilarApps**
