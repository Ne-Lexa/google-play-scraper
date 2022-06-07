[Documentation](../../README.md) > [GPlayApps](README.md) > **getSimilarApps**

# Nelexa\GPlay\GPlayApps::getSimilarApps
`Nelexa\GPlay\GPlayApps::getSimilarApps` — Returns an array of similar applications with basic information about them in the Google Play store.

## Description
```php
Nelexa\GPlay\GPlayApps::getSimilarApps ( string | Nelexa\GPlay\Model\AppId $appId [, int $limit = 50 ] ) : Nelexa\GPlay\Model\App[]
```

## Parameters
* **$appId** (string | [Nelexa\GPlay\Model\AppId](../AppId/README.md))  
application ID (Android package name)
as a string or [Nelexa\GPlay\Model\AppId](../AppId/README.md) object
* **$limit** (int)  
The maximum number of similar applications.
To extract all similar applications,
use [Nelexa\GPlay\GPlayApps::UNLIMIT](README.md#predefined-constants).

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
array:117 [
    0 => class Nelexa\GPlay\Model\App {
      -getId(): string: "org.khanacademy.android"
      -getLocale(): string: "ru_RU"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=org.khanacademy.android"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=org.khanacademy.android&hl=ru_RU&gl=us"
      -getName(): string: "Khan Academy"
      -getDescription(): string: """
        You can learn anything. For free.\n
        \n
        Spend an afternoon brushing up on statistics. Discover how the Krebs cycle works. Get a head start on next semester…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "Khan Academy"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/TpK0AcjPn5-XDKgSZ5jAob1H7MsQuJILOMR4M4QYkTt5CBPgTJVr7mysrKM6Ia8SrX8"
        -getUrl(): string: "https://play-lh.googleusercontent.com/TpK0AcjPn5-XDKgSZ5jAob1H7MsQuJILOMR4M4QYkTt5CBPgTJVr7mysrKM6Ia8SrX8"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/TpK0AcjPn5-XDKgSZ5jAob1H7MsQuJILOMR4M4QYkTt5CBPgTJVr7mysrKM6Ia8SrX8=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:21 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/PXIsGEzRrYDqBoQBFUJ974YnhN3ZM7dwyTIBz_HQsr34we2Zo07st7eSKuLEeyYNy58"
          -getUrl(): string: "https://play-lh.googleusercontent.com/PXIsGEzRrYDqBoQBFUJ974YnhN3ZM7dwyTIBz_HQsr34we2Zo07st7eSKuLEeyYNy58"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/PXIsGEzRrYDqBoQBFUJ974YnhN3ZM7dwyTIBz_HQsr34we2Zo07st7eSKuLEeyYNy58=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/wCNs_buIVMJuf0oDFYPLswTpNIL7T9ylcIxruo5dcQz3DkBM0WqFeF8VnDB9xss1eQ"
          -getUrl(): string: "https://play-lh.googleusercontent.com/wCNs_buIVMJuf0oDFYPLswTpNIL7T9ylcIxruo5dcQz3DkBM0WqFeF8VnDB9xss1eQ"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/wCNs_buIVMJuf0oDFYPLswTpNIL7T9ylcIxruo5dcQz3DkBM0WqFeF8VnDB9xss1eQ=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.3420167
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "10 000 000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\App {
      -getId(): string: "smsr.com.cw"
      -getLocale(): string: "ru_RU"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=smsr.com.cw"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=smsr.com.cw&hl=ru_RU&gl=us"
      -getName(): string: "Обратный отсчет виджет"
      -getDescription(): string: """
        Обратный отсчет дней виджет / Счетчик дней это бесплатное приложение, которое напоминает Вам о важных датах и событиях в вашей жизни, Вам не нужно вру…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "SMSROBOT LTD"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/7jdy2-FrcvJXTB5zARXSszm9yl2-vfd3Lh9h92NeEUMl7mnx0ILseUsNA9fImo-zzXo"
        -getUrl(): string: "https://play-lh.googleusercontent.com/7jdy2-FrcvJXTB5zARXSszm9yl2-vfd3Lh9h92NeEUMl7mnx0ILseUsNA9fImo-zzXo"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/7jdy2-FrcvJXTB5zARXSszm9yl2-vfd3Lh9h92NeEUMl7mnx0ILseUsNA9fImo-zzXo=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:24 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/FfVFdSy8llsMoc4ZcaogZZN419t79f0w-9jIWS1pPMcXw-3AZnifY5W7iGv2aGcRZtk"
          -getUrl(): string: "https://play-lh.googleusercontent.com/FfVFdSy8llsMoc4ZcaogZZN419t79f0w-9jIWS1pPMcXw-3AZnifY5W7iGv2aGcRZtk"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/FfVFdSy8llsMoc4ZcaogZZN419t79f0w-9jIWS1pPMcXw-3AZnifY5W7iGv2aGcRZtk=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/z1MIbBt3KeGCFogbYbXB5O5U2xAnSiMN3yxS_nCWK7Ji2MW4nHCg2u55zUtM5NxnXZ0"
          -getUrl(): string: "https://play-lh.googleusercontent.com/z1MIbBt3KeGCFogbYbXB5O5U2xAnSiMN3yxS_nCWK7Ji2MW4nHCg2u55zUtM5NxnXZ0"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/z1MIbBt3KeGCFogbYbXB5O5U2xAnSiMN3yxS_nCWK7Ji2MW4nHCg2u55zUtM5NxnXZ0=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.530501
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "5 000 000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    …
  ]
```

</details>

## See Also
* [Nelexa\GPlay\GPlayApps::UNLIMIT](README.md#predefined-constants) - Limit for all available results.

[Documentation](../../README.md) > [GPlayApps](README.md) > **getSimilarApps**
