[Documentation](../../README.md) > [GPlayApps](README.md) > **getNewApps**

# Nelexa\GPlay\GPlayApps::getNewApps
`Nelexa\GPlay\GPlayApps::getNewApps` — Returns an array of **new apps** from the Google Play store for the specified category.

## Description
```php
Nelexa\GPlay\GPlayApps::getNewApps ( [ string | Nelexa\GPlay\Model\Category | Nelexa\GPlay\Enum\CategoryEnum | null $category = null ] [, Nelexa\GPlay\Enum\AgeEnum | null $age = null ] [, int $limit = -1 ] ) : Nelexa\GPlay\Model\App[]
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
**Example 1. Gets new apps by category.**
```php
$apps = $gplay->getNewApps(\Nelexa\GPlay\Enum\CategoryEnum::GAME_RACING());
```
<details>
  <summary>Results</summary>

```php
array:108 [
    "com.zerosum.coupleshuffle" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.zerosum.coupleshuffle"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.zerosum.coupleshuffle"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.zerosum.coupleshuffle&hl=en_US&gl=us"
      -getName(): string: "Couple Shuffle"
      -getSummary(): ?string: "Couple's Money Adventure"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "5006687761269120821"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=5006687761269120821"
        -getName(): string: "Zerosum"
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
        -__toString(): string: "https://play-lh.googleusercontent.com/pJkzrkGuRs4wfW8En1adLZgYXD8fk5bR5Jq7vE_6S_tjKRDzll3_RAM35f80qQBy"
        -getUrl(): string: "https://play-lh.googleusercontent.com/pJkzrkGuRs4wfW8En1adLZgYXD8fk5bR5Jq7vE_6S_tjKRDzll3_RAM35f80qQBy"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/pJkzrkGuRs4wfW8En1adLZgYXD8fk5bR5Jq7vE_6S_tjKRDzll3_RAM35f80qQBy=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 1.5
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    "com.DogukanKurekci.ShootNDoor" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.DogukanKurekci.ShootNDoor"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.DogukanKurekci.ShootNDoor"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.DogukanKurekci.ShootNDoor&hl=en_US&gl=us"
      -getName(): string: "Shoot N Door"
      -getSummary(): ?string: "The most creative and fun way to shoot. You can do anything by shooting."
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "F13 Entertainment"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=F13+Entertainment"
        -getName(): string: "F13 Entertainment"
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
        -__toString(): string: "https://play-lh.googleusercontent.com/6zNZbPZLnbQ4hyiVf4Sb5WGQA-ROQQb_qfGEcVzwOoUjJePHDp1uNoKO3yt6ReG1fbA"
        -getUrl(): string: "https://play-lh.googleusercontent.com/6zNZbPZLnbQ4hyiVf4Sb5WGQA-ROQQb_qfGEcVzwOoUjJePHDp1uNoKO3yt6ReG1fbA"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/6zNZbPZLnbQ4hyiVf4Sb5WGQA-ROQQb_qfGEcVzwOoUjJePHDp1uNoKO3yt6ReG1fbA=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 1.8666667
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    …
  ]
```

</details>

**Example 1. Gets new apps from the GAMES category with an age limit of 6-8 years.**
```php
$apps = $gplay->getNewApps(
    $category = \Nelexa\GPlay\Enum\CategoryEnum::GAME(),
    $ageLimit = \Nelexa\GPlay\Enum\AgeEnum::SIX_EIGHT(),
    $limit = \Nelexa\GPlay\GPlayApps::UNLIMIT
);
```
<details>
  <summary>Results</summary>

```php
array:202 [
    "com.jura.freddy.rope.five.night" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.jura.freddy.rope.five.night"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.jura.freddy.rope.five.night"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.jura.freddy.rope.five.night&hl=en_US&gl=us"
      -getName(): string: "Bear Rope Hero, Security City"
      -getSummary(): ?string: "Find gangster snipers at the building's and kill them"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "5891027934210113676"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=5891027934210113676"
        -getName(): string: "Zego Global Publishing"
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
        -__toString(): string: "https://play-lh.googleusercontent.com/9lIZMexQDGYxh82g176ql3r054cGFcXHNB6qVxtTcb_XMPbqwFLcEivK6vkx-DT-nw"
        -getUrl(): string: "https://play-lh.googleusercontent.com/9lIZMexQDGYxh82g176ql3r054cGFcXHNB6qVxtTcb_XMPbqwFLcEivK6vkx-DT-nw"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/9lIZMexQDGYxh82g176ql3r054cGFcXHNB6qVxtTcb_XMPbqwFLcEivK6vkx-DT-nw=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.390244
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    "com.brain.snake.thief.troll" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.brain.snake.thief.troll"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.brain.snake.thief.troll"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.brain.snake.thief.troll&hl=en_US&gl=us"
      -getName(): string: "Snake Troll : Thief master"
      -getSummary(): ?string: "Use your brain to steal them all"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "ABI Global Publishing"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=ABI+Global+Publishing"
        -getName(): string: "ABI Global Publishing"
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
        -__toString(): string: "https://play-lh.googleusercontent.com/jVHQZOe6aEpYsjObeByIWJcOLJMt9_VGmSSBxLgAPgs2JakXt6vW6lJybpKi9J-kAn8"
        -getUrl(): string: "https://play-lh.googleusercontent.com/jVHQZOe6aEpYsjObeByIWJcOLJMt9_VGmSSBxLgAPgs2JakXt6vW6lJybpKi9J-kAn8"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/jVHQZOe6aEpYsjObeByIWJcOLJMt9_VGmSSBxLgAPgs2JakXt6vW6lJybpKi9J-kAn8=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 3.5714285
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    …
  ]
```

</details>

**Example 1. Gets new apps from page https://play.google.com/store/apps/new**
```php
$apps = $gplay->getNewApps();
```
<details>
  <summary>Results</summary>

```php
array:411 [
    "com.speedfiymax.app" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.speedfiymax.app"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.speedfiymax.app"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.speedfiymax.app&hl=en_US&gl=us"
      -getName(): string: "MaxSpeedfiy-Unlimited&Easy"
      -getSummary(): ?string: "Simple, fast and easy-to-use high-speed proxy"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "PRIME DIGITAL PTE. LTD."
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=PRIME+DIGITAL+PTE.+LTD."
        -getName(): string: "PRIME DIGITAL PTE. LTD."
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
        -__toString(): string: "https://play-lh.googleusercontent.com/um1SUFZ4MvJ6heUV-h6Ygt23X1gQhw9b5Gk38enw387Ke4xXGh2ixgFt8Y-Q1tXOTAg"
        -getUrl(): string: "https://play-lh.googleusercontent.com/um1SUFZ4MvJ6heUV-h6Ygt23X1gQhw9b5Gk38enw387Ke4xXGh2ixgFt8Y-Q1tXOTAg"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/um1SUFZ4MvJ6heUV-h6Ygt23X1gQhw9b5Gk38enw387Ke4xXGh2ixgFt8Y-Q1tXOTAg=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.5064936
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    "com.Blingwallpaper.hd" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.Blingwallpaper.hd"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.Blingwallpaper.hd"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.Blingwallpaper.hd&hl=en_US&gl=us"
      -getName(): string: "Bling Wallpeper-live,4K,HD"
      -getSummary(): ?string: "Easy，4K,HD，Livewallpaper"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "swmail9@gmail.com"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=swmail9@gmail.com"
        -getName(): string: "swmail9@gmail.com"
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
        -__toString(): string: "https://play-lh.googleusercontent.com/-NL_6qpT4ETIEg5k5z2Sq3x-8LLfabt-GleIkTvfjyv2UitZ0hsRoRAXjVCqLyiOdg"
        -getUrl(): string: "https://play-lh.googleusercontent.com/-NL_6qpT4ETIEg5k5z2Sq3x-8LLfabt-GleIkTvfjyv2UitZ0hsRoRAXjVCqLyiOdg"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/-NL_6qpT4ETIEg5k5z2Sq3x-8LLfabt-GleIkTvfjyv2UitZ0hsRoRAXjVCqLyiOdg=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 3.0
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

[Documentation](../../README.md) > [GPlayApps](README.md) > **getNewApps**
