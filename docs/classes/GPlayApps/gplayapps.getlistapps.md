[Documentation](../../README.md) > [GPlayApps](README.md) > **getListApps**

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
array:169 [
    "com.combineinc.streetracing.driftthreeD" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.combineinc.streetracing.driftthreeD"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.combineinc.streetracing.driftthreeD"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.combineinc.streetracing.driftthreeD&hl=en_US&gl=us"
      -getName(): string: "Street Racing 3D"
      -getSummary(): ?string: "Street car racing has started, experience the drving skills!"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "6936794375735348055"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=6936794375735348055"
        -getName(): string: "Ivy"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/xzMuAO5HWhJgEQlZd9qn_A1LK21FXOED2HVVqEh9uce-e9G8unFR5Vb8Xaq4nZuw06A"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/xzMuAO5HWhJgEQlZd9qn_A1LK21FXOED2HVVqEh9uce-e9G8unFR5Vb8Xaq4nZuw06A=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/xzMuAO5HWhJgEQlZd9qn_A1LK21FXOED2HVVqEh9uce-e9G8unFR5Vb8Xaq4nZuw06A"
      }
      -getScore(): float: 4.363952
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    "com.gameloft.android.ANMP.GloftA9HM" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.gameloft.android.ANMP.GloftA9HM"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.gameloft.android.ANMP.GloftA9HM"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.gameloft.android.ANMP.GloftA9HM&hl=en_US&gl=us"
      -getName(): string: "Asphalt 9: Legends - Epic Car Action Racing Game"
      -getSummary(): ?string: "Tear up the Asphalt & become the next Legend in the ultimate arcade racing game."
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "4826827787946964969"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=4826827787946964969"
        -getName(): string: "Gameloft SE"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/cQBJ7Jwvz0jex8sL7LjgLId-wOdmMajSZbpC-bzHDhS5uK9Zms0fFsXEVNGvlIUk_g"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/cQBJ7Jwvz0jex8sL7LjgLId-wOdmMajSZbpC-bzHDhS5uK9Zms0fFsXEVNGvlIUk_g=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/cQBJ7Jwvz0jex8sL7LjgLId-wOdmMajSZbpC-bzHDhS5uK9Zms0fFsXEVNGvlIUk_g"
      }
      -getScore(): float: 4.5014334
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
    "com.gameloft.car.tycoon.game" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.gameloft.car.tycoon.game"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.gameloft.car.tycoon.game"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.gameloft.car.tycoon.game&hl=en_US&gl=us"
      -getName(): string: "Overdrive City – Car Tycoon Game"
      -getSummary(): ?string: "Build your car city and race! (Install requires 2.5 GB of disk space.)"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "4826827787946964969"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=4826827787946964969"
        -getName(): string: "Gameloft SE"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/PctrUsXkExv1coL2YyoaQSPmYGzuqhBROWpDOCxEhA0a9jeEzl0kD580jlZCeV9CoGg"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/PctrUsXkExv1coL2YyoaQSPmYGzuqhBROWpDOCxEhA0a9jeEzl0kD580jlZCeV9CoGg=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/PctrUsXkExv1coL2YyoaQSPmYGzuqhBROWpDOCxEhA0a9jeEzl0kD580jlZCeV9CoGg"
      }
      -getScore(): float: 4.3102565
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    "com.igg.android.mobileroyale" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.igg.android.mobileroyale"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.igg.android.mobileroyale"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.igg.android.mobileroyale&hl=en_US&gl=us"
      -getName(): string: "Mobile Royale MMORPG - Build a Strategy for Battle"
      -getSummary(): ?string: "Enjoy this 3D fantasy world! Fight in a RTS multiplayer battle, build your city!"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "8895734616362643252"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=8895734616362643252"
        -getName(): string: "IGG.COM"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/iBHuomMtanzz3EIEARbv-x-_FmKBqCg-m7iYj2daqYYrYBOSJ6isDeiDixHl4i4J1fM"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/iBHuomMtanzz3EIEARbv-x-_FmKBqCg-m7iYj2daqYYrYBOSJ6isDeiDixHl4i4J1fM=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/iBHuomMtanzz3EIEARbv-x-_FmKBqCg-m7iYj2daqYYrYBOSJ6isDeiDixHl4i4J1fM"
      }
      -getScore(): float: 4.0906167
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
array:600 [
    "com.water.balls" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.water.balls"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.water.balls"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.water.balls&hl=en_US&gl=us"
      -getName(): string: "Sand Balls"
      -getSummary(): ?string: "Collect all balls!"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "SayGames"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=SayGames"
        -getName(): string: "SayGames"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/U0hk5TisL-gYTm2anJElHtaNrJ52NdJnEjPjyygRnAXERW_tv2yo-wAVUM3sVIguf4CC"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/U0hk5TisL-gYTm2anJElHtaNrJ52NdJnEjPjyygRnAXERW_tv2yo-wAVUM3sVIguf4CC=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/U0hk5TisL-gYTm2anJElHtaNrJ52NdJnEjPjyygRnAXERW_tv2yo-wAVUM3sVIguf4CC"
      }
      -getScore(): float: 4.186313
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    "com.fingersoft.hillclimb" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.fingersoft.hillclimb"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.fingersoft.hillclimb"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.fingersoft.hillclimb&hl=en_US&gl=us"
      -getName(): string: "Hill Climb Racing"
      -getSummary(): ?string: "Play the best physics based driving game ever made! For Free! 🚥🏎️🚗🏁🏆"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "7064049075652771302"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=7064049075652771302"
        -getName(): string: "Fingersoft"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/N0UxhBVUmx8s7y3F7Kqre2AcpXyPDKAp8nHjiPPoOONc_sfugHCYMjBpbUKCMlK_XUs"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/N0UxhBVUmx8s7y3F7Kqre2AcpXyPDKAp8nHjiPPoOONc_sfugHCYMjBpbUKCMlK_XUs=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/N0UxhBVUmx8s7y3F7Kqre2AcpXyPDKAp8nHjiPPoOONc_sfugHCYMjBpbUKCMlK_XUs"
      }
      -getScore(): float: 4.427317
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

[Documentation](../../README.md) > [GPlayApps](README.md) > **getListApps**
