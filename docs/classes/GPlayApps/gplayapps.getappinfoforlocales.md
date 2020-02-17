[Documentation](../../README.md) > [GPlayApps](README.md) > **getAppInfoForLocales**

# Nelexa\GPlay\GPlayApps::getAppInfoForLocales
`Nelexa\GPlay\GPlayApps::getAppInfoForLocales` — Returns the full details of an application in multiple languages.

## Description
```php
Nelexa\GPlay\GPlayApps::getAppInfoForLocales ( string | Nelexa\GPlay\Model\AppId $appId , string[] $locales ) : Nelexa\GPlay\Model\AppInfo[]
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
        -jsonSerialize(): mixed: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk"
      }
      -getScore(): float: 4.371647
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -jsonSerialize(): mixed: …
      -getDescription(): string: """
        Google Chrome is a fast, easy to use, and secure web browser. Designed for Android, Chrome brings you personalized news articles, quick links to your …
        """
      -isAutoTranslatedDescription(): bool: false
      -getTranslatedFromLocale(): ?string: null
      -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/WPIJiEaY1kOU3-zogfv11ILu-mCaKhdq7hy2LXZ7JoLFTqGW3ZUXpRCTM7_dvPuBgB0"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/WPIJiEaY1kOU3-zogfv11ILu-mCaKhdq7hy2LXZ7JoLFTqGW3ZUXpRCTM7_dvPuBgB0=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/WPIJiEaY1kOU3-zogfv11ILu-mCaKhdq7hy2LXZ7JoLFTqGW3ZUXpRCTM7_dvPuBgB0"
      }
      -getScreenshots(): array:18 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -getUrl(): string: "https://lh3.googleusercontent.com/Usyjx1hHMLBCkpIpr56I74F1wYVncbZFTctqkDDgzfj1ABhCGu0GCg7pHwbyL-xhSV4"
          -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/Usyjx1hHMLBCkpIpr56I74F1wYVncbZFTctqkDDgzfj1ABhCGu0GCg7pHwbyL-xhSV4=s0"
          -getBinaryImageContent(): string: …
          -__toString(): string: "https://lh3.googleusercontent.com/Usyjx1hHMLBCkpIpr56I74F1wYVncbZFTctqkDDgzfj1ABhCGu0GCg7pHwbyL-xhSV4"
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -getUrl(): string: "https://lh3.googleusercontent.com/MDUDkVeS3rAZ-CeNSAlMM94iQAxCJbthTNK7675leCrIQ3cZ5uVAxrXRRsqanJUHog"
          -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/MDUDkVeS3rAZ-CeNSAlMM94iQAxCJbthTNK7675leCrIQ3cZ5uVAxrXRRsqanJUHog=s0"
          -getBinaryImageContent(): string: …
          -__toString(): string: "https://lh3.googleusercontent.com/MDUDkVeS3rAZ-CeNSAlMM94iQAxCJbthTNK7675leCrIQ3cZ5uVAxrXRRsqanJUHog"
        }
        …
      ]
      -getCategory(): Nelexa\GPlay\Model\Category: {
        -getId(): string: "COMMUNICATION"
        -getName(): string: "Communication"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getCategoryFamily(): ?Nelexa\GPlay\Model\Category: null
      -getVideo(): ?Nelexa\GPlay\Model\Video: null
      -getRecentChanges(): ?string: """
        Thanks for choosing Chrome! This release contains the following features, as well as stability and performance improvements: \n
        \n
        • Quieter notifications…
        """
      -isEditorsChoice(): bool: false
      -getInstalls(): int: 6109119447
      -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
        -getFiveStars(): int: 13653105
        -getFourStars(): int: 2319179
        -getThreeStars(): int: 1115216
        -getTwoStars(): int: 545239
        -getOneStar(): int: 1451591
        -asArray(): array: …
        -jsonSerialize(): mixed: …
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
      -getUpdated(): ?DateTimeInterface: @1581622298 {
        date: 2020-02-13T19:31:38+00:00
      }
      -getNumberVoters(): int: 19084332
      -getNumberReviews(): int: 5581111
      -getReviews(): array:4 [
        0 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOH7DSH2OtYI4XCeZEW_qyYJZdFxrXyE-m3mIW0PxSnL_RwuM0xWp_5PJjCJK-4a2cZAUppOOGWOIwdUCDs"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.android.chrome&reviewId=gp%3AAOqpTOH7DSH2OtYI4XCeZEW_qyYJZdFxrXyE-m3mIW0PxSnL_RwuM0xWp_5PJjCJK-4a2cZ…"
          -getUserName(): string: "Stephen"
          -getText(): string: "I thought it was just me (or my device - Samsung S10 tablet), but I see that many users are having crash problems with Chrome. I tried all of the fixe…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -getUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mAA8Z3E9Dydz7VARV9gbzkRw6SIxFfwT97_QRLg=s64"
            -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mAA8Z3E9Dydz7VARV9gbzkRw6SIxFfwT97_QRLg=s0"
            -getBinaryImageContent(): string: …
            -__toString(): string: "https://lh3.googleusercontent.com/a-/AAuE7mAA8Z3E9Dydz7VARV9gbzkRw6SIxFfwT97_QRLg=s64"
          }
          -getDate(): ?DateTimeInterface: @1581778840 {
            date: 2020-02-15T15:00:40+00:00
          }
          -getScore(): int: 1
          -getCountLikes(): int: 260
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -asArray(): array: …
          -jsonSerialize(): mixed: …
        }
        1 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOHJIhcmfbAZksVWe5j-AnsnH7Dy3A6ghft6M9Hh_ojJtgMvqpx5hSH5F9Wkg_88bkqoOZRUoC6qm4OXv7g"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.android.chrome&reviewId=gp%3AAOqpTOHJIhcmfbAZksVWe5j-AnsnH7Dy3A6ghft6M9Hh_ojJtgMvqpx5hSH5F9Wkg_88bkq…"
          -getUserName(): string: "Janae Ask"
          -getText(): string: "I've been a diehard chrome fan for years but I noticed today that my app updated and my home page button disappeared. I'm super annoyed and honestly I…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -getUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mCTnjMGOtddUmBD8ley9nDfJxi_hPPlQFYFNimY=s64"
            -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mCTnjMGOtddUmBD8ley9nDfJxi_hPPlQFYFNimY=s0"
            -getBinaryImageContent(): string: …
            -__toString(): string: "https://lh3.googleusercontent.com/a-/AAuE7mCTnjMGOtddUmBD8ley9nDfJxi_hPPlQFYFNimY=s64"
          }
          -getDate(): ?DateTimeInterface: @1581740061 {
            date: 2020-02-15T04:14:21+00:00
          }
          -getScore(): int: 1
          -getCountLikes(): int: 24
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -asArray(): array: …
          -jsonSerialize(): mixed: …
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
        -jsonSerialize(): mixed: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk"
      }
      -getScore(): float: 4.371647
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -jsonSerialize(): mixed: …
      -getDescription(): string: """
        Google Chrome est un navigateur Web rapide, simple d'utilisation et sécurisé. Conçu pour Android, Chrome vous permet de consulter une sélection person…
        """
      -isAutoTranslatedDescription(): bool: false
      -getTranslatedFromLocale(): ?string: null
      -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/rcUvNWE0WrExleYaz3l2XS_8tMOJLtdNTzHz9AXLJDPrkUZqQcY-cMxSSRUOWJteNq4"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/rcUvNWE0WrExleYaz3l2XS_8tMOJLtdNTzHz9AXLJDPrkUZqQcY-cMxSSRUOWJteNq4=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/rcUvNWE0WrExleYaz3l2XS_8tMOJLtdNTzHz9AXLJDPrkUZqQcY-cMxSSRUOWJteNq4"
      }
      -getScreenshots(): array:18 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -getUrl(): string: "https://lh3.googleusercontent.com/BkLzaEgIaYIViqMAMnZnWrl9RcZouqH8mHstYVARFP3MYNZB6VeZJGJf3S7Xe_VUuyzt"
          -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/BkLzaEgIaYIViqMAMnZnWrl9RcZouqH8mHstYVARFP3MYNZB6VeZJGJf3S7Xe_VUuyzt=s0"
          -getBinaryImageContent(): string: …
          -__toString(): string: "https://lh3.googleusercontent.com/BkLzaEgIaYIViqMAMnZnWrl9RcZouqH8mHstYVARFP3MYNZB6VeZJGJf3S7Xe_VUuyzt"
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -getUrl(): string: "https://lh3.googleusercontent.com/rJcp_1FVBvblJjs6SpAsLglKV9EH_sn2Oa47CC1vfw1fwXwVQh12N4tqQsYMJiAzUUc"
          -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/rJcp_1FVBvblJjs6SpAsLglKV9EH_sn2Oa47CC1vfw1fwXwVQh12N4tqQsYMJiAzUUc=s0"
          -getBinaryImageContent(): string: …
          -__toString(): string: "https://lh3.googleusercontent.com/rJcp_1FVBvblJjs6SpAsLglKV9EH_sn2Oa47CC1vfw1fwXwVQh12N4tqQsYMJiAzUUc"
        }
        …
      ]
      -getCategory(): Nelexa\GPlay\Model\Category: {
        -getId(): string: "COMMUNICATION"
        -getName(): string: "Communication"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getCategoryFamily(): ?Nelexa\GPlay\Model\Category: null
      -getVideo(): ?Nelexa\GPlay\Model\Video: null
      -getRecentChanges(): ?string: "Merci d'avoir choisi Chrome ! Cette version inclut des améliorations de la stabilité et des performances."
      -isEditorsChoice(): bool: false
      -getInstalls(): int: 6109119447
      -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
        -getFiveStars(): int: 13653227
        -getFourStars(): int: 2319199
        -getThreeStars(): int: 1115226
        -getTwoStars(): int: 545244
        -getOneStar(): int: 1451604
        -asArray(): array: …
        -jsonSerialize(): mixed: …
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
      -getUpdated(): ?DateTimeInterface: @1581622298 {
        date: 2020-02-13T19:31:38+00:00
      }
      -getNumberVoters(): int: 19084503
      -getNumberReviews(): int: 5581172
      -getReviews(): array:4 [
        0 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOHhVlm5JUKBgyuPv-Scje53SialWEXc2UMB9_fmrVbRLP1H9i9TYRR9uZSqIBk_XNKYalsOh78ISfMtlTo"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.android.chrome&reviewId=gp%3AAOqpTOHhVlm5JUKBgyuPv-Scje53SialWEXc2UMB9_fmrVbRLP1H9i9TYRR9uZSqIBk_XNK…"
          -getUserName(): string: "Dm Go"
          -getText(): string: "Très bien jusqu'à la dernière mise à jour, le changement des onglets est devenu BEAUCOUP moins pratique qu'avant, où l'on pouvait facilement se repére…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -getUrl(): string: "https://lh3.googleusercontent.com/-yWvPQ0z6fjc/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rd3CK1CsmcQirNT0a5YpECXWUQoUg/s64/"
            -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/-yWvPQ0z6fjc/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rd3CK1CsmcQirNT0a5YpECXWUQoUg/s0/"
            -getBinaryImageContent(): string: …
            -__toString(): string: "https://lh3.googleusercontent.com/-yWvPQ0z6fjc/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rd3CK1CsmcQirNT0a5YpECXWUQoUg/s64/"
          }
          -getDate(): ?DateTimeInterface: @1581813065 {
            date: 2020-02-16T00:31:05+00:00
          }
          -getScore(): int: 3
          -getCountLikes(): int: 10
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -asArray(): array: …
          -jsonSerialize(): mixed: …
        }
        1 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOHqBCktJMi0UcJ3WV-txYU6EOJO5clMdr06hBUP7QgGHQjqBVNl83xNAd82uLEo3JYc28drRhCExmN0i3I"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.android.chrome&reviewId=gp%3AAOqpTOHqBCktJMi0UcJ3WV-txYU6EOJO5clMdr06hBUP7QgGHQjqBVNl83xNAd82uLEo3JY…"
          -getUserName(): string: "Dimitri Czech"
          -getText(): string: "Pleins de détails avec cette mise à jour ne sont plus là et ce sont les détails qui font la différence parfois. Ne plus pouvoir zapper les infos sur l…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -getUrl(): string: "https://lh3.googleusercontent.com/-lKPxhT_CIfw/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rc4XRvV2xeLFwFTrivo4jpsKPBurw/s64/"
            -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/-lKPxhT_CIfw/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rc4XRvV2xeLFwFTrivo4jpsKPBurw/s0/"
            -getBinaryImageContent(): string: …
            -__toString(): string: "https://lh3.googleusercontent.com/-lKPxhT_CIfw/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rc4XRvV2xeLFwFTrivo4jpsKPBurw/s64/"
          }
          -getDate(): ?DateTimeInterface: @1581444709 {
            date: 2020-02-11T18:11:49+00:00
          }
          -getScore(): int: 2
          -getCountLikes(): int: 75
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -asArray(): array: …
          -jsonSerialize(): mixed: …
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
