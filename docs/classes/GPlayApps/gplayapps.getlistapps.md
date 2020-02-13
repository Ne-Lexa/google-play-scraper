# Nelexa\GPlay\GPlayApps::getListApps
`Nelexa\GPlay\GPlayApps::getListApps` — Returns an array of applications from the Google Play store for the specified category.

## Description
```php
Nelexa\GPlay\GPlayApps::getListApps ( [ string | Nelexa\GPlay\Model\Category | Nelexa\GPlay\Enum\CategoryEnum | null $category = null ] [, Nelexa\GPlay\Enum\AgeEnum | null $age = null ] [, int $limit = -1 ] ) : Nelexa\GPlay\Model\App[]
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
**Example 1. Gets apps by category.**
```php
$apps = $gplay->getListApps(\Nelexa\GPlay\Enum\CategoryEnum::GAME_RACING());
```
<details>
  <summary>Results</summary>

```php
array:180 [
    "com.x3m.tx4" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.x3m.tx4"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.x3m.tx4"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.x3m.tx4&hl=en_US&gl=us"
      -getName(): string: "Trial Xtreme 4: extreme bike racing champions"
      -getSummary(): ?string: "Less than 1% of the players managed to achieve ⭐⭐⭐ on all levels - can you?"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "5042939762592943088"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=5042939762592943088"
        -getName(): string: "Deemedya INC"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/3JzjZwWDGuk49msstnvR3k7tjd7vo_461jLMMiZIdvxlz_lhF6oXF0Ws4s_8599hdrBL"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/3JzjZwWDGuk49msstnvR3k7tjd7vo_461jLMMiZIdvxlz_lhF6oXF0Ws4s_8599hdrBL=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/3JzjZwWDGuk49msstnvR3k7tjd7vo_461jLMMiZIdvxlz_lhF6oXF0Ws4s_8599hdrBL"
      }
      -getScore(): float: 4.247471
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    "com.herocraft.game.free.deadparadise" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.herocraft.game.free.deadparadise"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.herocraft.game.free.deadparadise"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.herocraft.game.free.deadparadise&hl=en_US&gl=us"
      -getName(): string: "Dead Paradise: Race Shooter"
      -getSummary(): ?string: "Race Shooter, Destruction, Cars Upgrades, Win The Death Race!"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "5866306697629323411"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=5866306697629323411"
        -getName(): string: "SMOKOKO LTD"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/S0FPKiVK7AwibF8dZC3LvZAFXl-ugmqup3e6UImS67zqdyu4N30KadzpokZMfI_Ilu8"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/S0FPKiVK7AwibF8dZC3LvZAFXl-ugmqup3e6UImS67zqdyu4N30KadzpokZMfI_Ilu8=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/S0FPKiVK7AwibF8dZC3LvZAFXl-ugmqup3e6UImS67zqdyu4N30KadzpokZMfI_Ilu8"
      }
      -getScore(): float: 4.531811
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    …
  ]
```

</details>

**Example 1. Gets applications from the GAMES category with an age limit of 6-8 years.**
```php
$apps = $gplay->getListApps(
    $category = \Nelexa\GPlay\Enum\CategoryEnum::GAME(),
    $ageLimit = \Nelexa\GPlay\Enum\AgeEnum::SIX_EIGHT(),
    $limit = 100
);
```
<details>
  <summary>Results</summary>

```php
array:100 [
    "net.wooga.junes_journey_hidden_object_mystery_game" => class Nelexa\GPlay\Model\App {
      -getId(): string: "net.wooga.junes_journey_hidden_object_mystery_game"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=net.wooga.junes_journey_hidden_object_mystery_game"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=net.wooga.junes_journey_hidden_object_mystery_game&hl=en_US&gl=us"
      -getName(): string: "June's Journey - Hidden Objects"
      -getSummary(): ?string: "Find hidden objects in stunning vintage scenes to solve mind-teasing mysteries"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "5187629073610793871"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=5187629073610793871"
        -getName(): string: "Wooga"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/jq_PkkiyZGyEOx9eGgCVTU3Oyv2zHAea13zSxgj_9al0Rc_cp2PxWAySj1ywjpJ3y4U"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/jq_PkkiyZGyEOx9eGgCVTU3Oyv2zHAea13zSxgj_9al0Rc_cp2PxWAySj1ywjpJ3y4U=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/jq_PkkiyZGyEOx9eGgCVTU3Oyv2zHAea13zSxgj_9al0Rc_cp2PxWAySj1ywjpJ3y4U"
      }
      -getScore(): float: 4.6209693
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    "com.ea.games.simsfreeplay_row" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.ea.games.simsfreeplay_row"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.ea.games.simsfreeplay_row"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.ea.games.simsfreeplay_row&hl=en_US&gl=us"
      -getName(): string: "The Sims FreePlay"
      -getSummary(): ?string: "What’s your story? Create and customize every aspect of your Sims’ lives!"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "6605125519975771237"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=6605125519975771237"
        -getName(): string: "ELECTRONIC ARTS"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/0KahR-oT7Q6ziHAEru_KHYcrz8s7x_egKpm8RPqg1uuLmYpuri7qdMhnWHtUJq5NKNs"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/0KahR-oT7Q6ziHAEru_KHYcrz8s7x_egKpm8RPqg1uuLmYpuri7qdMhnWHtUJq5NKNs=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/0KahR-oT7Q6ziHAEru_KHYcrz8s7x_egKpm8RPqg1uuLmYpuri7qdMhnWHtUJq5NKNs"
      }
      -getScore(): float: 3.9615788
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    …
  ]
```

</details>

**Example 1. Gets applications from page https://play.google.com/store/apps**
```php
$apps = $gplay->getListApps();
```
<details>
  <summary>Results</summary>

```php
array:682 [
    "com.whatsapp" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.whatsapp"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.whatsapp"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.whatsapp&hl=en_US&gl=us"
      -getName(): string: "WhatsApp Messenger"
      -getSummary(): ?string: "Simple. Personal. Secure."
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "WhatsApp Inc."
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=WhatsApp+Inc."
        -getName(): string: "WhatsApp Inc."
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
        -getUrl(): string: "https://lh3.googleusercontent.com/bYtqbOcTYOlgc6gqZ2rwb8lptHuwlNE75zYJu6Bn076-hTmvd96HH-6v7S0YUAAJXoJN"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/bYtqbOcTYOlgc6gqZ2rwb8lptHuwlNE75zYJu6Bn076-hTmvd96HH-6v7S0YUAAJXoJN=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/bYtqbOcTYOlgc6gqZ2rwb8lptHuwlNE75zYJu6Bn076-hTmvd96HH-6v7S0YUAAJXoJN"
      }
      -getScore(): float: 4.2857103
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    "com.vkontakte.android" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.vkontakte.android"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.vkontakte.android"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.vkontakte.android&hl=en_US&gl=us"
      -getName(): string: "VK — live chatting & free calls"
      -getSummary(): ?string: "Social network with text messaging and photo stories"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "VK.com"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=VK.com"
        -getName(): string: "VK.com"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/bgAuxUGArC8zH3NLJip3hn7CJur37IRotIqB5Xly--Zind-JD9r-ndCj30b1Wec7aOQ"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/bgAuxUGArC8zH3NLJip3hn7CJur37IRotIqB5Xly--Zind-JD9r-ndCj30b1Wec7aOQ=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/bgAuxUGArC8zH3NLJip3hn7CJur37IRotIqB5Xly--Zind-JD9r-ndCj30b1Wec7aOQ"
      }
      -getScore(): float: 3.7000844
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
