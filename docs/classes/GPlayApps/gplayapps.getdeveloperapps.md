# Nelexa\GPlay\GPlayApps::getDeveloperApps
`Nelexa\GPlay\GPlayApps::getDeveloperApps` — Returns an array of applications from the Google Play store by developer id.

## Description
```php
Nelexa\GPlay\GPlayApps::getDeveloperApps ( string | Nelexa\GPlay\Model\Developer | Nelexa\GPlay\Model\App $developerId ) : Nelexa\GPlay\Model\App[]
```

## Parameters
* **$developerId** (string | [Nelexa\GPlay\Model\Developer](../Developer/README.md) | [Nelexa\GPlay\Model\App](../App/README.md))  
developer id as string, [Nelexa\GPlay\Model\Developer](../Developer/README.md) or [Nelexa\GPlay\Model\App](../App/README.md) object

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
array:130 [
    0 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.google.android.projection.gearhead"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.projection.gearhead"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.projection.gearhead&hl=en_US&gl=us"
      -getName(): string: "Android Auto - Google Maps, Media & Messaging"
      -getSummary(): ?string: "Control maps, media and messaging, with the Google Assistant while you drive"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "5700313618786177705"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=5700313618786177705"
        -getName(): string: "Google LLC"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/drnkC46hMwqPTdRLLLufhKgy_dRhA7uNTN14-tq2NxtI3deDakYOAR_4zeHcqbGg4Q"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/drnkC46hMwqPTdRLLLufhKgy_dRhA7uNTN14-tq2NxtI3deDakYOAR_4zeHcqbGg4Q=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/drnkC46hMwqPTdRLLLufhKgy_dRhA7uNTN14-tq2NxtI3deDakYOAR_4zeHcqbGg4Q"
      }
      -getScore(): float: 4.1934695
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    1 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.google.android.play.games"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.play.games"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.play.games&hl=en_US&gl=us"
      -getName(): string: "Google Play Games"
      -getSummary(): ?string: "Play games instantly, save progress, and earn achievements."
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "5700313618786177705"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=5700313618786177705"
        -getName(): string: "Google LLC"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/szHQCpMAb0MikYIhvNG1MlruXFUggd6DJHXkMPG1H4lJPB7Lee_BkODfwxpQazxfO9mA"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/szHQCpMAb0MikYIhvNG1MlruXFUggd6DJHXkMPG1H4lJPB7Lee_BkODfwxpQazxfO9mA=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/szHQCpMAb0MikYIhvNG1MlruXFUggd6DJHXkMPG1H4lJPB7Lee_BkODfwxpQazxfO9mA"
      }
      -getScore(): float: 4.353653
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    …
  ]
```

</details>

