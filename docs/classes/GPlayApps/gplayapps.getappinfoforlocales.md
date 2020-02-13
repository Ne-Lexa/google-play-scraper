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
      -getScore(): float: 4.370738
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
      -getRecentChanges(): ?string: "Thanks for choosing Chrome! This release includes stability and performance improvements."
      -isEditorsChoice(): bool: false
      -getInstalls(): int: 6090507724
      -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
        -getFiveStars(): int: 13585003
        -getFourStars(): int: 2314160
        -getThreeStars(): int: 1114345
        -getTwoStars(): int: 545061
        -getOneStar(): int: 1445057
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
      -getUpdated(): ?DateTimeInterface: @1581455005 {
        date: 2020-02-11T21:03:25+00:00
      }
      -getNumberVoters(): int: 19003628
      -getNumberReviews(): int: 5552461
      -getReviews(): array:4 [
        0 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOEsmqp5FTgADw-dLlv2Rgdhnr5-aE2Ssv5yUNA55w6xFinXuBYTuUSfyEgpxxUfrRDAiYlEMrPDNyAIXl0"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.android.chrome&reviewId=gp%3AAOqpTOEsmqp5FTgADw-dLlv2Rgdhnr5-aE2Ssv5yUNA55w6xFinXuBYTuUSfyEgpxxUfrRD…"
          -getUserName(): string: "Yanaica Reinink"
          -getText(): string: "This app always worked fine but recently it's been having trouble on my device. I even had to switch to a different browser. Chrome won't load my page…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -getUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mAlgN8IWBo27FAuQv8WTTT4mnEZyzPK5_n6s1wz=s64"
            -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mAlgN8IWBo27FAuQv8WTTT4mnEZyzPK5_n6s1wz=s0"
            -getBinaryImageContent(): string: …
            -__toString(): string: "https://lh3.googleusercontent.com/a-/AAuE7mAlgN8IWBo27FAuQv8WTTT4mnEZyzPK5_n6s1wz=s64"
          }
          -getDate(): ?DateTimeInterface: @1581446345 {
            date: 2020-02-11T18:39:05+00:00
          }
          -getScore(): int: 2
          -getCountLikes(): int: 114
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: {
            -getDate(): DateTimeInterface: @1581447931 {
              date: 2020-02-11T19:05:31+00:00
            }
            -getText(): string: "Hey Yanaica. Let's try resetting Chrome's app data. You can learn how in this help center article under the "Clear the app's cache" section: https://g…"
            -asArray(): array: …
            -jsonSerialize(): mixed: …
          }
          -asArray(): array: …
          -jsonSerialize(): mixed: …
        }
        1 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOE0uqCbq9NlXoyjCfnu0l5nRRKybZ0-hwT1T_RpJs7GlxyjtBtvVcL7yJbhY7RilHeMYfUya4gWM6xe0Tw"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.android.chrome&reviewId=gp%3AAOqpTOE0uqCbq9NlXoyjCfnu0l5nRRKybZ0-hwT1T_RpJs7GlxyjtBtvVcL7yJbhY7RilHe…"
          -getUserName(): string: "Queen Lie"
          -getText(): string: "Everyone can visit: ( BrowserGood. Com ) to install the best browser app. It's adblock and faster. Everytime I have chrome, and its not by choice, onl…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -getUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mADpm9XahajGfNYJRiRpG4lA6F_EU_Mri54vV-Q=s64"
            -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mADpm9XahajGfNYJRiRpG4lA6F_EU_Mri54vV-Q=s0"
            -getBinaryImageContent(): string: …
            -__toString(): string: "https://lh3.googleusercontent.com/a-/AAuE7mADpm9XahajGfNYJRiRpG4lA6F_EU_Mri54vV-Q=s64"
          }
          -getDate(): ?DateTimeInterface: @1581353069 {
            date: 2020-02-10T16:44:29+00:00
          }
          -getScore(): int: 2
          -getCountLikes(): int: 77
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
      -getScore(): float: 4.370738
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
      -getInstalls(): int: 6090507724
      -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
        -getFiveStars(): int: 13584963
        -getFourStars(): int: 2314154
        -getThreeStars(): int: 1114342
        -getTwoStars(): int: 545059
        -getOneStar(): int: 1445052
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
      -getUpdated(): ?DateTimeInterface: @1581455005 {
        date: 2020-02-11T21:03:25+00:00
      }
      -getNumberVoters(): int: 19003572
      -getNumberReviews(): int: 5552448
      -getReviews(): array:4 [
        0 => class Nelexa\GPlay\Model\Review {
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
          -getCountLikes(): int: 3
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -asArray(): array: …
          -jsonSerialize(): mixed: …
        }
        1 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOGxjjr3zKl1nF6W2en68AvKH9FgP63BfZpbYkzN1_FAygaQ7gRPOzkGqKGPq6aLUgRmd52r6MtbsjTjDGE"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.android.chrome&reviewId=gp%3AAOqpTOGxjjr3zKl1nF6W2en68AvKH9FgP63BfZpbYkzN1_FAygaQ7gRPOzkGqKGPq6aLUgR…"
          -getUserName(): string: "Nicolas H."
          -getText(): string: "La dernière mise à jour fait buguer complètement l'application. Elle ne charge plu aucune page, elle charge indéfiniment. Je suis donc retourner sur u…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -getUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mBtaoOmitKuCzYW8g5sThZ28L42FJQzI-BQFBTWlA=s64"
            -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mBtaoOmitKuCzYW8g5sThZ28L42FJQzI-BQFBTWlA=s0"
            -getBinaryImageContent(): string: …
            -__toString(): string: "https://lh3.googleusercontent.com/a-/AAuE7mBtaoOmitKuCzYW8g5sThZ28L42FJQzI-BQFBTWlA=s64"
          }
          -getDate(): ?DateTimeInterface: @1579904128 {
            date: 2020-01-24T22:15:28+00:00
          }
          -getScore(): int: 1
          -getCountLikes(): int: 252
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
