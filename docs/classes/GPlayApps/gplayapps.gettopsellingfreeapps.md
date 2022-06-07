[Documentation](../../README.md) > [GPlayApps](README.md) > **getTopSellingFreeApps**

# Nelexa\GPlay\GPlayApps::getTopSellingFreeApps
`Nelexa\GPlay\GPlayApps::getTopSellingFreeApps` — Returns an array of **top selling free apps** from the Google Play store for the specified category.

## Description
```php
Nelexa\GPlay\GPlayApps::getTopSellingFreeApps ( [ string | Nelexa\GPlay\Model\Category | Nelexa\GPlay\Enum\CategoryEnum $category = "APPLICATION" ] [, int $limit = 500 ] ) : Nelexa\GPlay\Model\App[]
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
**Example 1. Gets top selling free apps by category.**
```php
$apps = $gplay->getTopSellingFreeApps(\Nelexa\GPlay\Enum\CategoryEnum::GAME_RACING());
```
<details>
  <summary>Results</summary>

```php
array:500 [
    0 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.easygames.race"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.easygames.race"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.easygames.race&hl=en_US&gl=us"
      -getName(): string: "Race Master 3D - Car Racing"
      -getDescription(): string: """
        🏎️ Race Master 3D – Fast, furious and super-fun racing \n
        \n
        Keep your finger to the floor and be ready for absolutely anything in this ridiculously enter…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "SayGames Ltd"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/qW1SrW0Gyr3JRMNrTqMjFwcvZVjLP6-Wp2tDY8Z9UWzf2_XteCit8n9CNEGpnHOEFS8"
        -getUrl(): string: "https://play-lh.googleusercontent.com/qW1SrW0Gyr3JRMNrTqMjFwcvZVjLP6-Wp2tDY8Z9UWzf2_XteCit8n9CNEGpnHOEFS8"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/qW1SrW0Gyr3JRMNrTqMjFwcvZVjLP6-Wp2tDY8Z9UWzf2_XteCit8n9CNEGpnHOEFS8=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:15 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/XUsmpo5uQIT9nqVf-N7xJdzKVlQVTmi1UCwHjvNE-4Uw-d3iX98EoFrjeYE8CKKUlMU"
          -getUrl(): string: "https://play-lh.googleusercontent.com/XUsmpo5uQIT9nqVf-N7xJdzKVlQVTmi1UCwHjvNE-4Uw-d3iX98EoFrjeYE8CKKUlMU"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/XUsmpo5uQIT9nqVf-N7xJdzKVlQVTmi1UCwHjvNE-4Uw-d3iX98EoFrjeYE8CKKUlMU=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/1y_bSspylmUF9HtyZkpYI2RrSM6WhheloT781-1JU9OsOumxgluvt8eSCuUJC6q6o-4"
          -getUrl(): string: "https://play-lh.googleusercontent.com/1y_bSspylmUF9HtyZkpYI2RrSM6WhheloT781-1JU9OsOumxgluvt8eSCuUJC6q6o-4"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/1y_bSspylmUF9HtyZkpYI2RrSM6WhheloT781-1JU9OsOumxgluvt8eSCuUJC6q6o-4=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.4214983
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "100,000,000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.uuyu.carflygame"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.uuyu.carflygame"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.uuyu.carflygame&hl=en_US&gl=us"
      -getName(): string: "Crashing Cars"
      -getDescription(): string: """
        Crashing Cars is a super fun racing game with extreme freedom.\n
        Endless possibilities: remodel your ride, fly, perform rolls, and create destruction!\n
        T…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "Meiosei Game Studio"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/n16yk0-rt2flzOsB6cTJFI6IhCJI1Wak9TsURiOCwBC7_-f3QHDuNeJzXUs-_KA2_Cw"
        -getUrl(): string: "https://play-lh.googleusercontent.com/n16yk0-rt2flzOsB6cTJFI6IhCJI1Wak9TsURiOCwBC7_-f3QHDuNeJzXUs-_KA2_Cw"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/n16yk0-rt2flzOsB6cTJFI6IhCJI1Wak9TsURiOCwBC7_-f3QHDuNeJzXUs-_KA2_Cw=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:15 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/DXo2l3ZAy06vOTtDRlTQ_3XQD-ajFiiRrJ1QOFz9pVbraS9zcTUXqOU9NX4c640WdZOH"
          -getUrl(): string: "https://play-lh.googleusercontent.com/DXo2l3ZAy06vOTtDRlTQ_3XQD-ajFiiRrJ1QOFz9pVbraS9zcTUXqOU9NX4c640WdZOH"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/DXo2l3ZAy06vOTtDRlTQ_3XQD-ajFiiRrJ1QOFz9pVbraS9zcTUXqOU9NX4c640WdZOH=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/drxUPNz8HJvNW2pbmTQNAFFjug6J-CV_VfUFfiuSSrbjUfGExwFkKKc1v0YyTWIt7jw"
          -getUrl(): string: "https://play-lh.googleusercontent.com/drxUPNz8HJvNW2pbmTQNAFFjug6J-CV_VfUFfiuSSrbjUfGExwFkKKc1v0YyTWIt7jw"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/drxUPNz8HJvNW2pbmTQNAFFjug6J-CV_VfUFfiuSSrbjUfGExwFkKKc1v0YyTWIt7jw=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 2.6601942
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "500,000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    …
  ]
```

</details>

[Documentation](../../README.md) > [GPlayApps](README.md) > **getTopSellingFreeApps**
