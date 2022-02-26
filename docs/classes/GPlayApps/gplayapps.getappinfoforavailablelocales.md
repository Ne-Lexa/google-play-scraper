[Documentation](../../README.md) > [GPlayApps](README.md) > **getAppInfoForAvailableLocales**

# Nelexa\GPlay\GPlayApps::getAppInfoForAvailableLocales
`Nelexa\GPlay\GPlayApps::getAppInfoForAvailableLocales` — Returns detailed application information for all available locales.

## Description
```php
Nelexa\GPlay\GPlayApps::getAppInfoForAvailableLocales ( string | Nelexa\GPlay\Model\AppId $appId ) : array<string, Nelexa\GPlay\Model\AppInfo>
```
Information is returned only for the description loaded by the developer.
All locales with automated translation from Google Translate will be ignored.
HTTP requests are executed in parallel.

## Parameters
* **$appId** (string | [Nelexa\GPlay\Model\AppId](../AppId/README.md))  
application ID (Android package name) as
a string or [Nelexa\GPlay\Model\AppId](../AppId/README.md) object

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
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/el-J9cb_oujzyYw450iaExvKJ1LkJ8aynobCWcHcqJr2LhiXtsI2jaQn7vP9nJFKd2g"
        -getUrl(): string: "https://play-lh.googleusercontent.com/el-J9cb_oujzyYw450iaExvKJ1LkJ8aynobCWcHcqJr2LhiXtsI2jaQn7vP9nJFKd2g"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/el-J9cb_oujzyYw450iaExvKJ1LkJ8aynobCWcHcqJr2LhiXtsI2jaQn7vP9nJFKd2g=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 3.9333334
      -getPriceText(): ?string: ""
      -isFree(): bool: false
      -jsonSerialize(): array: …
      -getDescription(): string: "Online, live, gratis en eenvoudig luisteren naar de beste radio stations van Nederland !"
      -isAutoTranslatedDescription(): bool: false
      -getTranslatedFromLocale(): ?string: null
      -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/MF1Jx3AoUYFvl66JZlq9HgmHVAAzliDasGl1VAEAl_ctjTWyHCXpDel6XrElM2C-d24"
        -getUrl(): string: "https://play-lh.googleusercontent.com/MF1Jx3AoUYFvl66JZlq9HgmHVAAzliDasGl1VAEAl_ctjTWyHCXpDel6XrElM2C-d24"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/MF1Jx3AoUYFvl66JZlq9HgmHVAAzliDasGl1VAEAl_ctjTWyHCXpDel6XrElM2C-d24=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:9 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/ks7h5PE1lxcXBIGpJzgblSaLLk2SIyF8pCJm1AYUnYAvLO7hPoEFb_QkaI8bwSQIyTE"
          -getUrl(): string: "https://play-lh.googleusercontent.com/ks7h5PE1lxcXBIGpJzgblSaLLk2SIyF8pCJm1AYUnYAvLO7hPoEFb_QkaI8bwSQIyTE"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/ks7h5PE1lxcXBIGpJzgblSaLLk2SIyF8pCJm1AYUnYAvLO7hPoEFb_QkaI8bwSQIyTE=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/NmGpurUQJC_DoX_3d6mvIgwUkWBBR5neJf3COGo1abdyJa5HFKA5IqtmB9mBAYhOUW0"
          -getUrl(): string: "https://play-lh.googleusercontent.com/NmGpurUQJC_DoX_3d6mvIgwUkWBBR5neJf3COGo1abdyJa5HFKA5IqtmB9mBAYhOUW0"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/NmGpurUQJC_DoX_3d6mvIgwUkWBBR5neJf3COGo1abdyJa5HFKA5IqtmB9mBAYhOUW0=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getCategory(): ?Nelexa\GPlay\Model\Category: {
        -getId(): string: "MUSIC_AND_AUDIO"
        -getName(): string: "Muziek en audio"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getCategoryFamily(): ?Nelexa\GPlay\Model\Category: null
      -getVideo(): ?Nelexa\GPlay\Model\Video: null
      -getRecentChanges(): ?string: """
        - Geschikt voor Android Auto\n
        - Problemen opgelost
        """
      -isEditorsChoice(): bool: false
      -getInstalls(): int: 728301
      -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
        -getFiveStars(): int: 649
        -getFourStars(): int: 1137
        -getThreeStars(): int: 487
        -getTwoStars(): int: 162
        -getOneStar(): int: 0
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getPrice(): float: 0.0
      -getCurrency(): string: "USD"
      -isContainsIAP(): bool: false
      -getOffersIAPCost(): ?string: null
      -isContainsAds(): bool: true
      -getSize(): ?string: "6,5M"
      -getAppVersion(): ?string: "7.0"
      -getAndroidVersion(): ?string: "4.1 en hoger"
      -getMinAndroidVersion(): ?string: "4.1"
      -getContentRating(): ?string: "Iedereen"
      -getPrivacyPoliceUrl(): ?string: "http://www.nederland.fm/cookies.php"
      -getReleased(): ?DateTimeInterface: @1502236800 {
        date: 2017-08-09T00:00:00+00:00
      }
      -getUpdated(): ?DateTimeInterface: @1625992062 {
        date: 2021-07-11T08:27:42+00:00
      }
      -getNumberVoters(): int: 2437
      -getNumberReviews(): int: 0
      -getReviews(): array: array:4 [
        0 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOF4FLkx0AUXd_kG6F2iYnIP1ixCa17iis6SO2octmf0WbdLHP3B80m4tc7tGUjuj7259RbuAsKDYlvK_g"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=nl.nibbixsoft.app&reviewId=gp%3AAOqpTOF4FLkx0AUXd_kG6F2iYnIP1ixCa17iis6SO2octmf0WbdLHP3B80m4tc7tGUjuj725…"
          -getUserName(): string: "Max Rex"
          -getText(): string: "Fantastic app pity you cannot move it to sd card.but its worth 5,better than ever was well done even better app now great work thank you."
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgL7tT8KXwLHBALZzJP-elzvLyVU7-XDF9jgR3eAiQ=s64"
            -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgL7tT8KXwLHBALZzJP-elzvLyVU7-XDF9jgR3eAiQ=s64"
            -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgL7tT8KXwLHBALZzJP-elzvLyVU7-XDF9jgR3eAiQ=s0"
            -getBinaryImageContent(): string: …
          }
          -getDate(): ?DateTimeInterface: @1636736376 {
            date: 2021-11-12T16:59:36+00:00
          }
          -getScore(): int: 5
          -getCountLikes(): int: 6
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -asArray(): array: …
          -jsonSerialize(): array: …
        }
        1 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOEBa_5koHnvNNFEmKIoGpW3uWp2Ouu6-47HHADnYzIrKX_VUHd8uEshJKwx3kNwtQQzHlbyzv-o93cbEQ"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=nl.nibbixsoft.app&reviewId=gp%3AAOqpTOEBa_5koHnvNNFEmKIoGpW3uWp2Ouu6-47HHADnYzIrKX_VUHd8uEshJKwx3kNwtQQz…"
          -getUserName(): string: "Fred Zeeuw"
          -getText(): string: "Bij direct via telefoon luisteren gaat het prima. Als je radio gaat casten dan valt na 30 seconden het geluid weg. En niet alleen bij mij maar ook via…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -__toString(): string: "https://play-lh.googleusercontent.com/a/AATXAJwhXfo7s8dT_15gMWIBdSwam2lgkMKRc8G6u21Q=s64"
            -getUrl(): string: "https://play-lh.googleusercontent.com/a/AATXAJwhXfo7s8dT_15gMWIBdSwam2lgkMKRc8G6u21Q=s64"
            -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a/AATXAJwhXfo7s8dT_15gMWIBdSwam2lgkMKRc8G6u21Q=s0"
            -getBinaryImageContent(): string: …
          }
          -getDate(): ?DateTimeInterface: @1635352879 {
            date: 2021-10-27T16:41:19+00:00
          }
          -getScore(): int: 1
          -getCountLikes(): int: 9
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -asArray(): array: …
          -jsonSerialize(): array: …
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
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/el-J9cb_oujzyYw450iaExvKJ1LkJ8aynobCWcHcqJr2LhiXtsI2jaQn7vP9nJFKd2g"
        -getUrl(): string: "https://play-lh.googleusercontent.com/el-J9cb_oujzyYw450iaExvKJ1LkJ8aynobCWcHcqJr2LhiXtsI2jaQn7vP9nJFKd2g"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/el-J9cb_oujzyYw450iaExvKJ1LkJ8aynobCWcHcqJr2LhiXtsI2jaQn7vP9nJFKd2g=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 3.9333334
      -getPriceText(): ?string: ""
      -isFree(): bool: false
      -jsonSerialize(): array: …
      -getDescription(): string: "Առցանց, ապրում, ազատ եւ հեշտ է լսել լավագույն ռադիոկայանների Նիդեռլանդներում."
      -isAutoTranslatedDescription(): bool: false
      -getTranslatedFromLocale(): ?string: null
      -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/MF1Jx3AoUYFvl66JZlq9HgmHVAAzliDasGl1VAEAl_ctjTWyHCXpDel6XrElM2C-d24"
        -getUrl(): string: "https://play-lh.googleusercontent.com/MF1Jx3AoUYFvl66JZlq9HgmHVAAzliDasGl1VAEAl_ctjTWyHCXpDel6XrElM2C-d24"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/MF1Jx3AoUYFvl66JZlq9HgmHVAAzliDasGl1VAEAl_ctjTWyHCXpDel6XrElM2C-d24=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:9 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/ks7h5PE1lxcXBIGpJzgblSaLLk2SIyF8pCJm1AYUnYAvLO7hPoEFb_QkaI8bwSQIyTE"
          -getUrl(): string: "https://play-lh.googleusercontent.com/ks7h5PE1lxcXBIGpJzgblSaLLk2SIyF8pCJm1AYUnYAvLO7hPoEFb_QkaI8bwSQIyTE"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/ks7h5PE1lxcXBIGpJzgblSaLLk2SIyF8pCJm1AYUnYAvLO7hPoEFb_QkaI8bwSQIyTE=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/NmGpurUQJC_DoX_3d6mvIgwUkWBBR5neJf3COGo1abdyJa5HFKA5IqtmB9mBAYhOUW0"
          -getUrl(): string: "https://play-lh.googleusercontent.com/NmGpurUQJC_DoX_3d6mvIgwUkWBBR5neJf3COGo1abdyJa5HFKA5IqtmB9mBAYhOUW0"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/NmGpurUQJC_DoX_3d6mvIgwUkWBBR5neJf3COGo1abdyJa5HFKA5IqtmB9mBAYhOUW0=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getCategory(): ?Nelexa\GPlay\Model\Category: {
        -getId(): string: "MUSIC_AND_AUDIO"
        -getName(): string: "Երաժշտություն և աուդիո"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getCategoryFamily(): ?Nelexa\GPlay\Model\Category: null
      -getVideo(): ?Nelexa\GPlay\Model\Video: null
      -getRecentChanges(): ?string: """
        - Geschikt voor Android Auto\n
        - Problemen opgelost
        """
      -isEditorsChoice(): bool: false
      -getInstalls(): int: 728301
      -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
        -getFiveStars(): int: 649
        -getFourStars(): int: 1137
        -getThreeStars(): int: 487
        -getTwoStars(): int: 162
        -getOneStar(): int: 0
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getPrice(): float: 0.0
      -getCurrency(): string: "USD"
      -isContainsIAP(): bool: false
      -getOffersIAPCost(): ?string: null
      -isContainsAds(): bool: true
      -getSize(): ?string: "6,5M"
      -getAppVersion(): ?string: "7.0"
      -getAndroidVersion(): ?string: "4.1 և ավելի բարձր"
      -getMinAndroidVersion(): ?string: "4.1"
      -getContentRating(): ?string: "Բոլորի համար"
      -getPrivacyPoliceUrl(): ?string: "http://www.nederland.fm/cookies.php"
      -getReleased(): ?DateTimeInterface: @1502236800 {
        date: 2017-08-09T00:00:00+00:00
      }
      -getUpdated(): ?DateTimeInterface: @1625992062 {
        date: 2021-07-11T08:27:42+00:00
      }
      -getNumberVoters(): int: 2437
      -getNumberReviews(): int: 0
      -getReviews(): array: array:0 []
      -asArray(): array: …
    }
    …
  ]
```

</details>

## See Also
* [Nelexa\GPlay\GPlayApps::setConcurrency()](gplayapps.setconcurrency.md) - Sets the limit of concurrent HTTP requests.

[Documentation](../../README.md) > [GPlayApps](README.md) > **getAppInfoForAvailableLocales**
