[Documentation](../../README.md) > [GPlayApps](README.md) > **getTopGrossingApps**

# Nelexa\GPlay\GPlayApps::getTopGrossingApps
`Nelexa\GPlay\GPlayApps::getTopGrossingApps` — Returns an array of **top grossing apps** from the Google Play store for the specified category.

## Description
```php
Nelexa\GPlay\GPlayApps::getTopGrossingApps ( [ string | Nelexa\GPlay\Model\Category | Nelexa\GPlay\Enum\CategoryEnum $category = "APPLICATION" ] [, int $limit = 500 ] ) : Nelexa\GPlay\Model\App[]
```

## Parameters
* **$category** (string | [Nelexa\GPlay\Model\Category](../Category/README.md) | [Nelexa\GPlay\Enum\CategoryEnum](../CategoryEnum/README.md))  
application category as string, [Nelexa\GPlay\Model\Category](../Category/README.md), [Nelexa\GPlay\Enum\CategoryEnum](../CategoryEnum/README.md), ex. APPLICATION or GAME
* **$limit** (int)  
Limit

## Return Values
App list


## Errors/Exceptions
* Throws [Nelexa\GPlay\Exception\GooglePlayException](../GooglePlayException/README.md)
## Examples
**Example 1. Gets top grossing free apps by category.**
```php
$apps = $gplay->getTopGrossingApps(\Nelexa\GPlay\Enum\CategoryEnum::GAME_RACING());
```
<details>
  <summary>Results</summary>

```php
array:500 [
    0 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.naturalmotion.customstreetracer2"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.naturalmotion.customstreetracer2"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.naturalmotion.customstreetracer2&hl=en_US&gl=us"
      -getName(): string: "CSR 2 - Drag Racing Car Games"
      -getDescription(): string: """
        CSR2 is a real driving simulator that delivers hyper-real drag racing to the palm of your hand. In its 3rd iteration after CSR Racing and CSR Classics…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "NaturalMotionGames Ltd"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/fzkDKGJ3eoQQ7ZfpmQXQO30NRBVXqGORVgKOTcE9jUugLGoX3vCuL9Qix1vNn3CeBQ"
        -getUrl(): string: "https://play-lh.googleusercontent.com/fzkDKGJ3eoQQ7ZfpmQXQO30NRBVXqGORVgKOTcE9jUugLGoX3vCuL9Qix1vNn3CeBQ"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/fzkDKGJ3eoQQ7ZfpmQXQO30NRBVXqGORVgKOTcE9jUugLGoX3vCuL9Qix1vNn3CeBQ=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:15 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/ZxGvJWP4tm3de5IA3ksXaqDVhxL77bRMBMltoAU3Tz8lUodNnJS9-silrfkDtrxNPDw"
          -getUrl(): string: "https://play-lh.googleusercontent.com/ZxGvJWP4tm3de5IA3ksXaqDVhxL77bRMBMltoAU3Tz8lUodNnJS9-silrfkDtrxNPDw"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/ZxGvJWP4tm3de5IA3ksXaqDVhxL77bRMBMltoAU3Tz8lUodNnJS9-silrfkDtrxNPDw=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/toJnhyt42hquoNsd20L8Xxh9-0ZkDLYGwj2u30uodnrsERBFpoPWRIKPjimtIsfLFik"
          -getUrl(): string: "https://play-lh.googleusercontent.com/toJnhyt42hquoNsd20L8Xxh9-0ZkDLYGwj2u30uodnrsERBFpoPWRIKPjimtIsfLFik"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/toJnhyt42hquoNsd20L8Xxh9-0ZkDLYGwj2u30uodnrsERBFpoPWRIKPjimtIsfLFik=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.5836105
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "50,000,000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.ea.game.nfs14_row"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.ea.game.nfs14_row"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.ea.game.nfs14_row&hl=en_US&gl=us"
      -getName(): string: "Need for Speed™ No Limits"
      -getDescription(): string: """
        Claim the crown and rule the underground as you race for dominance in the first white-knuckle edition of Need for Speed made just for mobile – from th…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "ELECTRONIC ARTS"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/jR32DXa15ObFAKr1KTL46qY8DZA5UUWK-qz_Ji4pu_Z-Ue-uQOunCY6GW9VRoVvgYQ"
        -getUrl(): string: "https://play-lh.googleusercontent.com/jR32DXa15ObFAKr1KTL46qY8DZA5UUWK-qz_Ji4pu_Z-Ue-uQOunCY6GW9VRoVvgYQ"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/jR32DXa15ObFAKr1KTL46qY8DZA5UUWK-qz_Ji4pu_Z-Ue-uQOunCY6GW9VRoVvgYQ=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:12 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/YIPVKEX-vldJN9ZAyFTaT05Qf53tq90MBZLfrQqaE_C6MZ7kzlloS01EBMkhWixcUvk"
          -getUrl(): string: "https://play-lh.googleusercontent.com/YIPVKEX-vldJN9ZAyFTaT05Qf53tq90MBZLfrQqaE_C6MZ7kzlloS01EBMkhWixcUvk"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/YIPVKEX-vldJN9ZAyFTaT05Qf53tq90MBZLfrQqaE_C6MZ7kzlloS01EBMkhWixcUvk=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/aKXKOVc6-ejZoXMcraRjPBxkreHKI_f95Y6j-JARGhj-j2qs6ma6l_g2WWKjsrCQDmc"
          -getUrl(): string: "https://play-lh.googleusercontent.com/aKXKOVc6-ejZoXMcraRjPBxkreHKI_f95Y6j-JARGhj-j2qs6ma6l_g2WWKjsrCQDmc"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/aKXKOVc6-ejZoXMcraRjPBxkreHKI_f95Y6j-JARGhj-j2qs6ma6l_g2WWKjsrCQDmc=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.3578386
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "100,000,000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    …
  ]
```

</details>

[Documentation](../../README.md) > [GPlayApps](README.md) > **getTopGrossingApps**
