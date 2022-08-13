<h1 align="center"><img src="logo.svg" alt="nelexa/google-play-scraper" width="250" height="250"></h1>

# nelexa/google-play-scraper

[![Packagist Version](https://img.shields.io/packagist/v/nelexa/google-play-scraper.svg?style=popout&color=aa007f)](https://packagist.org/packages/nelexa/google-play-scraper) [![Packagist Downloads](https://img.shields.io/packagist/dt/nelexa/google-play-scraper?style=flat-square&labelColor=343b41)](https://packagist.org/packages/nelexa/google-play-scraper) ![PHP from Packagist](https://img.shields.io/packagist/php-v/nelexa/google-play-scraper.svg?style=popout&color=d500a0) ![License](https://img.shields.io/packagist/l/nelexa/google-play-scraper.svg?style=popout&color=ff00bf)
[![Build Status](https://github.com/Ne-Lexa/google-play-scraper/workflows/build/badge.svg)](https://github.com/Ne-Lexa/google-play-scraper/actions) [![Build Status](https://scrutinizer-ci.com/g/Ne-Lexa/google-play-scraper/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Ne-Lexa/google-play-scraper/build-status/master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Ne-Lexa/google-play-scraper/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Ne-Lexa/google-play-scraper/?branch=master) [![Code Coverage](https://scrutinizer-ci.com/g/Ne-Lexa/google-play-scraper/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Ne-Lexa/google-play-scraper/?branch=master)

PHP library to scrape application data from the Google Play store.

- Checking the exists of the app on Google Play.
- Retrieving full app info.
- Retrieving reviews on the app.
- Retrieving a list of app permissions.
- Retrieving a list of similar apps.
- Retrieving a list of categories.
- Retrieving a list of new and the best apps.
- Retrieving a list of apps by the category.
- Retrieving a list of apps by the developer.
- Retrieving info about the developer.
- Retrieving search results.
- Downloading images for the specified size.

## Installation
```shell
composer require nelexa/google-play-scraper
```

## Documentation
[docs/README.md](https://github.com/Ne-Lexa/google-play-scraper/tree/master/docs/README.md)

## Example
```php
// Retrieving full app info

$gplay = new \Nelexa\GPlay\GPlayApps($defaultLocale = 'fr_CA', $defaultCountry = 'ca');
$appInfo = $gplay->getAppInfo('com.google.android.youtube');
```
Result:
```php
class Nelexa\GPlay\Model\AppInfo {
  -getId(): string: "com.google.android.youtube"
  -getLocale(): string: "fr_CA"
  -getCountry(): string: "ca"
  -getUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.youtube"
  -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.youtube&hl=fr_CA&gl=ca"
  -getName(): string: "YouTube"
  -getDescription(): string: """
    Téléchargez l'application YouTube officielle sur votre téléphone ou tablette Android. Découvrez les contenus regardés partout dans le monde : des clip…
    """
  -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
    -__toString(): string: "https://play-lh.googleusercontent.com/lMoItBgdPPVDJsNOVtP26EKHePkwBg-PkuY9NOrc-fumRtTFP4XhpUNk_22syN4Datc"
    -getUrl(): string: "https://play-lh.googleusercontent.com/lMoItBgdPPVDJsNOVtP26EKHePkwBg-PkuY9NOrc-fumRtTFP4XhpUNk_22syN4Datc"
    -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/lMoItBgdPPVDJsNOVtP26EKHePkwBg-PkuY9NOrc-fumRtTFP4XhpUNk_22syN4Datc=s0"
    -getBinaryImageContent(): string: …
  }
  -getScreenshots(): array: array:5 [
    0 => class Nelexa\GPlay\Model\GoogleImage {
      -__toString(): string: "https://play-lh.googleusercontent.com/ysXRzV6uIprDW4_cTODTc3RICYKV57YAzNv7zHeAYpwJpe2lC6Wdx-GuCoSgzCCDwuc"
      -getUrl(): string: "https://play-lh.googleusercontent.com/ysXRzV6uIprDW4_cTODTc3RICYKV57YAzNv7zHeAYpwJpe2lC6Wdx-GuCoSgzCCDwuc"
      -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/ysXRzV6uIprDW4_cTODTc3RICYKV57YAzNv7zHeAYpwJpe2lC6Wdx-GuCoSgzCCDwuc=s0"
      -getBinaryImageContent(): string: …
    }
    1 => class Nelexa\GPlay\Model\GoogleImage {
      -__toString(): string: "https://play-lh.googleusercontent.com/YshbPqiMzsf-UJbTlLhgOXriJw2X_A0HIZ7AX1kfuyk1IkfWjHmTWmYMG0t9pJW3yqU"
      -getUrl(): string: "https://play-lh.googleusercontent.com/YshbPqiMzsf-UJbTlLhgOXriJw2X_A0HIZ7AX1kfuyk1IkfWjHmTWmYMG0t9pJW3yqU"
      -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/YshbPqiMzsf-UJbTlLhgOXriJw2X_A0HIZ7AX1kfuyk1IkfWjHmTWmYMG0t9pJW3yqU=s0"
      -getBinaryImageContent(): string: …
    }
    …
  ]
  -getScore(): float: 3.8564255
  -getPriceText(): ?string: null
  -isFree(): bool: true
  -getInstallsText(): string: "10 000 000 000+"
  -jsonSerialize(): array: …
  -getDeveloper(): ?Nelexa\GPlay\Model\Developer: {
    -getId(): string: "5700313618786177705"
    -getUrl(): string: "https://play.google.com/store/apps/dev?id=5700313618786177705"
    -getName(): string: "Google LLC"
    -getDescription(): ?string: null
    -getWebsite(): ?string: "https://support.google.com/youtube/topic/2422554?rd=1"
    -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
    -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
    -getEmail(): ?string: "ytandroid-support@google.com"
    -getAddress(): ?string: "1600 Amphitheatre Parkway, Mountain View 94043"
    -asArray(): array: …
    -jsonSerialize(): array: …
  }
  -getDeveloperName(): string: "Google LLC"
  -getSummary(): string: "Regardez vos vidéos, chaînes et playlists préférées où que vous soyez."
  -getTranslatedFromLocale(): mixed: null
  -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
    -__toString(): string: "https://play-lh.googleusercontent.com/vA4tG0v4aasE7oIvRIvTkOYTwom07DfqHdUPr6k7jmrDwy_qA_SonqZkw6KX0OXKAdk"
    -getUrl(): string: "https://play-lh.googleusercontent.com/vA4tG0v4aasE7oIvRIvTkOYTwom07DfqHdUPr6k7jmrDwy_qA_SonqZkw6KX0OXKAdk"
    -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/vA4tG0v4aasE7oIvRIvTkOYTwom07DfqHdUPr6k7jmrDwy_qA_SonqZkw6KX0OXKAdk=s0"
    -getBinaryImageContent(): string: …
  }
  -getCategory(): ?Nelexa\GPlay\Model\Category: {
    -getId(): string: "VIDEO_PLAYERS"
    -getName(): string: "Lecteurs vidéo et éditeurs"
    -isGamesCategory(): bool: false
    -isFamilyCategory(): bool: false
    -isApplicationCategory(): bool: true
    -asArray(): array: …
    -jsonSerialize(): array: …
  }
  -getCategoryFamily(): ?Nelexa\GPlay\Model\Category: null
  -getVideo(): ?Nelexa\GPlay\Model\Video: null
  -getRecentChanges(): ?string: "Pour plus d'informations sur les nouvelles fonctionnalités et leur utilisation, consultez la documentation et les notifications intégrées au produit."
  -isEditorsChoice(): bool: false
  -getInstalls(): int: 11923110578
  -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
    -getFiveStars(): int: 28666549
    -getFourStars(): int: 4783408
    -getThreeStars(): int: 7638282
    -getTwoStars(): int: 14217650
    -getOneStar(): int: 83304870
    -asArray(): array: …
    -jsonSerialize(): array: …
  }
  -getPrice(): float: 0.0
  -getCurrency(): string: "CAD"
  -isContainsIAP(): bool: false
  -getOffersIAPCost(): ?string: null
  -isContainsAds(): bool: true
  -getSize(): mixed: null
  -getAppVersion(): ?string: null
  -getAndroidVersion(): ?string: null
  -getMinAndroidVersion(): ?string: null
  -getContentRating(): ?string: ""
  -getPrivacyPoliceUrl(): ?string: "http://www.google.com/policies/privacy"
  -getReleased(): ?DateTimeInterface: @1287601948 {
    date: 2010-10-20T19:12:28+00:00
  }
  -getUpdated(): ?DateTimeInterface: @1654299141 {
    date: 2022-06-03T23:32:21+00:00
  }
  -getNumberVoters(): int: 138611767
  -getNumberReviews(): int: 142747
  -getReviews(): array: array:40 [
    0 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOEMQEAUOLXyd5CBETDY47q0t0LfiCNl0igi4p9DscGE10LQedLKFr6WPPvGFbQ4rTqKu_vR9bf1k2Dl6g"
      -getUrl(): mixed: ""
      -getUserName(): string: "Boromir et Tilou"
      -getText(): string: "Cette application est excellente, cependant il y a quelque problématique niveau pub! Par exemple : il arrive des fois que je regarde une vidéo qui dur…"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GiEuZYl4opeaRXLTVlEPX09UT7O1pu28Xibw2YO=s64"
        -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GiEuZYl4opeaRXLTVlEPX09UT7O1pu28Xibw2YO=s64"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GiEuZYl4opeaRXLTVlEPX09UT7O1pu28Xibw2YO=s0"
        -getBinaryImageContent(): string: …
      }
      -getDate(): ?DateTimeInterface: @1652904683 {
        date: 2022-05-18T20:11:23+00:00
      }
      -getScore(): int: 4
      -getCountLikes(): int: 1929
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
      -getAppVersion(): ?string: "17.19.34"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOEMsRD995sFxjIRu23yRV7za1PH0O2IKHmydCwK9CyQuf4IhL6WNyMsS7ZoEFcdTSI6-akTQAoHGQmzXQ"
      -getUrl(): mixed: ""
      -getUserName(): string: "Mathias Blouin"
      -getText(): string: "Beaucoup trop de publicités, sous-titres qui se mettent tout seul, la résolution n'est JAMAIS sur la plus haute et c'est assez long à changer, des foi…"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GiIFpEtppYtvFbeki1HKoLOHfLOuDfPFOtuvoBFew=s64"
        -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GiIFpEtppYtvFbeki1HKoLOHfLOuDfPFOtuvoBFew=s64"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GiIFpEtppYtvFbeki1HKoLOHfLOuDfPFOtuvoBFew=s0"
        -getBinaryImageContent(): string: …
      }
      -getDate(): ?DateTimeInterface: @1652148284 {
        date: 2022-05-10T02:04:44+00:00
      }
      -getScore(): int: 3
      -getCountLikes(): int: 2569
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
      -getAppVersion(): ?string: "17.17.34"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    …
  ]
  -asArray(): array: …
}
```

# Changelog

Changes are documented in the [releases page](https://github.com/Ne-Lexa/google-play-scraper/releases).

# License

The library is open-sourced software licensed under the [MIT License](https://github.com/Ne-Lexa/google-play-scraper/blob/master/LICENSE).

# Donation
* USDT TRC-20 - `TAR6uqMAMCpTUemy9RP26zrTpJM1rtECxE`
* USDT ERC-20 - `0xA6c9776996f16A0C473Dec464A5608a7BCD3BB81`
* BTC - `16Aavqejcdy2rnyNLLZ1FN4cQEdWXQE3YJ`
