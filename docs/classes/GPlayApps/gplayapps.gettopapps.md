[Documentation](../../README.md) > [GPlayApps](README.md) > **getTopApps**

# Nelexa\GPlay\GPlayApps::getTopApps
`Nelexa\GPlay\GPlayApps::getTopApps` — Returns an array of **top apps** from the Google Play store for the specified category.

## Description
```php
Nelexa\GPlay\GPlayApps::getTopApps ( [ string | Nelexa\GPlay\Model\Category | Nelexa\GPlay\Enum\CategoryEnum | null $category = null ] [, Nelexa\GPlay\Enum\AgeEnum | null $age = null ] [, int $limit = -1 ] ) : Nelexa\GPlay\Model\App[]
```
[Nelexa\GPlay\Enum\CategoryEnum](../CategoryEnum/README.md) or
`null` for all categories

## Parameters
* **$category** (string | [Nelexa\GPlay\Model\Category](../Category/README.md) | [Nelexa\GPlay\Enum\CategoryEnum](../CategoryEnum/README.md) | null)  
application category as
string, [Nelexa\GPlay\Model\Category](../Category/README.md),
* **$age** ([Nelexa\GPlay\Enum\AgeEnum](../AgeEnum/README.md) | null)  
age limit or null for no limit
* **$limit** (int)  
limit on the number of results
or [Nelexa\GPlay\GPlayApps::UNLIMIT](README.md#predefined-constants)
for no limit

## Return Values
an array of applications with basic information


## Errors/Exceptions
* Throws [Nelexa\GPlay\Exception\GooglePlayException](../GooglePlayException/README.md)
## Examples
**Example 1. Gets top apps by category.**
```php
$apps = $gplay->getTopApps(\Nelexa\GPlay\Enum\CategoryEnum::GAME_RACING());
```
<details>
  <summary>Results</summary>

```php
array:314 [
    "com.easygames.race" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.easygames.race"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.easygames.race"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.easygames.race&hl=en_US&gl=us"
      -getName(): string: "Race Master 3D - Car Racing"
      -getSummary(): ?string: "Become a track master in the wackiest, wildest, winningest racing game!"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "6392896734092635573"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=6392896734092635573"
        -getName(): string: "SayGames Ltd"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/qW1SrW0Gyr3JRMNrTqMjFwcvZVjLP6-Wp2tDY8Z9UWzf2_XteCit8n9CNEGpnHOEFS8"
        -getUrl(): string: "https://play-lh.googleusercontent.com/qW1SrW0Gyr3JRMNrTqMjFwcvZVjLP6-Wp2tDY8Z9UWzf2_XteCit8n9CNEGpnHOEFS8"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/qW1SrW0Gyr3JRMNrTqMjFwcvZVjLP6-Wp2tDY8Z9UWzf2_XteCit8n9CNEGpnHOEFS8=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.3804564
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    "com.luna.theyarecoming" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.luna.theyarecoming"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.luna.theyarecoming"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.luna.theyarecoming&hl=en_US&gl=us"
      -getName(): string: "They Are Coming"
      -getSummary(): ?string: "Defeat all enemies and win!"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "6018074114375198913"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=6018074114375198913"
        -getName(): string: "Rollic Games"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/3YCNUp1tvYhjT5lBRdmUYRVp1GISq-g_8Uk8tdm4wLtRmZPnJljVa7OBnS8PPYdabx4"
        -getUrl(): string: "https://play-lh.googleusercontent.com/3YCNUp1tvYhjT5lBRdmUYRVp1GISq-g_8Uk8tdm4wLtRmZPnJljVa7OBnS8PPYdabx4"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/3YCNUp1tvYhjT5lBRdmUYRVp1GISq-g_8Uk8tdm4wLtRmZPnJljVa7OBnS8PPYdabx4=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 1.583815
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    …
  ]
```

</details>

**Example 1. Gets top apps from the GAMES category with an age limit of 6-8 years.**
```php
$apps = $gplay->getTopApps(
    $category = \Nelexa\GPlay\Enum\CategoryEnum::GAME(),
    $ageLimit = \Nelexa\GPlay\Enum\AgeEnum::SIX_EIGHT(),
    $limit = \Nelexa\GPlay\GPlayApps::UNLIMIT
);
```
<details>
  <summary>Results</summary>

```php
array:572 [
    "com.fusee.MergeMaster" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.fusee.MergeMaster"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.fusee.MergeMaster"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.fusee.MergeMaster&hl=en_US&gl=us"
      -getName(): string: "Merge Master - Dinosaur Fusion"
      -getSummary(): ?string: "Are you ready to fight and become a merge master?"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "4656343638685426415"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=4656343638685426415"
        -getName(): string: "HOMA GAMES"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/LUxutPFfkpuhZlK9mlBxlZI2J1ECDW-SPfNWnGtgENhasceP8r1vYNkwWf3-yHoZNII"
        -getUrl(): string: "https://play-lh.googleusercontent.com/LUxutPFfkpuhZlK9mlBxlZI2J1ECDW-SPfNWnGtgENhasceP8r1vYNkwWf3-yHoZNII"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/LUxutPFfkpuhZlK9mlBxlZI2J1ECDW-SPfNWnGtgENhasceP8r1vYNkwWf3-yHoZNII=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.043062
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    "com.arkhe.batteryrun" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.arkhe.batteryrun"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.arkhe.batteryrun"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.arkhe.batteryrun&hl=en_US&gl=us"
      -getName(): string: "Battery Run"
      -getSummary(): ?string: "Collect Batteries"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "VOODOO"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=VOODOO"
        -getName(): string: "VOODOO"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/D8hlXQPeRnqMlTxd3kkvaVtEuGoPIVtrJjsDDfkXlKc-81CTyLCcD8BJO_yJr8xNbA"
        -getUrl(): string: "https://play-lh.googleusercontent.com/D8hlXQPeRnqMlTxd3kkvaVtEuGoPIVtrJjsDDfkXlKc-81CTyLCcD8BJO_yJr8xNbA"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/D8hlXQPeRnqMlTxd3kkvaVtEuGoPIVtrJjsDDfkXlKc-81CTyLCcD8BJO_yJr8xNbA=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.0819674
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    …
  ]
```

</details>

**Example 1. Gets top apps from page https://play.google.com/store/apps/top**
```php
$apps = $gplay->getTopApps();
```
<details>
  <summary>Results</summary>

```php
array:1141 [
    "com.zhiliaoapp.musically" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.zhiliaoapp.musically"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.zhiliaoapp.musically"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.zhiliaoapp.musically&hl=en_US&gl=us"
      -getName(): string: "TikTok"
      -getSummary(): ?string: "Join your friends and discover videos you love, only on TikTok"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "TikTok Pte. Ltd."
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=TikTok+Pte.+Ltd."
        -getName(): string: "TikTok Pte. Ltd."
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/z5nin1RdQ4UZhv6fa1FNG7VE33imGqPgC4kKZIUjgf_up7E-Pj3AaojlMPwNNXaeGA"
        -getUrl(): string: "https://play-lh.googleusercontent.com/z5nin1RdQ4UZhv6fa1FNG7VE33imGqPgC4kKZIUjgf_up7E-Pj3AaojlMPwNNXaeGA"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/z5nin1RdQ4UZhv6fa1FNG7VE33imGqPgC4kKZIUjgf_up7E-Pj3AaojlMPwNNXaeGA=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.53434
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    "com.picture.magic.imager" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.picture.magic.imager"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.picture.magic.imager"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.picture.magic.imager&hl=en_US&gl=us"
      -getName(): string: "Magic Photo Editor:Foto Repair"
      -getSummary(): ?string: "Handy photo editor : photo repair & coloring"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "Zachary Holt"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=Zachary+Holt"
        -getName(): string: "Zachary Holt"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/eZHrfJNrI0_dfxVvk8Ng_qGPqLj9TVRTQpsozVN_RbLFymXirvboqTeP2rKUNi5gpg"
        -getUrl(): string: "https://play-lh.googleusercontent.com/eZHrfJNrI0_dfxVvk8Ng_qGPqLj9TVRTQpsozVN_RbLFymXirvboqTeP2rKUNi5gpg"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/eZHrfJNrI0_dfxVvk8Ng_qGPqLj9TVRTQpsozVN_RbLFymXirvboqTeP2rKUNi5gpg=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 3.7973423
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    …
  ]
```

</details>

## See Also
* [Nelexa\GPlay\GPlayApps::UNLIMIT](README.md#predefined-constants) - Limit for all available results.

[Documentation](../../README.md) > [GPlayApps](README.md) > **getTopApps**
