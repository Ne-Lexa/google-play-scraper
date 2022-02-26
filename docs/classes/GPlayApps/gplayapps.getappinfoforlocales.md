[Documentation](../../README.md) > [GPlayApps](README.md) > **getAppInfoForLocales**

# Nelexa\GPlay\GPlayApps::getAppInfoForLocales
`Nelexa\GPlay\GPlayApps::getAppInfoForLocales` — Returns the full details of an application in multiple languages.

## Description
```php
Nelexa\GPlay\GPlayApps::getAppInfoForLocales ( string | Nelexa\GPlay\Model\AppId $appId , string[] $locales ) : array<string, Nelexa\GPlay\Model\AppInfo>
```
HTTP requests are executed in parallel.

## Parameters
* **$appId** (string | [Nelexa\GPlay\Model\AppId](../AppId/README.md))  
google Play app ID (Android package name)
* **$locales** (string[])  
array of locales

## Return Values
An array of detailed information for each locale.
The array key is the locale.


## Errors/Exceptions
* Throws [Nelexa\GPlay\Exception\GooglePlayException](../GooglePlayException/README.md) if the application is not exists or other HTTP error
## Examples
```php
$gplay->setConcurrency(10);

$appId = 'com.android.chrome';
// or
$appId = new \Nelexa\GPlay\Model\AppId('com.android.chrome');

$apps = $gplay->getAppInfoForLocales($appId, $locales = ['en', 'fr', 'es', 'ru', 'ar']);
```
<details>
  <summary>Results</summary>

```php
array:5 [
    "en" => class Nelexa\GPlay\Model\AppInfo {
      -getId(): string: "com.android.chrome"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.android.chrome"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.android.chrome&hl=en_US&gl=us"
      -getName(): string: "Google Chrome: Fast & Secure"
      -getSummary(): ?string: "Fast, simple, and secure. Google Chrome browser for Android phones and tablets."
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "5700313618786177705"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=5700313618786177705"
        -getName(): string: "Google LLC"
        -getDescription(): ?string: null
        -getWebsite(): ?string: "http://www.google.com/chrome/android"
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: "apps-help@google.com"
        -getAddress(): ?string: "1600 Amphitheatre Parkway, Mountain View 94043"
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk"
        -getUrl(): string: "https://play-lh.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.126106
      -getPriceText(): ?string: ""
      -isFree(): bool: false
      -jsonSerialize(): array: …
      -getDescription(): string: """
        Google Chrome is a fast, easy to use, and secure web browser. Designed for Android, Chrome brings you personalized news articles, quick links to your …
        """
      -isAutoTranslatedDescription(): bool: false
      -getTranslatedFromLocale(): ?string: null
      -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/WPIJiEaY1kOU3-zogfv11ILu-mCaKhdq7hy2LXZ7JoLFTqGW3ZUXpRCTM7_dvPuBgB0"
        -getUrl(): string: "https://play-lh.googleusercontent.com/WPIJiEaY1kOU3-zogfv11ILu-mCaKhdq7hy2LXZ7JoLFTqGW3ZUXpRCTM7_dvPuBgB0"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/WPIJiEaY1kOU3-zogfv11ILu-mCaKhdq7hy2LXZ7JoLFTqGW3ZUXpRCTM7_dvPuBgB0=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:18 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/Usyjx1hHMLBCkpIpr56I74F1wYVncbZFTctqkDDgzfj1ABhCGu0GCg7pHwbyL-xhSV4"
          -getUrl(): string: "https://play-lh.googleusercontent.com/Usyjx1hHMLBCkpIpr56I74F1wYVncbZFTctqkDDgzfj1ABhCGu0GCg7pHwbyL-xhSV4"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/Usyjx1hHMLBCkpIpr56I74F1wYVncbZFTctqkDDgzfj1ABhCGu0GCg7pHwbyL-xhSV4=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/hQyOjY123zSEeZkXcyY9QvhBDd6iCkH5vL07gaoHhEKec-_bZyqD8IEbHpCJOQEDbA"
          -getUrl(): string: "https://play-lh.googleusercontent.com/hQyOjY123zSEeZkXcyY9QvhBDd6iCkH5vL07gaoHhEKec-_bZyqD8IEbHpCJOQEDbA"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/hQyOjY123zSEeZkXcyY9QvhBDd6iCkH5vL07gaoHhEKec-_bZyqD8IEbHpCJOQEDbA=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getCategory(): ?Nelexa\GPlay\Model\Category: {
        -getId(): string: "COMMUNICATION"
        -getName(): string: "Communication"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getCategoryFamily(): ?Nelexa\GPlay\Model\Category: null
      -getVideo(): ?Nelexa\GPlay\Model\Video: null
      -getRecentChanges(): ?string: "Thanks for choosing Chrome! This release includes stability and performance improvements."
      -isEditorsChoice(): bool: false
      -getInstalls(): int: 10546228660
      -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
        -getFiveStars(): int: 23719921
        -getFourStars(): int: 4688358
        -getThreeStars(): int: 2543567
        -getTwoStars(): int: 1510499
        -getOneStar(): int: 4498126
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getPrice(): float: 0.0
      -getCurrency(): string: "USD"
      -isContainsIAP(): bool: false
      -getOffersIAPCost(): ?string: null
      -isContainsAds(): bool: false
      -getSize(): ?string: null
      -getAppVersion(): ?string: null
      -getAndroidVersion(): ?string: null
      -getMinAndroidVersion(): ?string: null
      -getContentRating(): ?string: "Everyone"
      -getPrivacyPoliceUrl(): ?string: "http://www.google.com/chrome/intl/en/privacy.html"
      -getReleased(): ?DateTimeInterface: @1328572800 {
        date: 2012-02-07T00:00:00+00:00
      }
      -getUpdated(): ?DateTimeInterface: @1645554664 {
        date: 2022-02-22T18:31:04+00:00
      }
      -getNumberVoters(): int: 36960498
      -getNumberReviews(): int: 864115
      -getReviews(): array: array:4 [
        0 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOGe8ai7cP4FaVAaYPRtiIcSPworf6t7APGHIWI2sdHbjJ0fHJAI0bjnoYPMr_27AQy3rKUvr5Xxj3NmgIk"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.android.chrome&reviewId=gp%3AAOqpTOGe8ai7cP4FaVAaYPRtiIcSPworf6t7APGHIWI2sdHbjJ0fHJAI0bjnoYPMr_27AQy…"
          -getUserName(): string: "Two Fisted Betty"
          -getText(): string: "Have been a VERY long time user and absolutely love Google and everything it has to offer. It's had it's glitches but all software has it's issues fro…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgW3jpEpXQL-PHX7dFUSGnmb0Ix7ZtNvV3w8SrarA=s64"
            -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgW3jpEpXQL-PHX7dFUSGnmb0Ix7ZtNvV3w8SrarA=s64"
            -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgW3jpEpXQL-PHX7dFUSGnmb0Ix7ZtNvV3w8SrarA=s0"
            -getBinaryImageContent(): string: …
          }
          -getDate(): ?DateTimeInterface: @1645673394 {
            date: 2022-02-24T03:29:54+00:00
          }
          -getScore(): int: 4
          -getCountLikes(): int: 0
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -asArray(): array: …
          -jsonSerialize(): array: …
        }
        1 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOGIgO0_ejFawLmyIyJt9YFuaauwHIsRq-bCyEEo7E41GTOqXM9STPrGmBjB_9O0ZuJgdGRhoG205Y_Dw-s"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.android.chrome&reviewId=gp%3AAOqpTOGIgO0_ejFawLmyIyJt9YFuaauwHIsRq-bCyEEo7E41GTOqXM9STPrGmBjB_9O0ZuJ…"
          -getUserName(): string: "Renae"
          -getText(): string: "I typically have no issues with the app, but this update seems to have broken it (though it was fine at first). For a few days now whenever I try to u…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GidFn_JBSyzJPZsa-usfRNWYeXEo3kEavIHjDiW6TM=s64"
            -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GidFn_JBSyzJPZsa-usfRNWYeXEo3kEavIHjDiW6TM=s64"
            -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GidFn_JBSyzJPZsa-usfRNWYeXEo3kEavIHjDiW6TM=s0"
            -getBinaryImageContent(): string: …
          }
          -getDate(): ?DateTimeInterface: @1644211105 {
            date: 2022-02-07T05:18:25+00:00
          }
          -getScore(): int: 1
          -getCountLikes(): int: 1655
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -asArray(): array: …
          -jsonSerialize(): array: …
        }
        …
      ]
      -asArray(): array: …
    }
    "fr" => class Nelexa\GPlay\Model\AppInfo {
      -getId(): string: "com.android.chrome"
      -getLocale(): string: "fr_FR"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.android.chrome"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.android.chrome&hl=fr_FR&gl=us"
      -getName(): string: "Chrome : rapide et sécurisé"
      -getSummary(): ?string: "Rapide, simple et sécurisé. Navigateur Chrome pour téléphones/tablettes Android."
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "5700313618786177705"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=5700313618786177705"
        -getName(): string: "Google LLC"
        -getDescription(): ?string: null
        -getWebsite(): ?string: "http://www.google.com/chrome/android"
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: "apps-help@google.com"
        -getAddress(): ?string: "1600 Amphitheatre Parkway, Mountain View 94043"
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk"
        -getUrl(): string: "https://play-lh.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.126106
      -getPriceText(): ?string: ""
      -isFree(): bool: false
      -jsonSerialize(): array: …
      -getDescription(): string: """
        Google Chrome est un navigateur Web rapide, simple d'utilisation et sécurisé. Conçu pour Android, Chrome vous permet de consulter une sélection person…
        """
      -isAutoTranslatedDescription(): bool: false
      -getTranslatedFromLocale(): ?string: null
      -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/rcUvNWE0WrExleYaz3l2XS_8tMOJLtdNTzHz9AXLJDPrkUZqQcY-cMxSSRUOWJteNq4"
        -getUrl(): string: "https://play-lh.googleusercontent.com/rcUvNWE0WrExleYaz3l2XS_8tMOJLtdNTzHz9AXLJDPrkUZqQcY-cMxSSRUOWJteNq4"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/rcUvNWE0WrExleYaz3l2XS_8tMOJLtdNTzHz9AXLJDPrkUZqQcY-cMxSSRUOWJteNq4=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:18 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/BkLzaEgIaYIViqMAMnZnWrl9RcZouqH8mHstYVARFP3MYNZB6VeZJGJf3S7Xe_VUuyzt"
          -getUrl(): string: "https://play-lh.googleusercontent.com/BkLzaEgIaYIViqMAMnZnWrl9RcZouqH8mHstYVARFP3MYNZB6VeZJGJf3S7Xe_VUuyzt"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/BkLzaEgIaYIViqMAMnZnWrl9RcZouqH8mHstYVARFP3MYNZB6VeZJGJf3S7Xe_VUuyzt=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/tY1kWcWsc5FU3AJJ5ZzQSfsIqw9IGqejF5j75rh4wA9G0KtcEa_0ffZStfWtF_Zoi1U"
          -getUrl(): string: "https://play-lh.googleusercontent.com/tY1kWcWsc5FU3AJJ5ZzQSfsIqw9IGqejF5j75rh4wA9G0KtcEa_0ffZStfWtF_Zoi1U"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/tY1kWcWsc5FU3AJJ5ZzQSfsIqw9IGqejF5j75rh4wA9G0KtcEa_0ffZStfWtF_Zoi1U=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getCategory(): ?Nelexa\GPlay\Model\Category: {
        -getId(): string: "COMMUNICATION"
        -getName(): string: "Communication"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getCategoryFamily(): ?Nelexa\GPlay\Model\Category: null
      -getVideo(): ?Nelexa\GPlay\Model\Video: null
      -getRecentChanges(): ?string: "Merci d'avoir choisi Chrome ! Cette version inclut des améliorations de la stabilité et des performances."
      -isEditorsChoice(): bool: false
      -getInstalls(): int: 10546228660
      -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
        -getFiveStars(): int: 23719921
        -getFourStars(): int: 4688358
        -getThreeStars(): int: 2543567
        -getTwoStars(): int: 1510499
        -getOneStar(): int: 4498126
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getPrice(): float: 0.0
      -getCurrency(): string: "USD"
      -isContainsIAP(): bool: false
      -getOffersIAPCost(): ?string: null
      -isContainsAds(): bool: false
      -getSize(): ?string: null
      -getAppVersion(): ?string: null
      -getAndroidVersion(): ?string: null
      -getMinAndroidVersion(): ?string: null
      -getContentRating(): ?string: "Tout public"
      -getPrivacyPoliceUrl(): ?string: "http://www.google.com/chrome/intl/en/privacy.html"
      -getReleased(): ?DateTimeInterface: @1328572800 {
        date: 2012-02-07T00:00:00+00:00
      }
      -getUpdated(): ?DateTimeInterface: @1645554664 {
        date: 2022-02-22T18:31:04+00:00
      }
      -getNumberVoters(): int: 36960498
      -getNumberReviews(): int: 864115
      -getReviews(): array: array:4 [
        0 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOF8R72xCrYXTAeso0BgPKXKbou5TR63V5pivkPPZc58NgQK74nIP9jFLw4Tih7ByxkPdwUSlUh45_UQxcU"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.android.chrome&reviewId=gp%3AAOqpTOF8R72xCrYXTAeso0BgPKXKbou5TR63V5pivkPPZc58NgQK74nIP9jFLw4Tih7Byxk…"
          -getUserName(): string: "Atmosphere"
          -getText(): string: "Impossible de télécharger la mise à jour . Cependant Chrome a été toujours été mon navigateur privilégié, j'apprécie beaucoup sa rapidité."
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GhVcyqo6-rX6DRa529Ke5PcSPd7ZW2YxJDFmMYGQQ=s64"
            -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GhVcyqo6-rX6DRa529Ke5PcSPd7ZW2YxJDFmMYGQQ=s64"
            -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GhVcyqo6-rX6DRa529Ke5PcSPd7ZW2YxJDFmMYGQQ=s0"
            -getBinaryImageContent(): string: …
          }
          -getDate(): ?DateTimeInterface: @1644365527 {
            date: 2022-02-09T00:12:07+00:00
          }
          -getScore(): int: 3
          -getCountLikes(): int: 0
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: {
            -getDate(): DateTimeInterface: @1644398667 {
              date: 2022-02-09T09:24:27+00:00
            }
            -getText(): string: "Bonjour et merci de nous avoir contactés ! Nous sommes au courant des soucis concernant la mise à jour de l'application. Nous avons partagé plus d'inf…"
            -asArray(): array: …
            -jsonSerialize(): array: …
          }
          -asArray(): array: …
          -jsonSerialize(): array: …
        }
        1 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOHzEutq7lmiHmWZ5uu8iRoBTRmLmwPtP5dQlvR1myIuUHObWGgKsjbsACBz1Abu_sqJ4RGNwAFWBh4vovc"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.android.chrome&reviewId=gp%3AAOqpTOHzEutq7lmiHmWZ5uu8iRoBTRmLmwPtP5dQlvR1myIuUHObWGgKsjbsACBz1Abu_sq…"
          -getUserName(): string: "Said said"
          -getText(): string: "Pour une meilleure navigation je vous conseille firefox largement le meilleur navigateur sur Android en plus il supporte les modules complémentaires c…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgpjKVUrdtrAvjpqlQfEyMZLI7P3DDkI_ekIYPHMg=s64"
            -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgpjKVUrdtrAvjpqlQfEyMZLI7P3DDkI_ekIYPHMg=s64"
            -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgpjKVUrdtrAvjpqlQfEyMZLI7P3DDkI_ekIYPHMg=s0"
            -getBinaryImageContent(): string: …
          }
          -getDate(): ?DateTimeInterface: @1639445855 {
            date: 2021-12-14T01:37:35+00:00
          }
          -getScore(): int: 1
          -getCountLikes(): int: 62
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -asArray(): array: …
          -jsonSerialize(): array: …
        }
        …
      ]
      -asArray(): array: …
    }
    …
  ]
```

</details>

## See Also
* [Nelexa\GPlay\GPlayApps::setConcurrency()](gplayapps.setconcurrency.md) - Sets the limit of concurrent HTTP requests.

[Documentation](../../README.md) > [GPlayApps](README.md) > **getAppInfoForLocales**
