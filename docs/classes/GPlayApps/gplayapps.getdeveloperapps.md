[Documentation](../../README.md) > [GPlayApps](README.md) > **getDeveloperApps**

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
array:129 [
    0 => class Nelexa\GPlay\Model\App {
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
      -getScore(): float: 4.354707
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    1 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.google.android.apps.youtube.music"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.youtube.music"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.youtube.music&hl=en_US&gl=us"
      -getName(): string: "YouTube Music - Stream Songs & Music Videos"
      -getSummary(): ?string: "The official YouTube app built just for music."
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
        -getUrl(): string: "https://lh3.googleusercontent.com/GnYnNfKBr2nysHBYgYRCQtcv_RRNN0Sosn47F5ArKJu89DMR3_jHRAazoIVsPUoaMg"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/GnYnNfKBr2nysHBYgYRCQtcv_RRNN0Sosn47F5ArKJu89DMR3_jHRAazoIVsPUoaMg=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/GnYnNfKBr2nysHBYgYRCQtcv_RRNN0Sosn47F5ArKJu89DMR3_jHRAazoIVsPUoaMg"
      }
      -getScore(): float: 4.123365
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    …
  ]
```

</details>

[Documentation](../../README.md) > [GPlayApps](README.md) > **getDeveloperApps**
