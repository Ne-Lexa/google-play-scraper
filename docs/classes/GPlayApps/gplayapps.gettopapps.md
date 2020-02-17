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
application category as string, [Nelexa\GPlay\Model\Category](../Category/README.md),
* **$age** ([Nelexa\GPlay\Enum\AgeEnum](../AgeEnum/README.md) | null)  
age limit or null for no limit
* **$limit** (int)  
limit on the number of results or [Nelexa\GPlay\GPlayApps::UNLIMIT](README.md#predefined-constants) for no limit

## Return Values
an array of applications with basic information

## Examples
**Example 1. Gets top apps by category.**
```php
$apps = $gplay->getTopApps(\Nelexa\GPlay\Enum\CategoryEnum::GAME_RACING());
```
<details>
  <summary>Results</summary>

```php
array:280 [
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
    "com.slippy.linerusher" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.slippy.linerusher"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.slippy.linerusher"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.slippy.linerusher&hl=en_US&gl=us"
      -getName(): string: "Fun Race 3D"
      -getSummary(): ?string: "Once You Start, You Can’t Stop"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/9OjEvPQm7nJ83ZXqMsPV2UZCRzVw4_un-aAGdbqkwV-Wk3oT9iqFshmeiLTHvbMPkgk"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/9OjEvPQm7nJ83ZXqMsPV2UZCRzVw4_un-aAGdbqkwV-Wk3oT9iqFshmeiLTHvbMPkgk=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/9OjEvPQm7nJ83ZXqMsPV2UZCRzVw4_un-aAGdbqkwV-Wk3oT9iqFshmeiLTHvbMPkgk"
      }
      -getScore(): float: 4.1582165
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
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
array:530 [
    "com.BallGames.Woodturning" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.BallGames.Woodturning"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.BallGames.Woodturning"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.BallGames.Woodturning&hl=en_US&gl=us"
      -getName(): string: "Woodturning"
      -getSummary(): ?string: "One lathe to rule them all"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/p_TPhF6yEel0S1DklaU9vRg4jHnLQx212O0J9WQfvqo_EpaMuW3lTBEngJEx2yj31AQ"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/p_TPhF6yEel0S1DklaU9vRg4jHnLQx212O0J9WQfvqo_EpaMuW3lTBEngJEx2yj31AQ=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/p_TPhF6yEel0S1DklaU9vRg4jHnLQx212O0J9WQfvqo_EpaMuW3lTBEngJEx2yj31AQ"
      }
      -getScore(): float: 3.7703204
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    "com.trianglegames.squarebird" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.trianglegames.squarebird"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.trianglegames.squarebird"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.trianglegames.squarebird&hl=en_US&gl=us"
      -getName(): string: "Square Bird"
      -getSummary(): ?string: "Build the perfect egg tower!"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "MOONEE PUBLISHING LTD"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=MOONEE+PUBLISHING+LTD"
        -getName(): string: "MOONEE PUBLISHING LTD"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/-tinv3wt-7QR6cNYu3fLw5ySktJ0Mb5iydk5QIAPphFkvBuE-xwFuxsy57IGY5lVSQM"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/-tinv3wt-7QR6cNYu3fLw5ySktJ0Mb5iydk5QIAPphFkvBuE-xwFuxsy57IGY5lVSQM=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/-tinv3wt-7QR6cNYu3fLw5ySktJ0Mb5iydk5QIAPphFkvBuE-xwFuxsy57IGY5lVSQM"
      }
      -getScore(): float: 4.1803513
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
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
array:1074 [
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
      -getScore(): float: 4.28501
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    "com.zhiliaoapp.musically" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.zhiliaoapp.musically"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.zhiliaoapp.musically"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.zhiliaoapp.musically&hl=en_US&gl=us"
      -getName(): string: "TikTok - Make Your Day"
      -getSummary(): ?string: "Real People. Real Videos."
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "TikTok Inc."
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=TikTok+Inc."
        -getName(): string: "TikTok Inc."
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
        -getUrl(): string: "https://lh3.googleusercontent.com/iBYjvYuNq8BB7EEEHktPG1fpX9NiY7Jcyg1iRtQxO442r9CZ8H-X9cLkTjpbORwWDG9d"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/iBYjvYuNq8BB7EEEHktPG1fpX9NiY7Jcyg1iRtQxO442r9CZ8H-X9cLkTjpbORwWDG9d=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/iBYjvYuNq8BB7EEEHktPG1fpX9NiY7Jcyg1iRtQxO442r9CZ8H-X9cLkTjpbORwWDG9d"
      }
      -getScore(): float: 4.581792
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

[Documentation](../../README.md) > [GPlayApps](README.md) > **getTopApps**
