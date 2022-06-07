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
      -getDescription(): string: """
        Google Chrome is a fast, easy to use, and secure web browser. Designed for Android, Chrome brings you personalized news articles, quick links to your …
        """
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk"
        -getUrl(): string: "https://play-lh.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:14 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/zNteEAWnOwZ9rSewvLziSgcK-jApPMf3SouV8e0aaDpSq71IKa82_PSguI63CWEjV2M"
          -getUrl(): string: "https://play-lh.googleusercontent.com/zNteEAWnOwZ9rSewvLziSgcK-jApPMf3SouV8e0aaDpSq71IKa82_PSguI63CWEjV2M"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/zNteEAWnOwZ9rSewvLziSgcK-jApPMf3SouV8e0aaDpSq71IKa82_PSguI63CWEjV2M=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/lMbdwtu9mb66J9xRxxYH9vtobiZl_cnGfnHhguDkKb9LxJQUAS_UtaYzI8K0NS5QftE"
          -getUrl(): string: "https://play-lh.googleusercontent.com/lMbdwtu9mb66J9xRxxYH9vtobiZl_cnGfnHhguDkKb9LxJQUAS_UtaYzI8K0NS5QftE"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/lMbdwtu9mb66J9xRxxYH9vtobiZl_cnGfnHhguDkKb9LxJQUAS_UtaYzI8K0NS5QftE=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.1628103
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "10,000,000,000+"
      -jsonSerialize(): array: …
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: {
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
      -getDeveloperName(): mixed: "Google LLC"
      -getSummary(): string: "Fast, simple, and secure. Google Chrome browser for Android phones and tablets."
      -getTranslatedFromLocale(): mixed: null
      -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/WPIJiEaY1kOU3-zogfv11ILu-mCaKhdq7hy2LXZ7JoLFTqGW3ZUXpRCTM7_dvPuBgB0"
        -getUrl(): string: "https://play-lh.googleusercontent.com/WPIJiEaY1kOU3-zogfv11ILu-mCaKhdq7hy2LXZ7JoLFTqGW3ZUXpRCTM7_dvPuBgB0"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/WPIJiEaY1kOU3-zogfv11ILu-mCaKhdq7hy2LXZ7JoLFTqGW3ZUXpRCTM7_dvPuBgB0=s0"
        -getBinaryImageContent(): string: …
      }
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
      -getInstalls(): int: 11148872337
      -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
        -getFiveStars(): int: 4486994
        -getFourStars(): int: 1503208
        -getThreeStars(): int: 2579594
        -getTwoStars(): int: 4886732
        -getOneStar(): int: 25368105
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getPrice(): float: 0.0
      -getCurrency(): string: "USD"
      -isContainsIAP(): bool: false
      -getOffersIAPCost(): ?string: null
      -isContainsAds(): bool: false
      -getSize(): mixed: null
      -getAppVersion(): ?string: null
      -getAndroidVersion(): ?string: null
      -getMinAndroidVersion(): ?string: null
      -getContentRating(): ?string: ""
      -getPrivacyPoliceUrl(): ?string: "http://www.google.com/chrome/intl/en/privacy.html"
      -getReleased(): ?DateTimeInterface: @1328634643 {
        date: 2012-02-07T17:10:43+00:00
      }
      -getUpdated(): ?DateTimeInterface: @1654187450 {
        date: 2022-06-02T16:30:50+00:00
      }
      -getNumberVoters(): int: 38824672
      -getNumberReviews(): int: 893737
      -getReviews(): array: array:40 [
        0 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOH14rB-VncCI2jhw2kiT_MV5g5daUbNGTak6dySlV-wGAUL_1M-DW0K7f_Es0OEXYFOc0-SKBSWxnHsCXU"
          -getUrl(): mixed: ""
          -getUserName(): string: "Kendra McCool"
          -getText(): string: "The app has been malfunctioning. It's been making my other apps crash or lag, and has been giving me random pop ups. I tried restarting my phone, upda…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgjDGLMmRMznkH9h8I95v0MQ3bDUqneFlaPYOJKdA=s64"
            -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgjDGLMmRMznkH9h8I95v0MQ3bDUqneFlaPYOJKdA=s64"
            -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgjDGLMmRMznkH9h8I95v0MQ3bDUqneFlaPYOJKdA=s0"
            -getBinaryImageContent(): string: …
          }
          -getDate(): ?DateTimeInterface: @1652244609 {
            date: 2022-05-11T04:50:09+00:00
          }
          -getScore(): int: 1
          -getCountLikes(): int: 10149
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -getAppVersion(): ?string: "101.0.4951.61"
          -asArray(): array: …
          -jsonSerialize(): array: …
        }
        1 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOEuvMfRNC2Zh0nA7FKeni28xcoEtoo_K872GaUrKT4UbB9To2n4ThTYyN6WZ4EcuS0Y3MqC18sKVmOv2RQ"
          -getUrl(): mixed: ""
          -getUserName(): string: "Ryan Volkert"
          -getText(): string: "A bug has recently been introduced to Chrome, namely that every time I try to change the "parent folder" when creating a new bookmark folder, Chrome i…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -__toString(): string: "https://play-lh.googleusercontent.com/a/AATXAJyNLTx3fuRcFPRBucyduDRTDXitSxochqkvut5q=s64"
            -getUrl(): string: "https://play-lh.googleusercontent.com/a/AATXAJyNLTx3fuRcFPRBucyduDRTDXitSxochqkvut5q=s64"
            -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a/AATXAJyNLTx3fuRcFPRBucyduDRTDXitSxochqkvut5q=s0"
            -getBinaryImageContent(): string: …
          }
          -getDate(): ?DateTimeInterface: @1654346625 {
            date: 2022-06-04T12:43:45+00:00
          }
          -getScore(): int: 1
          -getCountLikes(): int: 353
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -getAppVersion(): ?string: "102.0.5005.78"
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
      -getDescription(): string: """
        Google Chrome est un navigateur Web rapide, simple d'utilisation et sécurisé. Conçu pour Android, Chrome vous permet de consulter une sélection person…
        """
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk"
        -getUrl(): string: "https://play-lh.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:14 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/ic6G4xaTAtz08BCZOlIUCcQZhkCHfLL7eXTUZaIxlC5MdZXJ8yVNMmYfJ_XOW1jPHp0"
          -getUrl(): string: "https://play-lh.googleusercontent.com/ic6G4xaTAtz08BCZOlIUCcQZhkCHfLL7eXTUZaIxlC5MdZXJ8yVNMmYfJ_XOW1jPHp0"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/ic6G4xaTAtz08BCZOlIUCcQZhkCHfLL7eXTUZaIxlC5MdZXJ8yVNMmYfJ_XOW1jPHp0=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/-dzqKqGhMbBi-2FRwbvCyoTmbp-fwWyHGqyjNabmwq0JiU8XUXjCWENDEKQlfQJvmF5l"
          -getUrl(): string: "https://play-lh.googleusercontent.com/-dzqKqGhMbBi-2FRwbvCyoTmbp-fwWyHGqyjNabmwq0JiU8XUXjCWENDEKQlfQJvmF5l"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/-dzqKqGhMbBi-2FRwbvCyoTmbp-fwWyHGqyjNabmwq0JiU8XUXjCWENDEKQlfQJvmF5l=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.1628103
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "10 000 000 000+"
      -jsonSerialize(): array: …
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: {
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
      -getDeveloperName(): mixed: "Google LLC"
      -getSummary(): string: "Rapide, simple et sécurisé. Navigateur Chrome pour téléphones/tablettes Android."
      -getTranslatedFromLocale(): mixed: null
      -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/rcUvNWE0WrExleYaz3l2XS_8tMOJLtdNTzHz9AXLJDPrkUZqQcY-cMxSSRUOWJteNq4"
        -getUrl(): string: "https://play-lh.googleusercontent.com/rcUvNWE0WrExleYaz3l2XS_8tMOJLtdNTzHz9AXLJDPrkUZqQcY-cMxSSRUOWJteNq4"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/rcUvNWE0WrExleYaz3l2XS_8tMOJLtdNTzHz9AXLJDPrkUZqQcY-cMxSSRUOWJteNq4=s0"
        -getBinaryImageContent(): string: …
      }
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
      -getInstalls(): int: 11148872337
      -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
        -getFiveStars(): int: 4486994
        -getFourStars(): int: 1503208
        -getThreeStars(): int: 2579594
        -getTwoStars(): int: 4886732
        -getOneStar(): int: 25368105
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getPrice(): float: 0.0
      -getCurrency(): string: "USD"
      -isContainsIAP(): bool: false
      -getOffersIAPCost(): ?string: null
      -isContainsAds(): bool: false
      -getSize(): mixed: null
      -getAppVersion(): ?string: null
      -getAndroidVersion(): ?string: null
      -getMinAndroidVersion(): ?string: null
      -getContentRating(): ?string: ""
      -getPrivacyPoliceUrl(): ?string: "http://www.google.com/chrome/intl/en/privacy.html"
      -getReleased(): ?DateTimeInterface: @1328634643 {
        date: 2012-02-07T17:10:43+00:00
      }
      -getUpdated(): ?DateTimeInterface: @1654187450 {
        date: 2022-06-02T16:30:50+00:00
      }
      -getNumberVoters(): int: 38824672
      -getNumberReviews(): int: 893737
      -getReviews(): array: array:40 [
        0 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOFf5FcjVaLqlnHvMQGFJBwE1pJt_EXNwZ1Q1x3qhcHN5sPXg3gazSppEkufhLeum0mG2LvfGiSRx77HMgo"
          -getUrl(): mixed: ""
          -getUserName(): string: "M Th"
          -getText(): string: "Pas plus de deux étoiles parce que Chrome fait partie des applis qu'on ne peut pas désinstaller. &&& Chrome veut tout savoir sur nous. Son fonctionnem…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -__toString(): string: "https://play-lh.googleusercontent.com/a/AATXAJxAYsttyJa4rQV1JuGMlPUWcn5ySuLC-XAU_UoYSQ=s64"
            -getUrl(): string: "https://play-lh.googleusercontent.com/a/AATXAJxAYsttyJa4rQV1JuGMlPUWcn5ySuLC-XAU_UoYSQ=s64"
            -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a/AATXAJxAYsttyJa4rQV1JuGMlPUWcn5ySuLC-XAU_UoYSQ=s0"
            -getBinaryImageContent(): string: …
          }
          -getDate(): ?DateTimeInterface: @1652341401 {
            date: 2022-05-12T07:43:21+00:00
          }
          -getScore(): int: 2
          -getCountLikes(): int: 2497
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: {
            -getDate(): DateTimeInterface: @1652345789 {
              date: 2022-05-12T08:56:29+00:00
            }
            -getText(): string: """
              Bonjour. Google Chrome est une application par défaut sur le système Android. Jetez un coup d'œil à cet article pour savoir comment désactiver les app…
              """
            -asArray(): array: …
            -jsonSerialize(): array: …
          }
          -getAppVersion(): ?string: "101.0.4951.61"
          -asArray(): array: …
          -jsonSerialize(): array: …
        }
        1 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOHYKJUdQyNP21y9yAmx_85Uzf93-HwQH0HOd7HyGUdQ_aYNmfN9sqtPX5n6Yx7BxHzCC7H2f109JG2b3l4"
          -getUrl(): mixed: ""
          -getUserName(): string: "DrikC"
          -getText(): string: "Bonjour. J'ai un problème avec votre application depuis que j'ai changé de smartphone. Dorénavant sur ce nouveau mobile, elle s'ouvre très régulièreme…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14Gh-g5MmJFyUn-QtuiRkN9vablliX0j86_S81iVDIA=s64"
            -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14Gh-g5MmJFyUn-QtuiRkN9vablliX0j86_S81iVDIA=s64"
            -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14Gh-g5MmJFyUn-QtuiRkN9vablliX0j86_S81iVDIA=s0"
            -getBinaryImageContent(): string: …
          }
          -getDate(): ?DateTimeInterface: @1654267370 {
            date: 2022-06-03T14:42:50+00:00
          }
          -getScore(): int: 1
          -getCountLikes(): int: 142
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: {
            -getDate(): DateTimeInterface: @1654267451 {
              date: 2022-06-03T14:44:11+00:00
            }
            -getText(): string: "Bonjour. Si l'application Chrome s'ouvre aléatoirement, essayez de réinitialiser ses données. Pour plus d'infos, consultez la section "Vider le cache …"
            -asArray(): array: …
            -jsonSerialize(): array: …
          }
          -getAppVersion(): ?string: "101.0.4951.41"
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
