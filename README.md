# nelexa/google-play-scraper

[![Packagist Version](https://img.shields.io/packagist/v/nelexa/google-play-scraper.svg?style=popout&color=aa007f)](https://packagist.org/packages/nelexa/google-play-scraper) ![PHP from Packagist](https://img.shields.io/packagist/php-v/nelexa/google-play-scraper.svg?style=popout&color=d500a0) ![License](https://img.shields.io/packagist/l/nelexa/google-play-scraper.svg?style=popout&color=ff00bf)
[![Build Status](https://secure.travis-ci.org/Ne-Lexa/google-play-scraper.png)](http://travis-ci.org/Ne-Lexa/google-play-scraper) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Ne-Lexa/google-play-scraper/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Ne-Lexa/google-play-scraper/?branch=master) [![Code Coverage](https://scrutinizer-ci.com/g/Ne-Lexa/google-play-scraper/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Ne-Lexa/google-play-scraper/?branch=master) [![Build Status](https://scrutinizer-ci.com/g/Ne-Lexa/google-play-scraper/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Ne-Lexa/google-play-scraper/build-status/master)

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

$gplay = new \Nelexa\GPlay\GPlayApps($defaultLocale = 'en_US', $defaultCountry = 'us');
$appInfo = $gplay->getAppInfo('com.mojang.minecraftpe');
```
Result:
```php
class Nelexa\GPlay\Model\AppInfo {
  -getId(): string: "com.mojang.minecraftpe"
  -getLocale(): string: "en_US"
  -getCountry(): string: "us"
  -getUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe"
  -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe&hl=en_US&gl=us"
  -getName(): string: "Minecraft"
  -getSummary(): ?string: "Millions of crafters have smashed billions of blocks! Now you can join the fun!"
  -getDeveloper(): Nelexa\GPlay\Model\Developer: {
    -getId(): string: "Mojang"
    -getUrl(): string: "https://play.google.com/store/apps/developer?id=Mojang"
    -getName(): string: "Mojang"
    -getDescription(): ?string: null
    -getWebsite(): ?string: "http://help.mojang.com"
    -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
    -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
    -getEmail(): ?string: "android-help@mojang.com"
    -getAddress(): ?string: """
      Mojang\n
      Maria Skolgata 83\n
      118 53\n
      Stockholm\n
      Sweden
      """
    -asArray(): array: …
    -jsonSerialize(): mixed: …
  }
  -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
    -getUrl(): string: "https://lh3.googleusercontent.com/VSwHQjcAttxsLE47RuS4PqpC4LT7lCoSjE7Hx5AW_yCxtDvcnsHHvm5CTuL5BPN-uRTP"
    -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/VSwHQjcAttxsLE47RuS4PqpC4LT7lCoSjE7Hx5AW_yCxtDvcnsHHvm5CTuL5BPN-uRTP=s0"
    -getBinaryImageContent(): string: …
    -__toString(): string: "https://lh3.googleusercontent.com/VSwHQjcAttxsLE47RuS4PqpC4LT7lCoSjE7Hx5AW_yCxtDvcnsHHvm5CTuL5BPN-uRTP"
  }
  -getScore(): float: 4.4578714
  -getPriceText(): ?string: "$6.99"
  -isFree(): bool: false
  -jsonSerialize(): mixed: …
  -getDescription(): string: """
    Explore infinite worlds and build everything from the simplest of homes to the grandest of castles. Play in creative mode with unlimited resources or …
    """
  -isAutoTranslatedDescription(): bool: false
  -getTranslatedFromLocale(): ?string: null
  -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
    -getUrl(): string: "https://lh3.googleusercontent.com/yAtZnNL-9Eb5VYSsCaOC7KAsOVIJcY8mpKa0MoF-0HCL6b0OrFcBizURHywpuip-D6Y"
    -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/yAtZnNL-9Eb5VYSsCaOC7KAsOVIJcY8mpKa0MoF-0HCL6b0OrFcBizURHywpuip-D6Y=s0"
    -getBinaryImageContent(): string: …
    -__toString(): string: "https://lh3.googleusercontent.com/yAtZnNL-9Eb5VYSsCaOC7KAsOVIJcY8mpKa0MoF-0HCL6b0OrFcBizURHywpuip-D6Y"
  }
  -getScreenshots(): array:8 [
    0 => class Nelexa\GPlay\Model\GoogleImage {
      -getUrl(): string: "https://lh3.googleusercontent.com/4r8nWBGPNKid_7q7965C86DSo_BvEkp-CdMxETYJZ-x7eKrKP_SQU5ntCkQxAuhGfjk"
      -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/4r8nWBGPNKid_7q7965C86DSo_BvEkp-CdMxETYJZ-x7eKrKP_SQU5ntCkQxAuhGfjk=s0"
      -getBinaryImageContent(): string: …
      -__toString(): string: "https://lh3.googleusercontent.com/4r8nWBGPNKid_7q7965C86DSo_BvEkp-CdMxETYJZ-x7eKrKP_SQU5ntCkQxAuhGfjk"
    }
    1 => class Nelexa\GPlay\Model\GoogleImage {
      -getUrl(): string: "https://lh3.googleusercontent.com/8O1-J7YFRB1vtq4J73zkRXU-Zf7KWAXHdor_MXHlIq4Xtw49S0fEtDmY0V8pmXSjE8I"
      -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/8O1-J7YFRB1vtq4J73zkRXU-Zf7KWAXHdor_MXHlIq4Xtw49S0fEtDmY0V8pmXSjE8I=s0"
      -getBinaryImageContent(): string: …
      -__toString(): string: "https://lh3.googleusercontent.com/8O1-J7YFRB1vtq4J73zkRXU-Zf7KWAXHdor_MXHlIq4Xtw49S0fEtDmY0V8pmXSjE8I"
    }
    …
  ]
  -getCategory(): Nelexa\GPlay\Model\Category: {
    -getId(): string: "GAME_ARCADE"
    -getName(): string: "Arcade"
    -isGamesCategory(): bool: true
    -isFamilyCategory(): bool: false
    -isApplicationCategory(): bool: false
    -asArray(): array: …
    -jsonSerialize(): mixed: …
  }
  -getCategoryFamily(): ?Nelexa\GPlay\Model\Category: null
  -getVideo(): ?Nelexa\GPlay\Model\Video: {
    -getImageUrl(): string: "https://i.ytimg.com/vi/gcf9FM4TbN4/hqdefault.jpg"
    -getVideoUrl(): string: "https://www.youtube.com/embed/gcf9FM4TbN4?ps=play&vq=large&rel=0&autohide=1&showinfo=0"
    -getYoutubeId(): ?string: "gcf9FM4TbN4"
    -asArray(): array: …
    -jsonSerialize(): mixed: …
  }
  -getRecentChanges(): ?string: "What's new in 1.14.30: Various bug fixes!"
  -isEditorsChoice(): bool: true
  -getInstalls(): int: 27323886
  -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
    -getFiveStars(): int: 2405993
    -getFourStars(): int: 246493
    -getThreeStars(): int: 118772
    -getTwoStars(): int: 65780
    -getOneStar(): int: 247742
    -asArray(): array: …
    -jsonSerialize(): mixed: …
  }
  -getPrice(): float: 6.99
  -getCurrency(): string: "USD"
  -isContainsIAP(): bool: true
  -getOffersIAPCost(): ?string: "$0.99 - $49.99 per item"
  -isContainsAds(): bool: false
  -getSize(): ?string: null
  -getAppVersion(): ?string: "1.14.30.2"
  -getAndroidVersion(): ?string: "4.2 and up"
  -getMinAndroidVersion(): ?string: "4.2"
  -getContentRating(): ?string: "Everyone 10+"
  -getPrivacyPoliceUrl(): ?string: "https://privacy.microsoft.com/en-us/privacystatement"
  -getReleased(): ?DateTimeInterface: @1313366400 {
    date: 2011-08-15T00:00:00+00:00
  }
  -getUpdated(): ?DateTimeInterface: @1581031098 {
    date: 2020-02-06T23:18:18+00:00
  }
  -getNumberVoters(): int: 3084782
  -getNumberReviews(): int: 1595840
  -getReviews(): array:4 [
    0 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOHcJnoVedKr1Hc-4-Ng4IaQsM8bb3qPmctvwtr7nwcG2Fbg4Z_wGzHofWC5ErLv7OvMSefn9ZeburJvAyU"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe&reviewId=gp%3AAOqpTOHcJnoVedKr1Hc-4-Ng4IaQsM8bb3qPmctvwtr7nwcG2Fbg4Z_wGzHofWC5ErL…"
      -getUserName(): string: "Siabh Cadogan"
      -getText(): string: "Good and Creative, although sometimes my controls and hotbar disappears but it still works like it is there. I play on my phone and tablet and I only …"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mAq36EOc8nDf42KSEgzu1bvlrSSOmUIQWs8-yzq=s64"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mAq36EOc8nDf42KSEgzu1bvlrSSOmUIQWs8-yzq=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/a-/AAuE7mAq36EOc8nDf42KSEgzu1bvlrSSOmUIQWs8-yzq=s64"
      }
      -getDate(): ?DateTimeInterface: @1581246488 {
        date: 2020-02-09T11:08:08+00:00
      }
      -getScore(): int: 5
      -getCountLikes(): int: 198
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    1 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOHzwMN1_M4ZmslVaH70K6G1dw3Mvb2Rl8VLl77BEazrl4Nscxg2i-ITUjplViPK_aYp-y64Rq1WbfzIvPE"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe&reviewId=gp%3AAOqpTOHzwMN1_M4ZmslVaH70K6G1dw3Mvb2Rl8VLl77BEazrl4Nscxg2i-ITUjplViP…"
      -getUserName(): string: "Ryan A"
      -getText(): string: "Controls make it awful, what they need to do is make an option for x and y sensitivity individually, so you can slow down your y movement while still …"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/-Ckaxwi6YD3Q/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3reEwD2atJnFAqDSkK-A8Y0fgZkR4w/s64/"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/-Ckaxwi6YD3Q/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3reEwD2atJnFAqDSkK-A8Y0fgZkR4w/s0/"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/-Ckaxwi6YD3Q/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3reEwD2atJnFAqDSkK-A8Y0fgZkR4w/s64/"
      }
      -getDate(): ?DateTimeInterface: @1581402602 {
        date: 2020-02-11T06:30:02+00:00
      }
      -getScore(): int: 2
      -getCountLikes(): int: 76
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
      -asArray(): array: …
      -jsonSerialize(): mixed: …
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
