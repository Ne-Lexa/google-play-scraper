[Documentation](../../README.md) > [GPlayApps](README.md) > **getAppInfoForAvailableLocales**

# Nelexa\GPlay\GPlayApps::getAppInfoForAvailableLocales
`Nelexa\GPlay\GPlayApps::getAppInfoForAvailableLocales` — Returns detailed application information for all available locales.

## Description
```php
Nelexa\GPlay\GPlayApps::getAppInfoForAvailableLocales ( string | Nelexa\GPlay\Model\AppId $appId ) : Nelexa\GPlay\Model\AppInfo[]
```
Information is returned only for the description loaded by the developer.
All locales with automated translation from Google Translate will be ignored.
HTTP requests are executed in parallel.

## Parameters
* **$appId** (string | [Nelexa\GPlay\Model\AppId](../AppId/README.md))  
application ID (Android package name) as a string or [Nelexa\GPlay\Model\AppId](../AppId/README.md) object

## Return Values
An array with detailed information about the application
on all available locales. The array key is the locale.


## Errors/Exceptions
* Throws [Nelexa\GPlay\Exception\GooglePlayException](../GooglePlayException/README.md) if the application is not exists or other HTTP error
## Examples
```php
$gplay->setConcurrency(10);

$appId = 'nl.nibbixsoft.app';
// or
$appId = new \Nelexa\GPlay\Model\AppId('nl.nibbixsoft.app');

$apps = $gplay->getAppInfoForAvailableLocales($appId);
```
<details>
  <summary>Results</summary>

```php
array:3 [
    "nl_NL" => class Nelexa\GPlay\Model\AppInfo {
      -getId(): string: "nl.nibbixsoft.app"
      -getLocale(): string: "nl_NL"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=nl.nibbixsoft.app"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=nl.nibbixsoft.app&hl=nl_NL&gl=us"
      -getName(): string: "Nederland.FM - Radio"
      -getSummary(): ?string: "Online Radio"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "Nederland.FM BV"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=Nederland.FM+BV"
        -getName(): string: "Nederland.FM BV"
        -getDescription(): ?string: null
        -getWebsite(): ?string: "http://www.nederland.fm"
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: "info@nederland.fm"
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/zePx7LWaRzRtSyDJ7vunUvUDkzkqOnabsxrmRd7BJ4DLhdp9e1oWA59Gvm9QzEusJD8"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/zePx7LWaRzRtSyDJ7vunUvUDkzkqOnabsxrmRd7BJ4DLhdp9e1oWA59Gvm9QzEusJD8=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/zePx7LWaRzRtSyDJ7vunUvUDkzkqOnabsxrmRd7BJ4DLhdp9e1oWA59Gvm9QzEusJD8"
      }
      -getScore(): float: 3.851852
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -jsonSerialize(): mixed: …
      -getDescription(): string: "Online, live, gratis en eenvoudig luisteren naar de beste radio stations van Nederland !"
      -isAutoTranslatedDescription(): bool: false
      -getTranslatedFromLocale(): ?string: null
      -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/MF1Jx3AoUYFvl66JZlq9HgmHVAAzliDasGl1VAEAl_ctjTWyHCXpDel6XrElM2C-d24"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/MF1Jx3AoUYFvl66JZlq9HgmHVAAzliDasGl1VAEAl_ctjTWyHCXpDel6XrElM2C-d24=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/MF1Jx3AoUYFvl66JZlq9HgmHVAAzliDasGl1VAEAl_ctjTWyHCXpDel6XrElM2C-d24"
      }
      -getScreenshots(): array:6 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -getUrl(): string: "https://lh3.googleusercontent.com/Zi1xCmzzlWcmZcRSHdRecGsDPPVOppevflPnPR_mQpCJjrPcdyOHSPYyGePABXtk87o"
          -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/Zi1xCmzzlWcmZcRSHdRecGsDPPVOppevflPnPR_mQpCJjrPcdyOHSPYyGePABXtk87o=s0"
          -getBinaryImageContent(): string: …
          -__toString(): string: "https://lh3.googleusercontent.com/Zi1xCmzzlWcmZcRSHdRecGsDPPVOppevflPnPR_mQpCJjrPcdyOHSPYyGePABXtk87o"
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -getUrl(): string: "https://lh3.googleusercontent.com/ajwHxM1Be7NpyJJG-1xmH3cqL4n6Uhf08w9WQvCsOk-5D95p46jyuNPK3YNRnRruFGMV"
          -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/ajwHxM1Be7NpyJJG-1xmH3cqL4n6Uhf08w9WQvCsOk-5D95p46jyuNPK3YNRnRruFGMV=s0"
          -getBinaryImageContent(): string: …
          -__toString(): string: "https://lh3.googleusercontent.com/ajwHxM1Be7NpyJJG-1xmH3cqL4n6Uhf08w9WQvCsOk-5D95p46jyuNPK3YNRnRruFGMV"
        }
        …
      ]
      -getCategory(): Nelexa\GPlay\Model\Category: {
        -getId(): string: "MUSIC_AND_AUDIO"
        -getName(): string: "Muziek en audio"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getCategoryFamily(): ?Nelexa\GPlay\Model\Category: null
      -getVideo(): ?Nelexa\GPlay\Model\Video: null
      -getRecentChanges(): ?string: "Problemen opgelost"
      -isEditorsChoice(): bool: false
      -getInstalls(): int: 596014
      -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
        -getFiveStars(): int: 1281
        -getFourStars(): int: 191
        -getThreeStars(): int: 151
        -getTwoStars(): int: 211
        -getOneStar(): int: 343
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getPrice(): float: 0.0
      -getCurrency(): string: "USD"
      -isContainsIAP(): bool: false
      -getOffersIAPCost(): ?string: null
      -isContainsAds(): bool: true
      -getSize(): ?string: "5,1M"
      -getAppVersion(): ?string: "4.0"
      -getAndroidVersion(): ?string: "4.1 en hoger"
      -getMinAndroidVersion(): ?string: "4.1"
      -getContentRating(): ?string: "Iedereen"
      -getPrivacyPoliceUrl(): ?string: "http://www.nederland.fm/cookies.php"
      -getReleased(): ?DateTimeInterface: @1502236800 {
        date: 2017-08-09T00:00:00+00:00
      }
      -getUpdated(): ?DateTimeInterface: @1581600058 {
        date: 2020-02-13T13:20:58+00:00
      }
      -getNumberVoters(): int: 2180
      -getNumberReviews(): int: 558
      -getReviews(): array:4 [
        0 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOFi7Kk_jVOllPRPnIosMlgQKqGd2uLTWb5TldsE4KjAOpnLMlxGW6eLrjT8wOQ8ziGNCTukqmr8vMBBFg"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=nl.nibbixsoft.app&reviewId=gp%3AAOqpTOFi7Kk_jVOllPRPnIosMlgQKqGd2uLTWb5TldsE4KjAOpnLMlxGW6eLrjT8wOQ8ziGN…"
          -getUserName(): string: "Bas Peters"
          -getText(): string: "Het was altijd een hele goede app maar sinds kort krijg ik midden in een liedje gewoon reclame en dat slaat echt nergens op. Ben best bereid om wat te…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -getUrl(): string: "https://lh3.googleusercontent.com/-KRpT8HPwTCg/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rdzAg8vO7wkLfrQYznvZJ1pjfoyrQ/s64/"
            -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/-KRpT8HPwTCg/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rdzAg8vO7wkLfrQYznvZJ1pjfoyrQ/s0/"
            -getBinaryImageContent(): string: …
            -__toString(): string: "https://lh3.googleusercontent.com/-KRpT8HPwTCg/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rdzAg8vO7wkLfrQYznvZJ1pjfoyrQ/s64/"
          }
          -getDate(): ?DateTimeInterface: @1543226196 {
            date: 2018-11-26T09:56:36+00:00
          }
          -getScore(): int: 1
          -getCountLikes(): int: 15
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -asArray(): array: …
          -jsonSerialize(): mixed: …
        }
        1 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOE8md2QM60-iEAviKEt73gXeN3Al1w8GiYUF6CLNWBVjZPRM98Aq3NYhqBwtkY8w3u1Zp3hrPOSgRgjfw"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=nl.nibbixsoft.app&reviewId=gp%3AAOqpTOE8md2QM60-iEAviKEt73gXeN3Al1w8GiYUF6CLNWBVjZPRM98Aq3NYhqBwtkY8w3u1…"
          -getUserName(): string: "Verg"
          -getText(): string: "Even verbinding kwijt? RECLAME. Even op pauze? RECLAME. Radio luisteren in de trein? RECLAME RECLAME RECLAME RECLAME. Ik verbaas me dat jullie blijkba…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -getUrl(): string: "https://lh3.googleusercontent.com/-4Nyg4U_H_7s/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3reMSyniGDA-kcSKIj85b7jCgAcAZA/s64/"
            -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/-4Nyg4U_H_7s/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3reMSyniGDA-kcSKIj85b7jCgAcAZA/s0/"
            -getBinaryImageContent(): string: …
            -__toString(): string: "https://lh3.googleusercontent.com/-4Nyg4U_H_7s/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3reMSyniGDA-kcSKIj85b7jCgAcAZA/s64/"
          }
          -getDate(): ?DateTimeInterface: @1545823880 {
            date: 2018-12-26T11:31:20+00:00
          }
          -getScore(): int: 1
          -getCountLikes(): int: 57
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -asArray(): array: …
          -jsonSerialize(): mixed: …
        }
        …
      ]
      -asArray(): array: …
    }
    "hy_AM" => class Nelexa\GPlay\Model\AppInfo {
      -getId(): string: "nl.nibbixsoft.app"
      -getLocale(): string: "hy_AM"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=nl.nibbixsoft.app"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=nl.nibbixsoft.app&hl=hy_AM&gl=us"
      -getName(): string: "Nederland.FM - Radio"
      -getSummary(): ?string: "օնլայն Ռադիո"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "Nederland.FM BV"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=Nederland.FM+BV"
        -getName(): string: "Nederland.FM BV"
        -getDescription(): ?string: null
        -getWebsite(): ?string: "http://www.nederland.fm"
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: "info@nederland.fm"
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/zePx7LWaRzRtSyDJ7vunUvUDkzkqOnabsxrmRd7BJ4DLhdp9e1oWA59Gvm9QzEusJD8"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/zePx7LWaRzRtSyDJ7vunUvUDkzkqOnabsxrmRd7BJ4DLhdp9e1oWA59Gvm9QzEusJD8=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/zePx7LWaRzRtSyDJ7vunUvUDkzkqOnabsxrmRd7BJ4DLhdp9e1oWA59Gvm9QzEusJD8"
      }
      -getScore(): float: 3.851852
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -jsonSerialize(): mixed: …
      -getDescription(): string: "Առցանց, ապրում, ազատ եւ հեշտ է լսել լավագույն ռադիոկայանների Նիդեռլանդներում."
      -isAutoTranslatedDescription(): bool: false
      -getTranslatedFromLocale(): ?string: null
      -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/MF1Jx3AoUYFvl66JZlq9HgmHVAAzliDasGl1VAEAl_ctjTWyHCXpDel6XrElM2C-d24"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/MF1Jx3AoUYFvl66JZlq9HgmHVAAzliDasGl1VAEAl_ctjTWyHCXpDel6XrElM2C-d24=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/MF1Jx3AoUYFvl66JZlq9HgmHVAAzliDasGl1VAEAl_ctjTWyHCXpDel6XrElM2C-d24"
      }
      -getScreenshots(): array:6 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -getUrl(): string: "https://lh3.googleusercontent.com/Zi1xCmzzlWcmZcRSHdRecGsDPPVOppevflPnPR_mQpCJjrPcdyOHSPYyGePABXtk87o"
          -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/Zi1xCmzzlWcmZcRSHdRecGsDPPVOppevflPnPR_mQpCJjrPcdyOHSPYyGePABXtk87o=s0"
          -getBinaryImageContent(): string: …
          -__toString(): string: "https://lh3.googleusercontent.com/Zi1xCmzzlWcmZcRSHdRecGsDPPVOppevflPnPR_mQpCJjrPcdyOHSPYyGePABXtk87o"
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -getUrl(): string: "https://lh3.googleusercontent.com/ajwHxM1Be7NpyJJG-1xmH3cqL4n6Uhf08w9WQvCsOk-5D95p46jyuNPK3YNRnRruFGMV"
          -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/ajwHxM1Be7NpyJJG-1xmH3cqL4n6Uhf08w9WQvCsOk-5D95p46jyuNPK3YNRnRruFGMV=s0"
          -getBinaryImageContent(): string: …
          -__toString(): string: "https://lh3.googleusercontent.com/ajwHxM1Be7NpyJJG-1xmH3cqL4n6Uhf08w9WQvCsOk-5D95p46jyuNPK3YNRnRruFGMV"
        }
        …
      ]
      -getCategory(): Nelexa\GPlay\Model\Category: {
        -getId(): string: "MUSIC_AND_AUDIO"
        -getName(): string: "Երաժշտություն և աուդիո"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getCategoryFamily(): ?Nelexa\GPlay\Model\Category: null
      -getVideo(): ?Nelexa\GPlay\Model\Video: null
      -getRecentChanges(): ?string: "Problemen opgelost"
      -isEditorsChoice(): bool: false
      -getInstalls(): int: 596014
      -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
        -getFiveStars(): int: 1281
        -getFourStars(): int: 191
        -getThreeStars(): int: 151
        -getTwoStars(): int: 211
        -getOneStar(): int: 343
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getPrice(): float: 0.0
      -getCurrency(): string: "USD"
      -isContainsIAP(): bool: false
      -getOffersIAPCost(): ?string: null
      -isContainsAds(): bool: true
      -getSize(): ?string: "5.1M"
      -getAppVersion(): ?string: "4.0"
      -getAndroidVersion(): ?string: "4.1 և ավելի բարձր"
      -getMinAndroidVersion(): ?string: "4.1"
      -getContentRating(): ?string: "Բոլորի համար"
      -getPrivacyPoliceUrl(): ?string: "http://www.nederland.fm/cookies.php"
      -getReleased(): ?DateTimeInterface: @1502236800 {
        date: 2017-08-09T00:00:00+00:00
      }
      -getUpdated(): ?DateTimeInterface: @1581600058 {
        date: 2020-02-13T13:20:58+00:00
      }
      -getNumberVoters(): int: 2180
      -getNumberReviews(): int: 558
      -getReviews(): array:0 []
      -asArray(): array: …
    }
    …
  ]
```

</details>

## See Also
* [Nelexa\GPlay\GPlayApps::setConcurrency()](gplayapps.setconcurrency.md) - Sets the limit of concurrent HTTP requests.

[Documentation](../../README.md) > [GPlayApps](README.md) > **getAppInfoForAvailableLocales**
