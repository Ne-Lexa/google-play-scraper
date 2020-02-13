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
array:50 [
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
      -getScore(): float: 3.9453926
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
      -getScore(): float: 4.3361487
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
array:206 [
    "com.maroieqrwlk.unpin" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.maroieqrwlk.unpin"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.maroieqrwlk.unpin"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.maroieqrwlk.unpin&hl=en_US&gl=us"
      -getName(): string: "Pull the Pin"
      -getSummary(): ?string: "Can you reach the pinnacle?"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "7948217467540814816"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=7948217467540814816"
        -getName(): string: "Popcore Games"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/1f8VVY8jrDNERyXOSGm_f_yKfpSg3wiZYrBXuojLSpCTUdCpyIt9sA6aCOWa1EDUt3OK"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/1f8VVY8jrDNERyXOSGm_f_yKfpSg3wiZYrBXuojLSpCTUdCpyIt9sA6aCOWa1EDUt3OK=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/1f8VVY8jrDNERyXOSGm_f_yKfpSg3wiZYrBXuojLSpCTUdCpyIt9sA6aCOWa1EDUt3OK"
      }
      -getScore(): float: 3.4897423
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
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
      -getScore(): float: 3.9453926
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
array:404 [
    "com.ledflash.phonecall.colorcallerscreen" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.ledflash.phonecall.colorcallerscreen"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.ledflash.phonecall.colorcallerscreen"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.ledflash.phonecall.colorcallerscreen&hl=en_US&gl=us"
      -getName(): string: "Color Caller Screen:  LED Flash Alert & Flashlight"
      -getSummary(): ?string: "LED call flash and flashlight application"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "GoodTool"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=GoodTool"
        -getName(): string: "GoodTool"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/OWMr9ORfJq5R010ZH-AiIczsYf-w8tP5dQ3X0Hdk8A6AZsDRl3vQBVoxvQqlNsLqWKRp"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/OWMr9ORfJq5R010ZH-AiIczsYf-w8tP5dQ3X0Hdk8A6AZsDRl3vQBVoxvQqlNsLqWKRp=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/OWMr9ORfJq5R010ZH-AiIczsYf-w8tP5dQ3X0Hdk8A6AZsDRl3vQBVoxvQqlNsLqWKRp"
      }
      -getScore(): float: 1.5137615
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    "com.constellation.facefuture" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.constellation.facefuture"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.constellation.facefuture"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.constellation.facefuture&hl=en_US&gl=us"
      -getName(): string: "Face Secret"
      -getSummary(): ?string: "Face Secret"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "rich2020"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=rich2020"
        -getName(): string: "rich2020"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/Gl7agzUItoi_i6PEn7jCkNkIoL_wI-5G1J3rbChM2JQBpMxbxELajHzEIffDT9cSKlM"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/Gl7agzUItoi_i6PEn7jCkNkIoL_wI-5G1J3rbChM2JQBpMxbxELajHzEIffDT9cSKlM=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/Gl7agzUItoi_i6PEn7jCkNkIoL_wI-5G1J3rbChM2JQBpMxbxELajHzEIffDT9cSKlM"
      }
      -getScore(): float: 2.85
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
