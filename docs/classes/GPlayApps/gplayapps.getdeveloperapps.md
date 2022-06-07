[Documentation](../../README.md) > [GPlayApps](README.md) > **getDeveloperApps**

# Nelexa\GPlay\GPlayApps::getDeveloperApps
`Nelexa\GPlay\GPlayApps::getDeveloperApps` — Returns an array of applications from the Google Play store by developer id.

## Description
```php
Nelexa\GPlay\GPlayApps::getDeveloperApps ( string | Nelexa\GPlay\Model\Developer | Nelexa\GPlay\Model\App $developerId ) : Nelexa\GPlay\Model\App[]
```

## Parameters
* **$developerId** (string | [Nelexa\GPlay\Model\Developer](../Developer/README.md) | [Nelexa\GPlay\Model\App](../App/README.md))  
developer id as
string, [Nelexa\GPlay\Model\Developer](../Developer/README.md)
or [Nelexa\GPlay\Model\App](../App/README.md) object

## Return Values
an array of applications with basic information


## Errors/Exceptions
* Throws [Nelexa\GPlay\Exception\GooglePlayException](../GooglePlayException/README.md) if HTTP error is received
## Examples
```php
$devId = '5700313618786177705';
// or
$devId = 'Google';
// or
$devId = $gplay->getAppInfo('com.android.chrome');
// or
$devId = $gplay->getAppInfo('com.android.chrome')->getDeveloper();

$apps = $gplay->getDeveloperApps($devId);
```
<details>
  <summary>Results</summary>

```php
array:142 [
    0 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.google.android.apps.nbu.paisa.user"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.nbu.paisa.user"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.nbu.paisa.user&hl=en_US&gl=us"
      -getName(): string: "Google Pay: Save, Pay, Manage"
      -getDescription(): string: """
        Google Pay is a safe, simple, and helpful way to manage your money, giving you a clearer picture of your spending and savings:\n
        - Pay at your favorite …
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "Google LLC"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/HArtbyi53u0jnqhnnxkQnMx9dHOERNcprZyKnInd2nrfM7Wd9ivMNTiz7IJP6-mSpwk"
        -getUrl(): string: "https://play-lh.googleusercontent.com/HArtbyi53u0jnqhnnxkQnMx9dHOERNcprZyKnInd2nrfM7Wd9ivMNTiz7IJP6-mSpwk"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/HArtbyi53u0jnqhnnxkQnMx9dHOERNcprZyKnInd2nrfM7Wd9ivMNTiz7IJP6-mSpwk=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:8 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/_e4zCcgrRdWrkQ0Lp4dDdxxCD-mBD14UPzGD3gm0sIWs4vqw5cecjqnahb-tL7_4VPrc"
          -getUrl(): string: "https://play-lh.googleusercontent.com/_e4zCcgrRdWrkQ0Lp4dDdxxCD-mBD14UPzGD3gm0sIWs4vqw5cecjqnahb-tL7_4VPrc"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/_e4zCcgrRdWrkQ0Lp4dDdxxCD-mBD14UPzGD3gm0sIWs4vqw5cecjqnahb-tL7_4VPrc=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/uZulu3Y729zkyXyHK_38xmUuIEZFKY_rQ4fV2-6DXfW8RHYmGs9GDRDnn_rlp_0ENCBP"
          -getUrl(): string: "https://play-lh.googleusercontent.com/uZulu3Y729zkyXyHK_38xmUuIEZFKY_rQ4fV2-6DXfW8RHYmGs9GDRDnn_rlp_0ENCBP"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/uZulu3Y729zkyXyHK_38xmUuIEZFKY_rQ4fV2-6DXfW8RHYmGs9GDRDnn_rlp_0ENCBP=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.031678
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "500,000,000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.google.android.apps.youtube.unplugged"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.youtube.unplugged"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.youtube.unplugged&hl=en_US&gl=us"
      -getName(): string: "YouTube TV: Live TV & more"
      -getDescription(): string: """
        • Cable-free live TV. No cable box required.\n
        • Watch major broadcast and cable networks, including ABC, CBS, FOX, NBC, NFL Network, ESPN, AMC, Univisi…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "Google LLC"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/gk-WYYED1OJNr0G28ucBPUTPric5QCLwW2q_rNcYg-XTQCbPkhcp3CqVJ-1dHiBql10"
        -getUrl(): string: "https://play-lh.googleusercontent.com/gk-WYYED1OJNr0G28ucBPUTPric5QCLwW2q_rNcYg-XTQCbPkhcp3CqVJ-1dHiBql10"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/gk-WYYED1OJNr0G28ucBPUTPric5QCLwW2q_rNcYg-XTQCbPkhcp3CqVJ-1dHiBql10=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:15 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/P-0BzvPbLYzXoPS5AnObWyrePFABTNpAqpBnC87cGPncCY_ImcPChV73Jokj8MlZ3g"
          -getUrl(): string: "https://play-lh.googleusercontent.com/P-0BzvPbLYzXoPS5AnObWyrePFABTNpAqpBnC87cGPncCY_ImcPChV73Jokj8MlZ3g"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/P-0BzvPbLYzXoPS5AnObWyrePFABTNpAqpBnC87cGPncCY_ImcPChV73Jokj8MlZ3g=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/vcWbsStnrJ2BwPkDXp1rG3EoRHY4JyhpK6aDfe51l6Mi8fZ71pCH-E5s5zSYQQjaBrVS"
          -getUrl(): string: "https://play-lh.googleusercontent.com/vcWbsStnrJ2BwPkDXp1rG3EoRHY4JyhpK6aDfe51l6Mi8fZ71pCH-E5s5zSYQQjaBrVS"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/vcWbsStnrJ2BwPkDXp1rG3EoRHY4JyhpK6aDfe51l6Mi8fZ71pCH-E5s5zSYQQjaBrVS=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 3.917587
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "10,000,000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    …
  ]
```

</details>

[Documentation](../../README.md) > [GPlayApps](README.md) > **getDeveloperApps**
