<h1 align="center"><img src="logo.svg" alt="nelexa/google-play-scraper" width="250" height="250"></h1>

# nelexa/google-play-scraper

[![Packagist Version](https://img.shields.io/packagist/v/nelexa/google-play-scraper.svg?style=popout&color=aa007f)](https://packagist.org/packages/nelexa/google-play-scraper) ![PHP from Packagist](https://img.shields.io/packagist/php-v/nelexa/google-play-scraper.svg?style=popout&color=d500a0) ![License](https://img.shields.io/packagist/l/nelexa/google-play-scraper.svg?style=popout&color=ff00bf)
[![Build Status](https://github.com/Ne-Lexa/google-play-scraper/workflows/build/badge.svg)](https://github.com/Ne-Lexa/google-play-scraper/actions) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Ne-Lexa/google-play-scraper/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Ne-Lexa/google-play-scraper/?branch=master) [![Code Coverage](https://scrutinizer-ci.com/g/Ne-Lexa/google-play-scraper/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Ne-Lexa/google-play-scraper/?branch=master)

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
    -getId(): string: "4772240228547998649"
    -getUrl(): string: "https://play.google.com/store/apps/dev?id=4772240228547998649"
    -getName(): string: "Mojang"
    -getDescription(): ?string: null
    -getWebsite(): ?string: "http://help.mojang.com"
    -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
    -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
    -getEmail(): ?string: "help@minecraft.net"
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
    -getUrl(): string: "https://play-lh.googleusercontent.com/VSwHQjcAttxsLE47RuS4PqpC4LT7lCoSjE7Hx5AW_yCxtDvcnsHHvm5CTuL5BPN-uRTP"
    -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/VSwHQjcAttxsLE47RuS4PqpC4LT7lCoSjE7Hx5AW_yCxtDvcnsHHvm5CTuL5BPN-uRTP=s0"
    -getBinaryImageContent(): string: …
    -__toString(): string: "https://play-lh.googleusercontent.com/VSwHQjcAttxsLE47RuS4PqpC4LT7lCoSjE7Hx5AW_yCxtDvcnsHHvm5CTuL5BPN-uRTP"
  }
  -getScore(): float: 4.526772
  -getPriceText(): ?string: "$7.49"
  -isFree(): bool: false
  -jsonSerialize(): mixed: …
  -getDescription(): string: """
    Explore infinite worlds and build everything from the simplest of homes to the grandest of castles. Play in creative mode with unlimited resources or …
    """
  -isAutoTranslatedDescription(): bool: false
  -getTranslatedFromLocale(): ?string: null
  -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
    -getUrl(): string: "https://play-lh.googleusercontent.com/yAtZnNL-9Eb5VYSsCaOC7KAsOVIJcY8mpKa0MoF-0HCL6b0OrFcBizURHywpuip-D6Y"
    -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/yAtZnNL-9Eb5VYSsCaOC7KAsOVIJcY8mpKa0MoF-0HCL6b0OrFcBizURHywpuip-D6Y=s0"
    -getBinaryImageContent(): string: …
    -__toString(): string: "https://play-lh.googleusercontent.com/yAtZnNL-9Eb5VYSsCaOC7KAsOVIJcY8mpKa0MoF-0HCL6b0OrFcBizURHywpuip-D6Y"
  }
  -getScreenshots(): array: array:8 [
    0 => class Nelexa\GPlay\Model\GoogleImage {
      -getUrl(): string: "https://play-lh.googleusercontent.com/0-zBoTxVn5PJQtNNnovURx1JIbIytd7_H8fXbOVNyReZkKdgU30BkBzD-XmdoP6BtS0"
      -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/0-zBoTxVn5PJQtNNnovURx1JIbIytd7_H8fXbOVNyReZkKdgU30BkBzD-XmdoP6BtS0=s0"
      -getBinaryImageContent(): string: …
      -__toString(): string: "https://play-lh.googleusercontent.com/0-zBoTxVn5PJQtNNnovURx1JIbIytd7_H8fXbOVNyReZkKdgU30BkBzD-XmdoP6BtS0"
    }
    1 => class Nelexa\GPlay\Model\GoogleImage {
      -getUrl(): string: "https://play-lh.googleusercontent.com/Cq6Sju3wrs8IvE7y0w1pGwjO1FNZchjIbXEqpOTtdW5y7s7qkW-aYEPBFILA4RSKuF8"
      -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/Cq6Sju3wrs8IvE7y0w1pGwjO1FNZchjIbXEqpOTtdW5y7s7qkW-aYEPBFILA4RSKuF8=s0"
      -getBinaryImageContent(): string: …
      -__toString(): string: "https://play-lh.googleusercontent.com/Cq6Sju3wrs8IvE7y0w1pGwjO1FNZchjIbXEqpOTtdW5y7s7qkW-aYEPBFILA4RSKuF8"
    }
    …
  ]
  -getCategory(): ?Nelexa\GPlay\Model\Category: {
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
  -getRecentChanges(): ?string: "What's new in 1.16.201: Various bug fixes!"
  -isEditorsChoice(): bool: true
  -getInstalls(): int: 34362566
  -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
    -getFiveStars(): int: 3145912
    -getFourStars(): int: 310909
    -getThreeStars(): int: 140246
    -getTwoStars(): int: 72652
    -getOneStar(): int: 262919
    -asArray(): array: …
    -jsonSerialize(): mixed: …
  }
  -getPrice(): float: 7.49
  -getCurrency(): string: "USD"
  -isContainsIAP(): bool: true
  -getOffersIAPCost(): ?string: "$0.99 - $49.99 per item"
  -isContainsAds(): bool: false
  -getSize(): ?string: null
  -getAppVersion(): ?string: "1.16.201.01"
  -getAndroidVersion(): ?string: null
  -getMinAndroidVersion(): ?string: null
  -getContentRating(): ?string: "Everyone 10+"
  -getPrivacyPoliceUrl(): ?string: "https://privacy.microsoft.com/en-us/privacystatement"
  -getReleased(): ?DateTimeInterface: @1313366400 {
    date: 2011-08-15T00:00:00+00:00
  }
  -getUpdated(): ?DateTimeInterface: @1607647454 {
    date: 2020-12-11T00:44:14+00:00
  }
  -getNumberVoters(): int: 3932639
  -getNumberReviews(): int: 2016325
  -getReviews(): array: array:4 [
    0 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOFxF_0wZvXlsd4S2sMo1-2hHZoYRVdbWipCgqXYQ8Z56fmAavjLomiBbK2V0rrzLL--3zzotG8uaZ_epG4"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe&reviewId=gp%3AAOqpTOFxF_0wZvXlsd4S2sMo1-2hHZoYRVdbWipCgqXYQ8Z56fmAavjLomiBbK2V0rr…"
      -getUserName(): string: "Flower bee family"
      -getText(): string: "I love the game, I've been playing for years, but recently theres been a bug that causes animals to disappear, even if they have a name tag, they just…"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GjhZU5WZifxWBYbe2A8jf9vOwPyn5Sx2WovM4ABdXM=s64"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GjhZU5WZifxWBYbe2A8jf9vOwPyn5Sx2WovM4ABdXM=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GjhZU5WZifxWBYbe2A8jf9vOwPyn5Sx2WovM4ABdXM=s64"
      }
      -getDate(): ?DateTimeInterface: @1613991788 {
        date: 2021-02-22T11:03:08+00:00
      }
      -getScore(): int: 4
      -getCountLikes(): int: 979
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    1 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOFiVjgQDewv35LSvMEsNX1TODZgKw1ZwDcW-jwXVON6ZmqH3R6s7j7h3Rd6dpN2m8RLrU5Jexcp5CZt-n0"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe&reviewId=gp%3AAOqpTOFiVjgQDewv35LSvMEsNX1TODZgKw1ZwDcW-jwXVON6ZmqH3R6s7j7h3Rd6dpN…"
      -getUserName(): string: "Ella Lawrence"
      -getText(): string: "It's honestly a great game. It needs a few updates and it has a bunch of bigs but it's a lot of fun! My reason for rating 4 stars is because of some o…"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GiDnoYjbEjd1uqr3YG7P_M6Sc6FjLR5HsPl6A-oMB8=s64"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GiDnoYjbEjd1uqr3YG7P_M6Sc6FjLR5HsPl6A-oMB8=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GiDnoYjbEjd1uqr3YG7P_M6Sc6FjLR5HsPl6A-oMB8=s64"
      }
      -getDate(): ?DateTimeInterface: @1613964110 {
        date: 2021-02-22T03:21:50+00:00
      }
      -getScore(): int: 4
      -getCountLikes(): int: 1692
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
