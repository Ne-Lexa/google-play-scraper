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
application category as string, [Nelexa\GPlay\Model\Category](../Category/README.md),
* **$age** ([Nelexa\GPlay\Enum\AgeEnum](../AgeEnum/README.md) | null)  
age limit or null for no limit
* **$limit** (int)  
limit on the number of results or [Nelexa\GPlay\GPlayApps::UNLIMIT](README.md#predefined-constants) for no limit

## Return Values
an array of applications with basic information

## Examples
**Example 1. Gets new apps by category.**
```php
$apps = $gplay->getNewApps(\Nelexa\GPlay\Enum\CategoryEnum::GAME_RACING());
```
<details>
  <summary>Results</summary>

```php
array:47 [
    "com.gym.racegame" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.gym.racegame"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.gym.racegame"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.gym.racegame&hl=en_US&gl=us"
      -getName(): string: "Epic Race 3D"
      -getSummary(): ?string: "50% Luck, 70% Skill, 30% Will"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "Good Job Games"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=Good+Job+Games"
        -getName(): string: "Good Job Games"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/u8Qv75lvrmBbv0kyDHnjX5Xi1g8SIUN5wOfKJXi3wVukaINv2lFuvr0MUl5FJelbKg2b"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/u8Qv75lvrmBbv0kyDHnjX5Xi1g8SIUN5wOfKJXi3wVukaINv2lFuvr0MUl5FJelbKg2b=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/u8Qv75lvrmBbv0kyDHnjX5Xi1g8SIUN5wOfKJXi3wVukaINv2lFuvr0MUl5FJelbKg2b"
      }
      -getScore(): float: 3.8746777
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    "com.fancyforce.happywheels" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.fancyforce.happywheels"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.fancyforce.happywheels"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.fancyforce.happywheels&hl=en_US&gl=us"
      -getName(): string: "Happy Wheels"
      -getSummary(): ?string: "Happy Wheels is an intense, side-scrolling, physics-based, obstacle course game."
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "James Bonacci"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=James+Bonacci"
        -getName(): string: "James Bonacci"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/SV8RsV5udSeeONjatT5SwleP6lzV6PjtNPs2VvyohJXWSG9fFLNOfslDEHbpDN337wQ"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/SV8RsV5udSeeONjatT5SwleP6lzV6PjtNPs2VvyohJXWSG9fFLNOfslDEHbpDN337wQ=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/SV8RsV5udSeeONjatT5SwleP6lzV6PjtNPs2VvyohJXWSG9fFLNOfslDEHbpDN337wQ"
      }
      -getScore(): float: 4.3360324
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
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
array:188 [
    "com.appadvisory.drawclimber" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.appadvisory.drawclimber"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.appadvisory.drawclimber"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.appadvisory.drawclimber&hl=en_US&gl=us"
      -getName(): string: "Draw Climber"
      -getSummary(): ?string: "Draw your legs to win the race!"
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
        -jsonSerialize(): mixed: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/0tq7Z4-FvJd9rpPPIztraZcxoRsfX_U_6sH7Z5x_EdW3O-XyPUjXBkOLQprHgj0NJzQx"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/0tq7Z4-FvJd9rpPPIztraZcxoRsfX_U_6sH7Z5x_EdW3O-XyPUjXBkOLQprHgj0NJzQx=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/0tq7Z4-FvJd9rpPPIztraZcxoRsfX_U_6sH7Z5x_EdW3O-XyPUjXBkOLQprHgj0NJzQx"
      }
      -getScore(): float: 3.24
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    "com.HeroGames.WoodShop" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.HeroGames.WoodShop"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.HeroGames.WoodShop"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.HeroGames.WoodShop&hl=en_US&gl=us"
      -getName(): string: "Wood Shop"
      -getSummary(): ?string: "Satisfying Wood Carving Art"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "Rollic Games"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=Rollic+Games"
        -getName(): string: "Rollic Games"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/C3ztBVoJujqMojs59g4RLQHHpJD2K5wNikV9RBNAFtDd54_3fp_-jRUXC9h1SzXLRj4F"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/C3ztBVoJujqMojs59g4RLQHHpJD2K5wNikV9RBNAFtDd54_3fp_-jRUXC9h1SzXLRj4F=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/C3ztBVoJujqMojs59g4RLQHHpJD2K5wNikV9RBNAFtDd54_3fp_-jRUXC9h1SzXLRj4F"
      }
      -getScore(): float: 2.148289
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
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
array:399 [
    "com.fnaps.mod.addon" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.fnaps.mod.addon"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.fnaps.mod.addon"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.fnaps.mod.addon&hl=en_US&gl=us"
      -getName(): string: "Mod Freddy for MCPE"
      -getSummary(): ?string: "Download and install fnap mod for MCPE."
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "Seepaul"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=Seepaul"
        -getName(): string: "Seepaul"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/Rk0zW4o7HzcmU0skttNNSYcv-EIqsmPwVsNZp4lu2CUZEoMdlCctvXm2U_qtSlZT9BU"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/Rk0zW4o7HzcmU0skttNNSYcv-EIqsmPwVsNZp4lu2CUZEoMdlCctvXm2U_qtSlZT9BU=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/Rk0zW4o7HzcmU0skttNNSYcv-EIqsmPwVsNZp4lu2CUZEoMdlCctvXm2U_qtSlZT9BU"
      }
      -getScore(): float: 4.27
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    "com.video.magician" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.video.magician"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.video.magician"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.video.magician&hl=en_US&gl=us"
      -getName(): string: "Video Magician"
      -getSummary(): ?string: "Video Magician"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "More Money more"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=More+Money+more"
        -getName(): string: "More Money more"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/2OhNoYN55Op82vBizSjzRpAbH9w28YtDnZroZZCIU_eCFNfyPxgygKonWxc4V-wr178a"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/2OhNoYN55Op82vBizSjzRpAbH9w28YtDnZroZZCIU_eCFNfyPxgygKonWxc4V-wr178a=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/2OhNoYN55Op82vBizSjzRpAbH9w28YtDnZroZZCIU_eCFNfyPxgygKonWxc4V-wr178a"
      }
      -getScore(): float: 2.1
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

[Documentation](../../README.md) > [GPlayApps](README.md) > **getNewApps**
