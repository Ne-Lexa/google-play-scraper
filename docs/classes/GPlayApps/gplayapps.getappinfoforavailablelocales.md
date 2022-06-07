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
array:78 [
    "en_US" => class Nelexa\GPlay\Model\AppInfo {
      -getId(): string: "nl.nibbixsoft.app"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=nl.nibbixsoft.app"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=nl.nibbixsoft.app&hl=en_US&gl=us"
      -getName(): string: "Nederland.FM - Radio"
      -getDescription(): string: "Online, live, gratis en eenvoudig luisteren naar de beste radio stations van Nederland !"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/el-J9cb_oujzyYw450iaExvKJ1LkJ8aynobCWcHcqJr2LhiXtsI2jaQn7vP9nJFKd2g"
        -getUrl(): string: "https://play-lh.googleusercontent.com/el-J9cb_oujzyYw450iaExvKJ1LkJ8aynobCWcHcqJr2LhiXtsI2jaQn7vP9nJFKd2g"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/el-J9cb_oujzyYw450iaExvKJ1LkJ8aynobCWcHcqJr2LhiXtsI2jaQn7vP9nJFKd2g=s0"
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
      -getScore(): float: 3.9333334
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "500,000+"
      -jsonSerialize(): array: …
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: {
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
      -getDeveloperName(): mixed: "Nederland.FM BV"
      -getSummary(): string: "online Radio"
      -getTranslatedFromLocale(): mixed: null
      -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/MF1Jx3AoUYFvl66JZlq9HgmHVAAzliDasGl1VAEAl_ctjTWyHCXpDel6XrElM2C-d24"
        -getUrl(): string: "https://play-lh.googleusercontent.com/MF1Jx3AoUYFvl66JZlq9HgmHVAAzliDasGl1VAEAl_ctjTWyHCXpDel6XrElM2C-d24"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/MF1Jx3AoUYFvl66JZlq9HgmHVAAzliDasGl1VAEAl_ctjTWyHCXpDel6XrElM2C-d24=s0"
        -getBinaryImageContent(): string: …
      }
      -getCategory(): ?Nelexa\GPlay\Model\Category: {
        -getId(): string: "MUSIC_AND_AUDIO"
        -getName(): string: "Music & Audio"
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
      -getInstalls(): int: 742748
      -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
        -getFiveStars(): int: 0
        -getFourStars(): int: 164
        -getThreeStars(): int: 492
        -getTwoStars(): int: 1148
        -getOneStar(): int: 656
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getPrice(): float: 0.0
      -getCurrency(): string: "USD"
      -isContainsIAP(): bool: false
      -getOffersIAPCost(): ?string: null
      -isContainsAds(): bool: true
      -getSize(): mixed: null
      -getAppVersion(): ?string: "7.0"
      -getAndroidVersion(): ?string: "4.1"
      -getMinAndroidVersion(): ?string: "4.1"
      -getContentRating(): ?string: ""
      -getPrivacyPoliceUrl(): ?string: "http://www.nederland.fm/cookies.php"
      -getReleased(): ?DateTimeInterface: @1502282388 {
        date: 2017-08-09T12:39:48+00:00
      }
      -getUpdated(): ?DateTimeInterface: @1625992062 {
        date: 2021-07-11T08:27:42+00:00
      }
      -getNumberVoters(): int: 2460
      -getNumberReviews(): int: 0
      -getReviews(): array: array:30 [
        0 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOHY5QUPcWS6yuk7gAICDpv9MD2nkCz4k9wvT5tU37NRgCWeVXisefasOOQ-wjdBVnrnh6OXnMAe9O71nQ"
          -getUrl(): mixed: ""
          -getUserName(): string: "Anton van Nieuwenhuyzen"
          -getText(): string: "Very unsatisfied since the app introduced ads while listening to the radio! Please offer alternatives without ads or payments!"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -__toString(): string: "https://play-lh.googleusercontent.com/a/AATXAJzq13O--6_y5FKpcvJrEMI5DsIHn_4Kqaqv4cTL=s64"
            -getUrl(): string: "https://play-lh.googleusercontent.com/a/AATXAJzq13O--6_y5FKpcvJrEMI5DsIHn_4Kqaqv4cTL=s64"
            -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a/AATXAJzq13O--6_y5FKpcvJrEMI5DsIHn_4Kqaqv4cTL=s0"
            -getBinaryImageContent(): string: …
          }
          -getDate(): ?DateTimeInterface: @1629281437 {
            date: 2021-08-18T10:10:37+00:00
          }
          -getScore(): int: 1
          -getCountLikes(): int: 1
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -getAppVersion(): ?string: "7.0"
          -asArray(): array: …
          -jsonSerialize(): array: …
        }
        1 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOG_H2g6DceMPsgNPAk2S_7hamynz_s3Tmxz-y9xuFDvor10h6mJ2zaeHbx5H9sznNchT_WjqCmqj88k4g"
          -getUrl(): mixed: ""
          -getUserName(): string: "A Google user"
          -getText(): string: "Easy to use and reasonable sound quality, stays on in background using other apps or without screen"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -__toString(): string: "https://play-lh.googleusercontent.com/EGemoI2NTXmTsBVtJqk8jxF9rh8ApRWfsIMQSt2uE4OcpQqbFu7f7NbTK05lx80nuSijCz7sc3a277R67g=s64"
            -getUrl(): string: "https://play-lh.googleusercontent.com/EGemoI2NTXmTsBVtJqk8jxF9rh8ApRWfsIMQSt2uE4OcpQqbFu7f7NbTK05lx80nuSijCz7sc3a277R67g=s64"
            -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/EGemoI2NTXmTsBVtJqk8jxF9rh8ApRWfsIMQSt2uE4OcpQqbFu7f7NbTK05lx80nuSijCz7sc3a277R67g=s0"
            -getBinaryImageContent(): string: …
          }
          -getDate(): ?DateTimeInterface: @1557845440 {
            date: 2019-05-14T14:50:40+00:00
          }
          -getScore(): int: 4
          -getCountLikes(): int: 9
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -getAppVersion(): ?string: null
          -asArray(): array: …
          -jsonSerialize(): array: …
        }
        …
      ]
      -asArray(): array: …
    }
    "af" => class Nelexa\GPlay\Model\AppInfo {
      -getId(): string: "nl.nibbixsoft.app"
      -getLocale(): string: "af"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=nl.nibbixsoft.app"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=nl.nibbixsoft.app&hl=af&gl=us"
      -getName(): string: "Nederland.FM - Radio"
      -getDescription(): string: "Online, live, gratis en eenvoudig luisteren naar de beste radio stations van Nederland !"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/el-J9cb_oujzyYw450iaExvKJ1LkJ8aynobCWcHcqJr2LhiXtsI2jaQn7vP9nJFKd2g"
        -getUrl(): string: "https://play-lh.googleusercontent.com/el-J9cb_oujzyYw450iaExvKJ1LkJ8aynobCWcHcqJr2LhiXtsI2jaQn7vP9nJFKd2g"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/el-J9cb_oujzyYw450iaExvKJ1LkJ8aynobCWcHcqJr2LhiXtsI2jaQn7vP9nJFKd2g=s0"
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
      -getScore(): float: 3.9333334
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "500 000+"
      -jsonSerialize(): array: …
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: {
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
      -getDeveloperName(): mixed: "Nederland.FM BV"
      -getSummary(): string: "Online Radio"
      -getTranslatedFromLocale(): mixed: null
      -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/MF1Jx3AoUYFvl66JZlq9HgmHVAAzliDasGl1VAEAl_ctjTWyHCXpDel6XrElM2C-d24"
        -getUrl(): string: "https://play-lh.googleusercontent.com/MF1Jx3AoUYFvl66JZlq9HgmHVAAzliDasGl1VAEAl_ctjTWyHCXpDel6XrElM2C-d24"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/MF1Jx3AoUYFvl66JZlq9HgmHVAAzliDasGl1VAEAl_ctjTWyHCXpDel6XrElM2C-d24=s0"
        -getBinaryImageContent(): string: …
      }
      -getCategory(): ?Nelexa\GPlay\Model\Category: {
        -getId(): string: "MUSIC_AND_AUDIO"
        -getName(): string: "Musiek en oudio"
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
      -getInstalls(): int: 742748
      -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
        -getFiveStars(): int: 0
        -getFourStars(): int: 164
        -getThreeStars(): int: 492
        -getTwoStars(): int: 1148
        -getOneStar(): int: 656
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getPrice(): float: 0.0
      -getCurrency(): string: "USD"
      -isContainsIAP(): bool: false
      -getOffersIAPCost(): ?string: null
      -isContainsAds(): bool: true
      -getSize(): mixed: null
      -getAppVersion(): ?string: "7.0"
      -getAndroidVersion(): ?string: "4.1"
      -getMinAndroidVersion(): ?string: "4.1"
      -getContentRating(): ?string: ""
      -getPrivacyPoliceUrl(): ?string: "http://www.nederland.fm/cookies.php"
      -getReleased(): ?DateTimeInterface: @1502282388 {
        date: 2017-08-09T12:39:48+00:00
      }
      -getUpdated(): ?DateTimeInterface: @1625992062 {
        date: 2021-07-11T08:27:42+00:00
      }
      -getNumberVoters(): int: 2460
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
