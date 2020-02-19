# Documentation

PHP library to scrape application data from the Google Play store.

[![Packagist Version](https://img.shields.io/packagist/v/nelexa/google-play-scraper.svg?style=popout&color=aa007f)](https://packagist.org/packages/nelexa/google-play-scraper) ![PHP from Packagist](https://img.shields.io/packagist/php-v/nelexa/google-play-scraper.svg?style=popout&color=d500a0) 
[![Build Status](https://secure.travis-ci.org/Ne-Lexa/google-play-scraper.png)](http://travis-ci.org/Ne-Lexa/google-play-scraper) [![Code Coverage](https://scrutinizer-ci.com/g/Ne-Lexa/google-play-scraper/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Ne-Lexa/google-play-scraper/?branch=master)

## Installation
```shell
composer require nelexa/google-play-scraper
```

## Usage
Create an instance of `\Nelexa\GPlay\GPlayApps`:

```php
$gplay = new \Nelexa\GPlay\GPlayApps();
```

By default, information is retrieved for the `en_US` locale and for the` US` country.

The locale affects, which language the information will be extracted for.  
The country affects the price and currency of paid applications.

You can set the default locale and country for all requests.
```php
$gplay = new \Nelexa\GPlay\GPlayApps($defaultLocale = 'uk', $defaultCountry = 'ua');
```
or
```php
$gplay
    ->setDefaultLocale('uk')
    ->setDefaultCountry('ua');
```

#### Caching
Since each library method performs one or more HTTP-requests to the Google Play server, it is sometimes useful to cache the results so as not to request the same data twice. 

Use the [PSR-16 Simple Cache](https://packagist.org/providers/psr/simple-cache-implementation) compatible cache provider.

For example, `symfony/cache`:
```shell
composer require symfony/cache
```
```php
$cache = new \Symfony\Component\Cache\Psr16Cache(
    new \Symfony\Component\Cache\Adapter\FilesystemAdapter()
);
$gplay->setCache($cache, \DateInterval::createFromDateString('1 hour'));
```
Sets cache ttl:
```php
$gplay->setCacheTtl(\DateInterval::createFromDateString('1 hour'));
```

#### Limit of parallel HTTP requests
The library allows you to set a limit on the number of parallel HTTP requests to the Google Play server. 

The default is 4.
```php
$gplay->setConcurrency(8);
```

#### Proxy
The library allows you to use a proxy for requests to the Google Play server.
```php
$gplay->setProxy('socks5://127.0.0.1:9050');
$gplay->setProxy('https://89.238.XXX.164:3128');
```

## Available methods:
* [GPlayApps::getAppInfo](#gplayappsgetappinfo-docs): Returns the full detail of an application.
* [GPlayApps::getAppsInfo](#gplayappsgetappsinfo-docs): Returns the full detail of multiple applications.
* [GPlayApps::getAppInfoForLocales](#gplayappsgetappinfoforlocales-docs): Returns the full details of an application in multiple languages.
* [GPlayApps::getAppInfoForAvailableLocales](#gplayappsgetappinfoforavailablelocales-docs): Returns detailed application information for all available locales.
* [GPlayApps::existsApp](#gplayappsexistsapp-docs): Checks if the specified application exists in the Google Play store.
* [GPlayApps::existsApps](#gplayappsexistsapps-docs): Checks if the specified applications exist in the Google Play store.
* [GPlayApps::getReviews](#gplayappsgetreviews-docs): Returns reviews of the Android app in the Google Play store.
* [GPlayApps::getReviewById](#gplayappsgetreviewbyid-docs): Returns review of the Android app in the Google Play store by review id.
* [GPlayApps::getPermissions](#gplayappsgetpermissions-docs): Returns a list of permissions for the application.
* [GPlayApps::getCategories](#gplayappsgetcategories-docs): Returns an array of application categories from the Google Play store.
* [GPlayApps::getCategoriesForLocales](#gplayappsgetcategoriesforlocales-docs): Returns an array of application categories from the Google Play store for the specified locales.
* [GPlayApps::getCategoriesForAvailableLocales](#gplayappsgetcategoriesforavailablelocales-docs): Returns an array of categories from the Google Play store for all available locales.
* [GPlayApps::getDeveloperInfo](#gplayappsgetdeveloperinfo-docs): Returns information about the developer: name, icon, cover, description and website address.
* [GPlayApps::getDeveloperInfoForLocales](#gplayappsgetdeveloperinfoforlocales-docs): Returns information about the developer for the specified locales.
* [GPlayApps::getDeveloperApps](#gplayappsgetdeveloperapps-docs): Returns an array of applications from the Google Play store by developer id.
* [GPlayApps::getSimilarApps](#gplayappsgetsimilarapps-docs): Returns an array of similar applications with basic information about them in the Google Play store.
* [GPlayApps::getSearchSuggestions](#gplayappsgetsearchsuggestions-docs): Returns the Google Play search suggests.
* [GPlayApps::search](#gplayappssearch-docs): Returns a list of applications from the Google Play store for a search query.
* [GPlayApps::getListApps](#gplayappsgetlistapps-docs): Returns an array of applications from the Google Play store for the specified category.
* [GPlayApps::getTopApps](#gplayappsgettopapps-docs): Returns an array of **top apps** from the Google Play store for the specified category.
* [GPlayApps::getNewApps](#gplayappsgetnewapps-docs): Returns an array of **new apps** from the Google Play store for the specified category.
* [GPlayApps::saveGoogleImages](#gplayappssavegoogleimages-docs): Asynchronously saves images from googleusercontent.com and similar URLs to disk.


### GPlayApps::getAppInfo [[docs]](classes/GPlayApps/gplayapps.getappinfo.md)
Returns the full detail of an application.

**Example 1 - Use the default locale and country to request information.**
```php
$appInfo = $gplay->getAppInfo('com.mojang.minecraftpe');
```

**Example 2 - Specify the locale and country to request information.**
```php
$appInfo = $gplay->getAppInfo(
    new \Nelexa\GPlay\Model\AppId(
        'com.mojang.minecraftpe', // id
        'uk', // locale
        'ua' // country
    )
);
```
<details>
  <summary>Results</summary>

```php
class Nelexa\GPlay\Model\AppInfo {
  -getId(): string: "com.mojang.minecraftpe"
  -getLocale(): string: "uk"
  -getCountry(): string: "ua"
  -getUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe"
  -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe&hl=uk&gl=ua"
  -getName(): string: "Minecraft"
  -getSummary(): ?string: "Minecraft – це гра, у якій ви розставляєте блоки та шукаєте пригоди."
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
  -getScore(): float: 4.4607687
  -getPriceText(): ?string: "123,50 грн."
  -isFree(): bool: false
  -jsonSerialize(): mixed: …
  -getDescription(): string: """
    Досліджуйте безкінечні світи та будуйте що завгодно: від простих хижок до розкішних замків. Грайте у творчому режимі з необмеженими ресурсами або вибе…
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
      -getUrl(): string: "https://lh3.googleusercontent.com/Gfor63rEjzuN5gLTd4CjFV5O9T9YF5IVrRrmimqJm2Tct0GSnagoFOHPFpE3Ter7JA"
      -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/Gfor63rEjzuN5gLTd4CjFV5O9T9YF5IVrRrmimqJm2Tct0GSnagoFOHPFpE3Ter7JA=s0"
      -getBinaryImageContent(): string: …
      -__toString(): string: "https://lh3.googleusercontent.com/Gfor63rEjzuN5gLTd4CjFV5O9T9YF5IVrRrmimqJm2Tct0GSnagoFOHPFpE3Ter7JA"
    }
    1 => class Nelexa\GPlay\Model\GoogleImage {
      -getUrl(): string: "https://lh3.googleusercontent.com/Qre0-8iRhd7iu2AV4GqofQFU1QiKCvET752u32VjZHmMvlo_8W5JX07qAKavcpmis7Zk"
      -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/Qre0-8iRhd7iu2AV4GqofQFU1QiKCvET752u32VjZHmMvlo_8W5JX07qAKavcpmis7Zk=s0"
      -getBinaryImageContent(): string: …
      -__toString(): string: "https://lh3.googleusercontent.com/Qre0-8iRhd7iu2AV4GqofQFU1QiKCvET752u32VjZHmMvlo_8W5JX07qAKavcpmis7Zk"
    }
    …
  ]
  -getCategory(): Nelexa\GPlay\Model\Category: {
    -getId(): string: "GAME_ARCADE"
    -getName(): string: "Аркади"
    -isGamesCategory(): bool: true
    -isFamilyCategory(): bool: false
    -isApplicationCategory(): bool: false
    -asArray(): array: …
    -jsonSerialize(): mixed: …
  }
  -getCategoryFamily(): ?Nelexa\GPlay\Model\Category: null
  -getVideo(): ?Nelexa\GPlay\Model\Video: {
    -getImageUrl(): string: "https://i.ytimg.com/vi/5nWMr2njHiA/hqdefault.jpg"
    -getVideoUrl(): string: "https://www.youtube.com/embed/5nWMr2njHiA?ps=play&vq=large&rel=0&autohide=1&showinfo=0"
    -getYoutubeId(): ?string: "5nWMr2njHiA"
    -asArray(): array: …
    -jsonSerialize(): mixed: …
  }
  -getRecentChanges(): ?string: """
    Що нового в 1.14.30:\n
    Різні виправлення помилок
    """
  -isEditorsChoice(): bool: true
  -getInstalls(): int: 27372757
  -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
    -getFiveStars(): int: 2414726
    -getFourStars(): int: 246520
    -getThreeStars(): int: 118458
    -getTwoStars(): int: 65428
    -getOneStar(): int: 246899
    -asArray(): array: …
    -jsonSerialize(): mixed: …
  }
  -getPrice(): float: 123.5
  -getCurrency(): string: "UAH"
  -isContainsIAP(): bool: true
  -getOffersIAPCost(): ?string: "9,36 грн. – 1 349,99 грн. за продукт"
  -isContainsAds(): bool: false
  -getSize(): ?string: null
  -getAppVersion(): ?string: "1.14.30.2"
  -getAndroidVersion(): ?string: "4.2 і новіших версій"
  -getMinAndroidVersion(): ?string: "4.2"
  -getContentRating(): ?string: "Від 7 років"
  -getPrivacyPoliceUrl(): ?string: "https://privacy.microsoft.com/en-us/privacystatement"
  -getReleased(): ?DateTimeInterface: @1313366400 {
    date: 2011-08-15T00:00:00+00:00
  }
  -getUpdated(): ?DateTimeInterface: @1581031098 {
    date: 2020-02-06T23:18:18+00:00
  }
  -getNumberVoters(): int: 3092034
  -getNumberReviews(): int: 1599715
  -getReviews(): array:4 [
    0 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOEk-B-eP-WonMwF1mJJ5ki7W8GFSWJ764ctKyedW8kgZod2Th98ipVnpUGm7Bgew1mJ8rH-3ncav6WVcxE"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe&reviewId=gp%3AAOqpTOEk-B-eP-WonMwF1mJJ5ki7W8GFSWJ764ctKyedW8kgZod2Th98ipVnpUGm7Bg…"
      -getUserName(): string: "IllyaBoy"
      -getText(): string: "Дуже класно! Але я хочу вам допомогти з обновленням. Добавити мавп, акул, ще щоб жителі розмовляли. Також різні вулики з бджолами! Дякую що прочитали."
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mBivXPbfbLUOmfqIBwXodG2aMfqfdhNhoQVro2_mQ=s64"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mBivXPbfbLUOmfqIBwXodG2aMfqfdhNhoQVro2_mQ=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/a-/AAuE7mBivXPbfbLUOmfqIBwXodG2aMfqfdhNhoQVro2_mQ=s64"
      }
      -getDate(): ?DateTimeInterface: @1568365109 {
        date: 2019-09-13T08:58:29+00:00
      }
      -getScore(): int: 5
      -getCountLikes(): int: 10084
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    1 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOHFoqm_MOzJ5wqmPTpcIR_5A7-EYFOXSOaL70oN32z6HhNDpMHIUrqA4nG_p3QhA0tfb6DSW67Mjdd4Qqs"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe&reviewId=gp%3AAOqpTOHFoqm_MOzJ5wqmPTpcIR_5A7-EYFOXSOaL70oN32z6HhNDpMHIUrqA4nG_p3Q…"
      -getUserName(): string: "Вова Сапсан"
      -getText(): string: "Я купив Minecraft с початку була версія 1.14.1 а потім стала версія 1.12.1 іяк це зрозуміти? ПОВЕРНІТЬ ГРОШІ! ЧЕКАЮ 29 ВЕРЕСНЯ О 12:00 2019 РОКУ"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/-EBQ9JSu3bPI/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rcgqq6wcx3NjHMQXsn2pL7yE1PVCA/s64/"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/-EBQ9JSu3bPI/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rcgqq6wcx3NjHMQXsn2pL7yE1PVCA/s0/"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/-EBQ9JSu3bPI/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rcgqq6wcx3NjHMQXsn2pL7yE1PVCA/s64/"
      }
      -getDate(): ?DateTimeInterface: @1569700945 {
        date: 2019-09-28T20:02:25+00:00
      }
      -getScore(): int: 1
      -getCountLikes(): int: 4316
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    …
  ]
  -asArray(): array: …
}
```

</details>



### GPlayApps::getAppsInfo [[docs]](classes/GPlayApps/gplayapps.getappsinfo.md)
Returns the full detail of multiple applications.

```php
$gplay->setConcurrency(10);

$apps = $gplay->getAppsInfo(
    [
        'chrome' => 'com.android.chrome',
        'minecraft' => new \Nelexa\GPlay\Model\AppId('com.mojang.minecraftpe', 'pt_BR', 'br'),
    ]
);
```
<details>
  <summary>Results</summary>

```php
array:2 [
    "chrome" => class Nelexa\GPlay\Model\AppInfo {
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
    "minecraft" => class Nelexa\GPlay\Model\AppInfo {
      -getId(): string: "com.mojang.minecraftpe"
      -getLocale(): string: "pt_BR"
      -getCountry(): string: "br"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe&hl=pt_BR&gl=br"
      -getName(): string: "Minecraft"
      -getSummary(): ?string: "Minecraft é um jogo sobre blocos e aventuras!"
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
      -getScore(): float: 4.4607687
      -getPriceText(): ?string: "R$ 19,99"
      -isFree(): bool: false
      -jsonSerialize(): mixed: …
      -getDescription(): string: """
        Explore mundos infinitos e construa desde simples casas a grandiosos castelos. Jogue no modo criativo com recursos ilimitados ou minere fundo no mundo…
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
          -getUrl(): string: "https://lh3.googleusercontent.com/FCSsEdBLAlFANDRAj8N7Azn_zffiK2Qf6FtlTLXRrfTRT7_Zzz4Ys2239WRXm78ZNQ"
          -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/FCSsEdBLAlFANDRAj8N7Azn_zffiK2Qf6FtlTLXRrfTRT7_Zzz4Ys2239WRXm78ZNQ=s0"
          -getBinaryImageContent(): string: …
          -__toString(): string: "https://lh3.googleusercontent.com/FCSsEdBLAlFANDRAj8N7Azn_zffiK2Qf6FtlTLXRrfTRT7_Zzz4Ys2239WRXm78ZNQ"
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -getUrl(): string: "https://lh3.googleusercontent.com/FLM1WbKTa8zW98zrGUQp0ZHWDGLbZRLjIpsqXrd9oFFTIFFPZOlIYbGtH0C305xxXcc"
          -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/FLM1WbKTa8zW98zrGUQp0ZHWDGLbZRLjIpsqXrd9oFFTIFFPZOlIYbGtH0C305xxXcc=s0"
          -getBinaryImageContent(): string: …
          -__toString(): string: "https://lh3.googleusercontent.com/FLM1WbKTa8zW98zrGUQp0ZHWDGLbZRLjIpsqXrd9oFFTIFFPZOlIYbGtH0C305xxXcc"
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
        -getImageUrl(): string: "https://i.ytimg.com/vi/5nWMr2njHiA/hqdefault.jpg"
        -getVideoUrl(): string: "https://www.youtube.com/embed/5nWMr2njHiA?ps=play&vq=large&rel=0&autohide=1&showinfo=0"
        -getYoutubeId(): ?string: "5nWMr2njHiA"
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getRecentChanges(): ?string: """
        Novidades na versão 1.14.30:\n
        Correção de diversos erros
        """
      -isEditorsChoice(): bool: true
      -getInstalls(): int: 27372757
      -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
        -getFiveStars(): int: 2414732
        -getFourStars(): int: 246521
        -getThreeStars(): int: 118459
        -getTwoStars(): int: 65428
        -getOneStar(): int: 246900
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getPrice(): float: 19.99
      -getCurrency(): string: "BRL"
      -isContainsIAP(): bool: true
      -getOffersIAPCost(): ?string: "R$ 1,33 – R$ 179,99 por item"
      -isContainsAds(): bool: false
      -getSize(): ?string: null
      -getAppVersion(): ?string: "1.14.30.2"
      -getAndroidVersion(): ?string: "4.2 ou superior"
      -getMinAndroidVersion(): ?string: "4.2"
      -getContentRating(): ?string: "Classificação Livre"
      -getPrivacyPoliceUrl(): ?string: "https://privacy.microsoft.com/en-us/privacystatement"
      -getReleased(): ?DateTimeInterface: @1313366400 {
        date: 2011-08-15T00:00:00+00:00
      }
      -getUpdated(): ?DateTimeInterface: @1581031098 {
        date: 2020-02-06T23:18:18+00:00
      }
      -getNumberVoters(): int: 3092042
      -getNumberReviews(): int: 1599717
      -getReviews(): array:4 [
        0 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOF9xom9V10RMHeOT7ZOg-0lZggY1fvhp7rXdiCJROaDn93a3sH1Uo6ECUCH907-Z0Sy81qsEF8wrxGrA-s"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe&reviewId=gp%3AAOqpTOF9xom9V10RMHeOT7ZOg-0lZggY1fvhp7rXdiCJROaDn93a3sH1Uo6ECUCH907…"
          -getUserName(): string: "Um usuário do Google"
          -getText(): string: "Toda vez que eu abro o jogo após a nova atualização o jogo não abre, apenas da tela preta, e fecha, dei uma olhada em outras resenhas e vi outras pess…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -getUrl(): string: "https://lh3.googleusercontent.com/EGemoI2NTXmTsBVtJqk8jxF9rh8ApRWfsIMQSt2uE4OcpQqbFu7f7NbTK05lx80nuSijCz7sc3a277R67g=s64"
            -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/EGemoI2NTXmTsBVtJqk8jxF9rh8ApRWfsIMQSt2uE4OcpQqbFu7f7NbTK05lx80nuSijCz7sc3a277R67g=s0"
            -getBinaryImageContent(): string: …
            -__toString(): string: "https://lh3.googleusercontent.com/EGemoI2NTXmTsBVtJqk8jxF9rh8ApRWfsIMQSt2uE4OcpQqbFu7f7NbTK05lx80nuSijCz7sc3a277R67g=s64"
          }
          -getDate(): ?DateTimeInterface: @1580406646 {
            date: 2020-01-30T17:50:46+00:00
          }
          -getScore(): int: 4
          -getCountLikes(): int: 1000
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -asArray(): array: …
          -jsonSerialize(): mixed: …
        }
        1 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOE9rwGIAQ6BEXIsbLzZEWSiEuWog_l5UnOFfDAvzsv2drkIGtMuZvGhjgqOABrBtRtGXHzr0Jq5_k2GI1s"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe&reviewId=gp%3AAOqpTOE9rwGIAQ6BEXIsbLzZEWSiEuWog_l5UnOFfDAvzsv2drkIGtMuZvGhjgqOABr…"
          -getUserName(): string: "Iralo `"
          -getText(): string: "O jogo é excelente, super criativo e divertido. Não consigo entrar em um dos servidores ( Mineville City ) desde que comprei o jogo. Tudo o que aconte…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -getUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mApSsq3soGQoKLTguLGtUT6Ts1m4Bt1LgDK_YDMvg=s64"
            -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mApSsq3soGQoKLTguLGtUT6Ts1m4Bt1LgDK_YDMvg=s0"
            -getBinaryImageContent(): string: …
            -__toString(): string: "https://lh3.googleusercontent.com/a-/AAuE7mApSsq3soGQoKLTguLGtUT6Ts1m4Bt1LgDK_YDMvg=s64"
          }
          -getDate(): ?DateTimeInterface: @1581090202 {
            date: 2020-02-07T15:43:22+00:00
          }
          -getScore(): int: 4
          -getCountLikes(): int: 440
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -asArray(): array: …
          -jsonSerialize(): mixed: …
        }
        …
      ]
      -asArray(): array: …
    }
  ]
```

</details>



### GPlayApps::getAppInfoForLocales [[docs]](classes/GPlayApps/gplayapps.getappinfoforlocales.md)
Returns the full details of an application in multiple languages.

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



### GPlayApps::getAppInfoForAvailableLocales [[docs]](classes/GPlayApps/gplayapps.getappinfoforavailablelocales.md)
Returns detailed application information for all available locales.

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



### GPlayApps::existsApp [[docs]](classes/GPlayApps/gplayapps.existsapp.md)
Checks if the specified application exists in the Google Play store.

**Example 1 - App exists.**
```php
$appId = 'com.mojang.minecraftpe';
// or
$appId = new \Nelexa\GPlay\Model\AppId('com.mojang.minecraftpe', 'en', 'in');

$exists = $gplay->existsApp($appId);
```
<details>
  <summary>Results</summary>

```php
true
```

</details>

**Example 2 - App doesn't exists.**
```php
$appId = 'com.test.app';
// or
$appId = new \Nelexa\GPlay\Model\AppId('com.test.app', 'fr', 'fr');

$exists = $gplay->existsApp($appId);
```
<details>
  <summary>Results</summary>

```php
false
```

</details>



### GPlayApps::existsApps [[docs]](classes/GPlayApps/gplayapps.existsapps.md)
Checks if the specified applications exist in the Google Play store.

```php
$gplay->setConcurrency(8);

$exists = $gplay->existsApps(
    [
        'maps' => 'com.google.android.apps.maps',
        'docs' => new \Nelexa\GPlay\Model\AppId('com.google.android.apps.docs'),
        /* 0 => */ 'com.google.android.apps.googleassistant',
        /* 1 => */ 'com.google.android.keep',
        'invalid' => 'com.android.test',
        'com.google.android.apps.authenticator2' => 'com.google.android.apps.authenticator2',
    ]
);
```
<details>
  <summary>Results</summary>

```php
array:6 [
    "maps" => true
    "docs" => true
    0 => true
    1 => true
    "invalid" => false
    "com.google.android.apps.authenticator2" => true
  ]
```

</details>



### GPlayApps::getReviews [[docs]](classes/GPlayApps/gplayapps.getreviews.md)
Returns reviews of the Android app in the Google Play store.

**Example 1**
```php
$appId = 'ru.yandex.metro';
// or
$appId = new \Nelexa\GPlay\Model\AppId('ru.yandex.metro', 'ru');

$reviews = $gplay->getReviews(
    $appId,
    $limit = 1000,
    $sort = \Nelexa\GPlay\Enum\SortEnum::HELPFULNESS()
);
```
<details>
  <summary>Results</summary>

```php
array:1000 [
    0 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOGMp3ybCbJiOqLVaUuFuC9OJnYcVQ17YcqBw1o78rC3Rc7eD0WGwuqgqrHDbTtO6J2hgzcWR7FtK97oyzw"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=ru.yandex.metro&reviewId=gp%3AAOqpTOGMp3ybCbJiOqLVaUuFuC9OJnYcVQ17YcqBw1o78rC3Rc7eD0WGwuqgqrHDbTtO6J2hgz…"
      -getUserName(): string: "Ury Kamensky"
      -getText(): string: "Добавьте возможность закрывать (или уберите насовсем, но на это особо не надеюсь) иконку/кнопку/ссылку с предложением заказать такси, она ОЧЕНЬ РАЗДРА…"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/-LI9m4wX6nxk/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3repzhI13u0GMMXfvbTHqnLtnerPYg/s64/"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/-LI9m4wX6nxk/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3repzhI13u0GMMXfvbTHqnLtnerPYg/s0/"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/-LI9m4wX6nxk/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3repzhI13u0GMMXfvbTHqnLtnerPYg/s64/"
      }
      -getDate(): ?DateTimeInterface: @1581494510 {
        date: 2020-02-12T08:01:50+00:00
      }
      -getScore(): int: 2
      -getCountLikes(): int: 12
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: {
        -getDate(): DateTimeInterface: @1581510687 {
          date: 2020-02-12T12:31:27+00:00
        }
        -getText(): string: "Спасибо за отзыв и замечание к отображению этой кнопки, мы обязательно рассмотрим его подробнее!"
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    1 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOGXiWwiyPHHUCXsx5JPJtDtKIa7CCXTUK8xhAJ9eyNv_jkm4coeSOqKHn3Eu5s52AMTOvPLPL0RbAJV25Y"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=ru.yandex.metro&reviewId=gp%3AAOqpTOGXiWwiyPHHUCXsx5JPJtDtKIa7CCXTUK8xhAJ9eyNv_jkm4coeSOqKHn3Eu5s52AMTOv…"
      -getUserName(): string: "Рии Эн"
      -getText(): string: "Диаметры то появляются, то исчезают. Время отличается от рассчитанного на сайте. Предлагает ехать через закрытую каховскую ветку. Единственное, что ра…"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/-Zos3KoSJTjU/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rfZKhn84y4kq0BVajR1VBK8JSNuFQ/s64/"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/-Zos3KoSJTjU/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rfZKhn84y4kq0BVajR1VBK8JSNuFQ/s0/"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/-Zos3KoSJTjU/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rfZKhn84y4kq0BVajR1VBK8JSNuFQ/s64/"
      }
      -getDate(): ?DateTimeInterface: @1581341597 {
        date: 2020-02-10T13:33:17+00:00
      }
      -getScore(): int: 3
      -getCountLikes(): int: 0
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: {
        -getDate(): DateTimeInterface: @1581359256 {
          date: 2020-02-10T18:27:36+00:00
        }
        -getText(): string: "Пожалуйста, напишите нам на app-metro@support.yandex.ru или через меню «Настройки» — «Обратная связь», покажите на скриншотах ситуации, которые вызыва…"
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    …
  ]
```

</details>



### GPlayApps::getReviewById [[docs]](classes/GPlayApps/gplayapps.getreviewbyid.md)
Returns review of the Android app in the Google Play store by review id.

**Example 1**
```php
$appId = 'com.viber.voip';
// or
$appId = new \Nelexa\GPlay\Model\AppId('com.viber.voip');

$review = $gplay->getReviewById(
    $appId,
    $reviewId = 'gp:AOqpTOGkxfRp2B9_nud4zNgpwZ3L5ZHhjm2Bl7hNSeX2LkYTLL7rhkrNmnPPvtecH8Sg5mpWlU2_569ktUzNRjY'
);
```
<details>
  <summary>Results</summary>

```php
class Nelexa\GPlay\Model\Review {
  -getId(): string: "gp:AOqpTOGkxfRp2B9_nud4zNgpwZ3L5ZHhjm2Bl7hNSeX2LkYTLL7rhkrNmnPPvtecH8Sg5mpWlU2_569ktUzNRjY"
  -getUrl(): string: "https://play.google.com/store/apps/details?id=com.viber.voip&reviewId=gp%3AAOqpTOGkxfRp2B9_nud4zNgpwZ3L5ZHhjm2Bl7hNSeX2LkYTLL7rhkrNmnPPvtecH8Sg5mpWlU2…"
  -getUserName(): string: "rih"
  -getText(): string: "images are not saved on gallery even though it is in automatic download mode. fix this problem fast."
  -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
    -getUrl(): string: "https://lh3.googleusercontent.com/-7fis3zoKasI/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rcxiuziW9IC_qbC3i_TPbxOkpmx5A/s64/"
    -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/-7fis3zoKasI/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rcxiuziW9IC_qbC3i_TPbxOkpmx5A/s0/"
    -getBinaryImageContent(): string: …
    -__toString(): string: "https://lh3.googleusercontent.com/-7fis3zoKasI/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rcxiuziW9IC_qbC3i_TPbxOkpmx5A/s64/"
  }
  -getDate(): ?DateTimeInterface: @1581236842 {
    date: 2020-02-09T08:27:22+00:00
  }
  -getScore(): int: 1
  -getCountLikes(): int: 2
  -getReply(): ?Nelexa\GPlay\Model\ReplyReview: {
    -getDate(): DateTimeInterface: @1581348449 {
      date: 2020-02-10T15:27:29+00:00
    }
    -getText(): string: """
      Hello, \n
      Thank you for letting us know, please also provide our support team this information allowing us to investigate it and assist you as soon as p…
      """
    -asArray(): array: …
    -jsonSerialize(): mixed: …
  }
  -asArray(): array: …
  -jsonSerialize(): mixed: …
}
```

</details>



### GPlayApps::getPermissions [[docs]](classes/GPlayApps/gplayapps.getpermissions.md)
Returns a list of permissions for the application.

```php
$appInfo = 'com.google.android.webview';
// either
$appInfo = new \Nelexa\GPlay\Model\AppId('com.google.android.webview', 'en');
// or
$appInfo = $gplay->getAppInfo('com.google.android.webview');

$permissions = $gplay->getPermissions($appInfo);
```
<details>
  <summary>Results</summary>

```php
array:1 [
    "Other" => class Nelexa\GPlay\Model\Permission {
      -getLabel(): string: "Other"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/pkKXoPl5q7n8T0s7KREtdvUZn1PLRgx-Ox0t4tkO8af4JpgGbyAxLBTsvEKKBCjwBACQsZisSYNmHPGbBA"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/pkKXoPl5q7n8T0s7KREtdvUZn1PLRgx-Ox0t4tkO8af4JpgGbyAxLBTsvEKKBCjwBACQsZisSYNmHPGbBA=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/pkKXoPl5q7n8T0s7KREtdvUZn1PLRgx-Ox0t4tkO8af4JpgGbyAxLBTsvEKKBCjwBACQsZisSYNmHPGbBA"
      }
      -getPermissions(): array:2 [
        0 => "view network connections"
        1 => "full network access"
      ]
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
  ]
```

</details>



### GPlayApps::getCategories [[docs]](classes/GPlayApps/gplayapps.getcategories.md)
Returns an array of application categories from the Google Play store.

```php
$categories = $gplay
//    ->setDefaultLocale('fr') // can set locale
    ->getCategories()
;
```
<details>
  <summary>Results</summary>

```php
array:58 [
    0 => class Nelexa\GPlay\Model\Category {
      -getId(): string: "ART_AND_DESIGN"
      -getName(): string: "Art & Design"
      -isGamesCategory(): bool: false
      -isFamilyCategory(): bool: false
      -isApplicationCategory(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    1 => class Nelexa\GPlay\Model\Category {
      -getId(): string: "AUTO_AND_VEHICLES"
      -getName(): string: "Auto & Vehicles"
      -isGamesCategory(): bool: false
      -isFamilyCategory(): bool: false
      -isApplicationCategory(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    …
  ]
```

</details>



### GPlayApps::getCategoriesForLocales [[docs]](classes/GPlayApps/gplayapps.getcategoriesforlocales.md)
Returns an array of application categories from the Google Play store for the specified locales.

```php
$gplay->setConcurrency(4);
$categories = $gplay->getCategoriesForLocales(['en', 'pt_PT', 'pt_BR', 'fr']);
```
<details>
  <summary>Results</summary>

```php
array:4 [
    "en_US" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art & Design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto & Vehicles"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "pt_PT" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "FOOD_AND_DRINK"
        -getName(): string: "Alimentação e bebida"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Arte e design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "pt_BR" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Arte e design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BEAUTY"
        -getName(): string: "Beleza"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "fr_FR" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "NEWS_AND_MAGAZINES"
        -getName(): string: "Actualités et magazines"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art et design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
  ]
```

</details>



### GPlayApps::getCategoriesForAvailableLocales [[docs]](classes/GPlayApps/gplayapps.getcategoriesforavailablelocales.md)
Returns an array of categories from the Google Play store for all available locales.

```php
$gplay->setConcurrency(10);
$categories = $gplay->getCategoriesForAvailableLocales();
```
<details>
  <summary>Results</summary>

```php
array:78 [
    "af" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BUSINESS"
        -getName(): string: "Besigheid"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "LIBRARIES_AND_DEMO"
        -getName(): string: "Biblioteke en demonstrasies"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "am" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "MEDICAL"
        -getName(): string: "ሕክምና"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "ar" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "VIDEO_PLAYERS"
        -getName(): string: "أدوات الفيديو"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "az_AZ" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "Alətlər"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Avto və Nəqliyyat Vasitələri"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "be" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "Інструменты"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "bg" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "LIBRARIES_AND_DEMO"
        -getName(): string: "Библиотеки и демонстрации"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "bn_BD" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "WEATHER"
        -getName(): string: "আবহাওয়া"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "ca" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art i disseny"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Automoció"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "cs_CZ" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auta a doprava"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BUSINESS"
        -getName(): string: "Byznys"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "da_DK" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "EVENTS"
        -getName(): string: "Begivenheder"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "LIBRARIES_AND_DEMO"
        -getName(): string: "Biblioteker og demoer"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "de_DE" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Autos & Fahrzeuge"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BEAUTY"
        -getName(): string: "Beauty"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "el_GR" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "SHOPPING"
        -getName(): string: "Αγορές"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "en_AU" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art & Design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto & Vehicles"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "en_CA" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art & Design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto & Vehicles"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "en_GB" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art & Design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto & Vehicles"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "en_IN" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art & Design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto & Vehicles"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "en_SG" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art & Design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto & Vehicles"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "en_US" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art & Design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto & Vehicles"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "en_ZA" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art & Design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto & Vehicles"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "es_419" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Arte y diseño"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Autos y vehículos"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "es_ES" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Arte y diseño"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Automoción"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "es_US" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Arte y diseño"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Autos y vehículos"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "et" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Autod ja sõidukid"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "LIFESTYLE"
        -getName(): string: "Elustiil"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "eu_ES" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ENTERTAINMENT"
        -getName(): string: "Aisia"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "NEWS_AND_MAGAZINES"
        -getName(): string: "Albisteak eta aldizkariak"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "fa" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "WEATHER"
        -getName(): string: "آب و هوا"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "fi_FI" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Autot ja ajoneuvot"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "LIBRARIES_AND_DEMO"
        -getName(): string: "Demot"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "fil" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ENTERTAINMENT"
        -getName(): string: "Aliwan"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "HOUSE_AND_HOME"
        -getName(): string: "Bahay at Tahanan"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "fr_CA" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "NEWS_AND_MAGAZINES"
        -getName(): string: "Actualités et magazines"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "FOOD_AND_DRINK"
        -getName(): string: "Alimentation et boissons"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "fr_FR" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "NEWS_AND_MAGAZINES"
        -getName(): string: "Actualités et magazines"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art et design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "gl_ES" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Arte e deseño"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Automóbiles e vehículos"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "hi_IN" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "MAPS_AND_NAVIGATION"
        -getName(): string: "Maps और नेविगेशन ऐप्स"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "hr" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "Alati"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Automobili i prijevoz"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "hu_HU" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Autók és járművek"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "HEALTH_AND_FITNESS"
        -getName(): string: "Egészség és fitnesz"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "hy_AM" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "HOUSE_AND_HOME"
        -getName(): string: "Ամեն ինչ տան համար"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "id" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "Alat "
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "SHOPPING"
        -getName(): string: "Belanja"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "is_IS" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ENTERTAINMENT"
        -getName(): string: "Afþreying"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PRODUCTIVITY"
        -getName(): string: "Aðstoð"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "it_IT" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BUSINESS"
        -getName(): string: "Affari"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Arte e design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "iw_IL" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "FOOD_AND_DRINK"
        -getName(): string: "אוכל ומשקאות"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "ja_JP" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "アート＆デザイン"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "ka_GE" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "ავტომობილები და სატრანსპორტო საშუალებები"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "kk" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Авто және көліктер"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "km_KH" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "VIDEO_PLAYERS"
        -getName(): string: "កម្មវិធីចាក់ និងកែវីដេអូ"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "kn_IN" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "MAPS_AND_NAVIGATION"
        -getName(): string: "Maps ಮತ್ತು ನ್ಯಾವಿಗೇಶನ್"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "ko_KR" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "HEALTH_AND_FITNESS"
        -getName(): string: "건강/운동"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "ky_KG" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "WEATHER"
        -getName(): string: "Аба ырайы"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "lo_LA" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "SHOPPING"
        -getName(): string: "ການຊື້ເຄື່ອງ"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "lt" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "SHOPPING"
        -getName(): string: "Apsipirkimas"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Automobiliai ir transporto priemonės"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "lv" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "LIBRARIES_AND_DEMO"
        -getName(): string: "Bibliotēkas un demoversijas"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "mk_MK" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Автомобили и возила"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "ml_IN" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "HEALTH_AND_FITNESS"
        -getName(): string: "ആരോഗ്യവും ശാരീരികക്ഷമതയും"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "mn_MN" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Авто, тээврийн хэрэгсэл"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "mr_IN" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "FINANCE"
        -getName(): string: "Finance"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "ms" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "EVENTS"
        -getName(): string: "Acara"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "Alatan"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "my_MM" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "COMICS"
        -getName(): string: "ကာတွန်း"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "ne_NP" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "अटो र सवारीसाधनहरू"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "nl_NL" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto's en voertuigen"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BEAUTY"
        -getName(): string: "Beauty"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "no_NO" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "EVENTS"
        -getName(): string: "Arrangementer"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PARENTING"
        -getName(): string: "Barn og foreldre"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "pl_PL" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "LIBRARIES_AND_DEMO"
        -getName(): string: "Biblioteki i wersje demo"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BUSINESS"
        -getName(): string: "Dla firm"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "pt_BR" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Arte e design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BEAUTY"
        -getName(): string: "Beleza"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "pt_PT" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "FOOD_AND_DRINK"
        -getName(): string: "Alimentação e bebida"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Arte e design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "ro" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BUSINESS"
        -getName(): string: "Afacere"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Artă și design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "ru_RU" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Автомобили и транспорт"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "si_LK" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "EDUCATION"
        -getName(): string: "අධ්‍යාපනය"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "sk" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Autá a doprava"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BUSINESS"
        -getName(): string: "Biznis"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "sl" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Avtomobili in vozila"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "EVENTS"
        -getName(): string: "Dogodki"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "sr" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "Алатке"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "sv_SE" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PERSONALIZATION"
        -getName(): string: "Anpassning"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "LIBRARIES_AND_DEMO"
        -getName(): string: "Bibliotek och demo"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "sw" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "HEALTH_AND_FITNESS"
        -getName(): string: "Afya na Siha"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PERSONALIZATION"
        -getName(): string: "Badilisha upendavyo"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "ta_IN" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BEAUTY"
        -getName(): string: "அழகு"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "te_IN" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "MAPS_AND_NAVIGATION"
        -getName(): string: "Maps & నావిగేషన్"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "th" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PERSONALIZATION"
        -getName(): string: "การกำหนดค่าส่วนบุคคล"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "tr_TR" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "SHOPPING"
        -getName(): string: "Alışveriş"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "Araçlar"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "uk" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "Інструменти"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "vi" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "MAPS_AND_NAVIGATION"
        -getName(): string: "Bản đồ và dẫn đường"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PERSONALIZATION"
        -getName(): string: "Cá nhân hóa"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "zh_CN" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PERSONALIZATION"
        -getName(): string: "个性化"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "zh_HK" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PERSONALIZATION"
        -getName(): string: "個人化"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "zh_TW" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Wear OS by Google"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PERSONALIZATION"
        -getName(): string: "個人化"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
    "zu" => array:58 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BOOKS_AND_REFERENCE"
        -getName(): string: "Amabhuku & Amaphatho"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "COMICS"
        -getName(): string: "Amahlaya"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      …
    ]
  ]
```

</details>



### GPlayApps::getDeveloperInfo [[docs]](classes/GPlayApps/gplayapps.getdeveloperinfo.md)
Returns information about the developer: name, icon, cover, description and website address.

```php
$devId = '5700313618786177705';
// either
$devId = $gplay->getAppInfo('com.android.chrome');
// or
$devId = $gplay->getAppInfo('com.android.chrome')->getDeveloper();

$developerInfo = $gplay->getDeveloperInfo($devId);
```
<details>
  <summary>Results</summary>

```php
class Nelexa\GPlay\Model\Developer {
  -getId(): string: "5700313618786177705"
  -getUrl(): string: "https://play.google.com/store/apps/dev?id=5700313618786177705"
  -getName(): string: "Google LLC"
  -getDescription(): ?string: "Apps from Google to help you get the most out of your day, across all your devices."
  -getWebsite(): ?string: null
  -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: {
    -getUrl(): string: "https://lh3.googleusercontent.com/6UgEjh8Xuts4nwdWzTnWH8QtLuHqRMUB7dp24JYVE2xcYzq4HA8hFfcAbU-R-PC_9uA1"
    -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/6UgEjh8Xuts4nwdWzTnWH8QtLuHqRMUB7dp24JYVE2xcYzq4HA8hFfcAbU-R-PC_9uA1=s0"
    -getBinaryImageContent(): string: …
    -__toString(): string: "https://lh3.googleusercontent.com/6UgEjh8Xuts4nwdWzTnWH8QtLuHqRMUB7dp24JYVE2xcYzq4HA8hFfcAbU-R-PC_9uA1"
  }
  -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
    -getUrl(): string: "https://lh3.googleusercontent.com/1-hPxafOxdYpYZEOKzNIkSP43HXCNftVJVttoo4ucl7rsMASXW3Xr6GlXURCubE1tA"
    -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/1-hPxafOxdYpYZEOKzNIkSP43HXCNftVJVttoo4ucl7rsMASXW3Xr6GlXURCubE1tA=s0"
    -getBinaryImageContent(): string: …
    -__toString(): string: "https://lh3.googleusercontent.com/1-hPxafOxdYpYZEOKzNIkSP43HXCNftVJVttoo4ucl7rsMASXW3Xr6GlXURCubE1tA"
  }
  -getEmail(): ?string: null
  -getAddress(): ?string: null
  -asArray(): array: …
  -jsonSerialize(): mixed: …
}
```

</details>



### GPlayApps::getDeveloperInfoForLocales [[docs]](classes/GPlayApps/gplayapps.getdeveloperinfoforlocales.md)
Returns information about the developer for the specified locales.

```php
$gplay->setConcurrency(4); // limit parallel HTTP requests

$devId = '5700313618786177705';
// either
$devId = $gplay->getAppInfo('com.android.chrome');
// or
$devId = $gplay->getAppInfo('com.android.chrome')->getDeveloper();

$developerInfoList = $gplay->getDeveloperInfoForLocales($devId, ['en', 'es', 'ru', 'fr']);
```
<details>
  <summary>Results</summary>

```php
array:4 [
    "en_US" => class Nelexa\GPlay\Model\Developer {
      -getId(): string: "5700313618786177705"
      -getUrl(): string: "https://play.google.com/store/apps/dev?id=5700313618786177705"
      -getName(): string: "Google LLC"
      -getDescription(): ?string: "Apps from Google to help you get the most out of your day, across all your devices."
      -getWebsite(): ?string: null
      -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/6UgEjh8Xuts4nwdWzTnWH8QtLuHqRMUB7dp24JYVE2xcYzq4HA8hFfcAbU-R-PC_9uA1"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/6UgEjh8Xuts4nwdWzTnWH8QtLuHqRMUB7dp24JYVE2xcYzq4HA8hFfcAbU-R-PC_9uA1=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/6UgEjh8Xuts4nwdWzTnWH8QtLuHqRMUB7dp24JYVE2xcYzq4HA8hFfcAbU-R-PC_9uA1"
      }
      -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/1-hPxafOxdYpYZEOKzNIkSP43HXCNftVJVttoo4ucl7rsMASXW3Xr6GlXURCubE1tA"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/1-hPxafOxdYpYZEOKzNIkSP43HXCNftVJVttoo4ucl7rsMASXW3Xr6GlXURCubE1tA=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/1-hPxafOxdYpYZEOKzNIkSP43HXCNftVJVttoo4ucl7rsMASXW3Xr6GlXURCubE1tA"
      }
      -getEmail(): ?string: null
      -getAddress(): ?string: null
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    "es_ES" => class Nelexa\GPlay\Model\Developer {
      -getId(): string: "5700313618786177705"
      -getUrl(): string: "https://play.google.com/store/apps/dev?id=5700313618786177705"
      -getName(): string: "Google LLC"
      -getDescription(): ?string: "Apps from Google to help you get the most out of your day, across all your devices."
      -getWebsite(): ?string: null
      -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/6UgEjh8Xuts4nwdWzTnWH8QtLuHqRMUB7dp24JYVE2xcYzq4HA8hFfcAbU-R-PC_9uA1"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/6UgEjh8Xuts4nwdWzTnWH8QtLuHqRMUB7dp24JYVE2xcYzq4HA8hFfcAbU-R-PC_9uA1=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/6UgEjh8Xuts4nwdWzTnWH8QtLuHqRMUB7dp24JYVE2xcYzq4HA8hFfcAbU-R-PC_9uA1"
      }
      -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/1-hPxafOxdYpYZEOKzNIkSP43HXCNftVJVttoo4ucl7rsMASXW3Xr6GlXURCubE1tA"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/1-hPxafOxdYpYZEOKzNIkSP43HXCNftVJVttoo4ucl7rsMASXW3Xr6GlXURCubE1tA=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/1-hPxafOxdYpYZEOKzNIkSP43HXCNftVJVttoo4ucl7rsMASXW3Xr6GlXURCubE1tA"
      }
      -getEmail(): ?string: null
      -getAddress(): ?string: null
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    …
  ]
```

</details>



### GPlayApps::getDeveloperApps [[docs]](classes/GPlayApps/gplayapps.getdeveloperapps.md)
Returns an array of applications from the Google Play store by developer id.

```php
$devId = '5700313618786177705';
// or
$devId = 'Google';
// or
$devId = $gplay->getAppInfo('com.android.chrome');
// or
$devId = $gplay->getAppInfo('com.android.chrome')->getDeveloper();

$apps = $gplay->getDeveloperApps($devId);
```
<details>
  <summary>Results</summary>

```php
array:129 [
    0 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.google.android.play.games"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.play.games"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.play.games&hl=en_US&gl=us"
      -getName(): string: "Google Play Games"
      -getSummary(): ?string: "Play games instantly, save progress, and earn achievements."
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "5700313618786177705"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=5700313618786177705"
        -getName(): string: "Google LLC"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/szHQCpMAb0MikYIhvNG1MlruXFUggd6DJHXkMPG1H4lJPB7Lee_BkODfwxpQazxfO9mA"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/szHQCpMAb0MikYIhvNG1MlruXFUggd6DJHXkMPG1H4lJPB7Lee_BkODfwxpQazxfO9mA=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/szHQCpMAb0MikYIhvNG1MlruXFUggd6DJHXkMPG1H4lJPB7Lee_BkODfwxpQazxfO9mA"
      }
      -getScore(): float: 4.354707
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    1 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.google.android.apps.youtube.music"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.youtube.music"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.youtube.music&hl=en_US&gl=us"
      -getName(): string: "YouTube Music - Stream Songs & Music Videos"
      -getSummary(): ?string: "The official YouTube app built just for music."
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "5700313618786177705"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=5700313618786177705"
        -getName(): string: "Google LLC"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/GnYnNfKBr2nysHBYgYRCQtcv_RRNN0Sosn47F5ArKJu89DMR3_jHRAazoIVsPUoaMg"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/GnYnNfKBr2nysHBYgYRCQtcv_RRNN0Sosn47F5ArKJu89DMR3_jHRAazoIVsPUoaMg=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/GnYnNfKBr2nysHBYgYRCQtcv_RRNN0Sosn47F5ArKJu89DMR3_jHRAazoIVsPUoaMg"
      }
      -getScore(): float: 4.123365
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    …
  ]
```

</details>



### GPlayApps::getSimilarApps [[docs]](classes/GPlayApps/gplayapps.getsimilarapps.md)
Returns an array of similar applications with basic information about them in the Google Play store.

```php
$app = 'com.sololearn';
// either
$app = new \Nelexa\GPlay\Model\AppId('com.sololearn', 'ru');
// or
$app = $gplay->setDefaultLocale('ru')->getAppInfo('com.sololearn');

$similarApps = $gplay->getSimilarApps($app, $limit = \Nelexa\GPlay\GPlayApps::UNLIMIT);
```
<details>
  <summary>Results</summary>

```php
array:161 [
    0 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.freeit.java"
      -getLocale(): string: "ru_RU"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.freeit.java"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.freeit.java&hl=ru_RU&gl=us"
      -getName(): string: "Центр программирования: научиться кодировать"
      -getSummary(): ?string: "Изучайте HTML,Python,Javascript,C,C ++,C #, Java и другие языки программирования"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "8802462833480602617"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=8802462833480602617"
        -getName(): string: "Coding and Programming"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/fy2SPeYLij4AC8WFaGSq0uxol14F22F3BGUU_Dq-UY9WjUiDc6Tz2FDCuxsgyQ4HPQ"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/fy2SPeYLij4AC8WFaGSq0uxol14F22F3BGUU_Dq-UY9WjUiDc6Tz2FDCuxsgyQ4HPQ=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/fy2SPeYLij4AC8WFaGSq0uxol14F22F3BGUU_Dq-UY9WjUiDc6Tz2FDCuxsgyQ4HPQ"
      }
      -getScore(): float: 4.5951314
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    1 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.getmimo"
      -getLocale(): string: "ru_RU"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.getmimo"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.getmimo&hl=ru_RU&gl=us"
      -getName(): string: "Мимо: Научитесь программировать"
      -getSummary(): ?string: "Освой Python, JavaScript, Java, HTML, CSS, Swift, Kotlin, C++, SQL, PHP и C#!"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "5836148544871025856"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=5836148544871025856"
        -getName(): string: "Mimohello GmbH"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/4EbbMw6TnleJPtv4rc2C-8NVle1c9xxRkGfPLBzdqosNT61Fk7ag-TYXcVadm8V8uA4"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/4EbbMw6TnleJPtv4rc2C-8NVle1c9xxRkGfPLBzdqosNT61Fk7ag-TYXcVadm8V8uA4=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/4EbbMw6TnleJPtv4rc2C-8NVle1c9xxRkGfPLBzdqosNT61Fk7ag-TYXcVadm8V8uA4"
      }
      -getScore(): float: 4.6699705
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    …
  ]
```

</details>



### GPlayApps::getSearchSuggestions [[docs]](classes/GPlayApps/gplayapps.getsearchsuggestions.md)
Returns the Google Play search suggests.

```php
$suggestions = $gplay
//    ->setDefaultLocale('en_US') // can set locale
//    ->setDefaultCountry('us')   // can set country
    ->getSearchSuggestions($query = 'Maps')
;
```
<details>
  <summary>Results</summary>

```php
array:5 [
    0 => "maps"
    1 => "maps for minecraft"
    …
  ]
```

</details>



### GPlayApps::search [[docs]](classes/GPlayApps/gplayapps.search.md)
Returns a list of applications from the Google Play store for a search query.

```php
$apps = $gplay->search(
    $query = 'Maps',
    $limit = 150,
    $price = \Nelexa\GPlay\Enum\PriceEnum::ALL()
);
```
<details>
  <summary>Results</summary>

```php
array:150 [
    0 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.google.android.apps.maps"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.maps"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.maps&hl=en_US&gl=us"
      -getName(): string: "Maps - Navigate & Explore"
      -getSummary(): ?string: "Real-time GPS navigation & local suggestions for food, events, & activities"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "5700313618786177705"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=5700313618786177705"
        -getName(): string: "Google LLC"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/Kf8WTct65hFJxBUDm5E-EpYsiDoLQiGGbnuyP6HBNax43YShXti9THPon1YKB6zPYpA"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/Kf8WTct65hFJxBUDm5E-EpYsiDoLQiGGbnuyP6HBNax43YShXti9THPon1YKB6zPYpA=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/Kf8WTct65hFJxBUDm5E-EpYsiDoLQiGGbnuyP6HBNax43YShXti9THPon1YKB6zPYpA"
      }
      -getScore(): float: 4.3254695
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    1 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.google.android.apps.mapslite"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.mapslite"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.mapslite&hl=en_US&gl=us"
      -getName(): string: "Google Maps Go - Directions, Traffic & Transit"
      -getSummary(): ?string: "Get real-time traffic, directions, search and find places"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "5700313618786177705"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=5700313618786177705"
        -getName(): string: "Google LLC"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/0uRNRSe4iS6nhvfbBcoScHcBTx1PMmxkCx8rrEsI2UQcQeZ5ByKz8fkhwRqR3vttOg"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/0uRNRSe4iS6nhvfbBcoScHcBTx1PMmxkCx8rrEsI2UQcQeZ5ByKz8fkhwRqR3vttOg=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/0uRNRSe4iS6nhvfbBcoScHcBTx1PMmxkCx8rrEsI2UQcQeZ5ByKz8fkhwRqR3vttOg"
      }
      -getScore(): float: 4.3090644
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    …
  ]
```

</details>



### GPlayApps::getListApps [[docs]](classes/GPlayApps/gplayapps.getlistapps.md)
Returns an array of applications from the Google Play store for the specified category.

**Example 1. Gets apps by category.**
```php
$apps = $gplay->getListApps(\Nelexa\GPlay\Enum\CategoryEnum::GAME_RACING());
```
<details>
  <summary>Results</summary>

```php
array:169 [
    "com.combineinc.streetracing.driftthreeD" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.combineinc.streetracing.driftthreeD"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.combineinc.streetracing.driftthreeD"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.combineinc.streetracing.driftthreeD&hl=en_US&gl=us"
      -getName(): string: "Street Racing 3D"
      -getSummary(): ?string: "Street car racing has started, experience the drving skills!"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "6936794375735348055"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=6936794375735348055"
        -getName(): string: "Ivy"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/xzMuAO5HWhJgEQlZd9qn_A1LK21FXOED2HVVqEh9uce-e9G8unFR5Vb8Xaq4nZuw06A"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/xzMuAO5HWhJgEQlZd9qn_A1LK21FXOED2HVVqEh9uce-e9G8unFR5Vb8Xaq4nZuw06A=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/xzMuAO5HWhJgEQlZd9qn_A1LK21FXOED2HVVqEh9uce-e9G8unFR5Vb8Xaq4nZuw06A"
      }
      -getScore(): float: 4.363952
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    "com.gameloft.android.ANMP.GloftA9HM" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.gameloft.android.ANMP.GloftA9HM"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.gameloft.android.ANMP.GloftA9HM"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.gameloft.android.ANMP.GloftA9HM&hl=en_US&gl=us"
      -getName(): string: "Asphalt 9: Legends - Epic Car Action Racing Game"
      -getSummary(): ?string: "Tear up the Asphalt & become the next Legend in the ultimate arcade racing game."
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "4826827787946964969"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=4826827787946964969"
        -getName(): string: "Gameloft SE"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/cQBJ7Jwvz0jex8sL7LjgLId-wOdmMajSZbpC-bzHDhS5uK9Zms0fFsXEVNGvlIUk_g"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/cQBJ7Jwvz0jex8sL7LjgLId-wOdmMajSZbpC-bzHDhS5uK9Zms0fFsXEVNGvlIUk_g=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/cQBJ7Jwvz0jex8sL7LjgLId-wOdmMajSZbpC-bzHDhS5uK9Zms0fFsXEVNGvlIUk_g"
      }
      -getScore(): float: 4.5014334
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    …
  ]
```

</details>

**Example 1. Gets applications from the GAMES category with an age limit of 6-8 years.**
```php
$apps = $gplay->getListApps(
    $category = \Nelexa\GPlay\Enum\CategoryEnum::GAME(),
    $ageLimit = \Nelexa\GPlay\Enum\AgeEnum::SIX_EIGHT(),
    $limit = 100
);
```
<details>
  <summary>Results</summary>

```php
array:100 [
    "com.gameloft.car.tycoon.game" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.gameloft.car.tycoon.game"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.gameloft.car.tycoon.game"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.gameloft.car.tycoon.game&hl=en_US&gl=us"
      -getName(): string: "Overdrive City – Car Tycoon Game"
      -getSummary(): ?string: "Build your car city and race! (Install requires 2.5 GB of disk space.)"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "4826827787946964969"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=4826827787946964969"
        -getName(): string: "Gameloft SE"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/PctrUsXkExv1coL2YyoaQSPmYGzuqhBROWpDOCxEhA0a9jeEzl0kD580jlZCeV9CoGg"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/PctrUsXkExv1coL2YyoaQSPmYGzuqhBROWpDOCxEhA0a9jeEzl0kD580jlZCeV9CoGg=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/PctrUsXkExv1coL2YyoaQSPmYGzuqhBROWpDOCxEhA0a9jeEzl0kD580jlZCeV9CoGg"
      }
      -getScore(): float: 4.3102565
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    "com.igg.android.mobileroyale" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.igg.android.mobileroyale"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.igg.android.mobileroyale"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.igg.android.mobileroyale&hl=en_US&gl=us"
      -getName(): string: "Mobile Royale MMORPG - Build a Strategy for Battle"
      -getSummary(): ?string: "Enjoy this 3D fantasy world! Fight in a RTS multiplayer battle, build your city!"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "8895734616362643252"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=8895734616362643252"
        -getName(): string: "IGG.COM"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/iBHuomMtanzz3EIEARbv-x-_FmKBqCg-m7iYj2daqYYrYBOSJ6isDeiDixHl4i4J1fM"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/iBHuomMtanzz3EIEARbv-x-_FmKBqCg-m7iYj2daqYYrYBOSJ6isDeiDixHl4i4J1fM=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/iBHuomMtanzz3EIEARbv-x-_FmKBqCg-m7iYj2daqYYrYBOSJ6isDeiDixHl4i4J1fM"
      }
      -getScore(): float: 4.0906167
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    …
  ]
```

</details>

**Example 1. Gets applications from page https://play.google.com/store/apps**
```php
$apps = $gplay->getListApps();
```
<details>
  <summary>Results</summary>

```php
array:600 [
    "com.water.balls" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.water.balls"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.water.balls"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.water.balls&hl=en_US&gl=us"
      -getName(): string: "Sand Balls"
      -getSummary(): ?string: "Collect all balls!"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "SayGames"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=SayGames"
        -getName(): string: "SayGames"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/U0hk5TisL-gYTm2anJElHtaNrJ52NdJnEjPjyygRnAXERW_tv2yo-wAVUM3sVIguf4CC"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/U0hk5TisL-gYTm2anJElHtaNrJ52NdJnEjPjyygRnAXERW_tv2yo-wAVUM3sVIguf4CC=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/U0hk5TisL-gYTm2anJElHtaNrJ52NdJnEjPjyygRnAXERW_tv2yo-wAVUM3sVIguf4CC"
      }
      -getScore(): float: 4.186313
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    "com.fingersoft.hillclimb" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.fingersoft.hillclimb"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.fingersoft.hillclimb"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.fingersoft.hillclimb&hl=en_US&gl=us"
      -getName(): string: "Hill Climb Racing"
      -getSummary(): ?string: "Play the best physics based driving game ever made! For Free! 🚥🏎️🚗🏁🏆"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "7064049075652771302"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=7064049075652771302"
        -getName(): string: "Fingersoft"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/N0UxhBVUmx8s7y3F7Kqre2AcpXyPDKAp8nHjiPPoOONc_sfugHCYMjBpbUKCMlK_XUs"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/N0UxhBVUmx8s7y3F7Kqre2AcpXyPDKAp8nHjiPPoOONc_sfugHCYMjBpbUKCMlK_XUs=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/N0UxhBVUmx8s7y3F7Kqre2AcpXyPDKAp8nHjiPPoOONc_sfugHCYMjBpbUKCMlK_XUs"
      }
      -getScore(): float: 4.427317
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    …
  ]
```

</details>



### GPlayApps::getTopApps [[docs]](classes/GPlayApps/gplayapps.gettopapps.md)
Returns an array of **top apps** from the Google Play store for the specified category.

**Example 1. Gets top apps by category.**
```php
$apps = $gplay->getTopApps(\Nelexa\GPlay\Enum\CategoryEnum::GAME_RACING());
```
<details>
  <summary>Results</summary>

```php
array:280 [
    "com.gym.racegame" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.gym.racegame"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.gym.racegame"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.gym.racegame&hl=en_US&gl=us"
      -getName(): string: "Epic Race 3D"
      -getSummary(): ?string: "50% Luck, 70% Skill, 30% Will"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "Good Job Games"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=Good+Job+Games"
        -getName(): string: "Good Job Games"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/u8Qv75lvrmBbv0kyDHnjX5Xi1g8SIUN5wOfKJXi3wVukaINv2lFuvr0MUl5FJelbKg2b"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/u8Qv75lvrmBbv0kyDHnjX5Xi1g8SIUN5wOfKJXi3wVukaINv2lFuvr0MUl5FJelbKg2b=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/u8Qv75lvrmBbv0kyDHnjX5Xi1g8SIUN5wOfKJXi3wVukaINv2lFuvr0MUl5FJelbKg2b"
      }
      -getScore(): float: 3.8746777
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    "com.slippy.linerusher" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.slippy.linerusher"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.slippy.linerusher"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.slippy.linerusher&hl=en_US&gl=us"
      -getName(): string: "Fun Race 3D"
      -getSummary(): ?string: "Once You Start, You Can’t Stop"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "Good Job Games"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=Good+Job+Games"
        -getName(): string: "Good Job Games"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/9OjEvPQm7nJ83ZXqMsPV2UZCRzVw4_un-aAGdbqkwV-Wk3oT9iqFshmeiLTHvbMPkgk"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/9OjEvPQm7nJ83ZXqMsPV2UZCRzVw4_un-aAGdbqkwV-Wk3oT9iqFshmeiLTHvbMPkgk=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/9OjEvPQm7nJ83ZXqMsPV2UZCRzVw4_un-aAGdbqkwV-Wk3oT9iqFshmeiLTHvbMPkgk"
      }
      -getScore(): float: 4.1582165
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    …
  ]
```

</details>

**Example 1. Gets top apps from the GAMES category with an age limit of 6-8 years.**
```php
$apps = $gplay->getTopApps(
    $category = \Nelexa\GPlay\Enum\CategoryEnum::GAME(),
    $ageLimit = \Nelexa\GPlay\Enum\AgeEnum::SIX_EIGHT(),
    $limit = \Nelexa\GPlay\GPlayApps::UNLIMIT
);
```
<details>
  <summary>Results</summary>

```php
array:530 [
    "com.BallGames.Woodturning" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.BallGames.Woodturning"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.BallGames.Woodturning"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.BallGames.Woodturning&hl=en_US&gl=us"
      -getName(): string: "Woodturning"
      -getSummary(): ?string: "One lathe to rule them all"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "VOODOO"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=VOODOO"
        -getName(): string: "VOODOO"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/p_TPhF6yEel0S1DklaU9vRg4jHnLQx212O0J9WQfvqo_EpaMuW3lTBEngJEx2yj31AQ"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/p_TPhF6yEel0S1DklaU9vRg4jHnLQx212O0J9WQfvqo_EpaMuW3lTBEngJEx2yj31AQ=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/p_TPhF6yEel0S1DklaU9vRg4jHnLQx212O0J9WQfvqo_EpaMuW3lTBEngJEx2yj31AQ"
      }
      -getScore(): float: 3.7703204
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    "com.trianglegames.squarebird" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.trianglegames.squarebird"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.trianglegames.squarebird"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.trianglegames.squarebird&hl=en_US&gl=us"
      -getName(): string: "Square Bird"
      -getSummary(): ?string: "Build the perfect egg tower!"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "MOONEE PUBLISHING LTD"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=MOONEE+PUBLISHING+LTD"
        -getName(): string: "MOONEE PUBLISHING LTD"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/-tinv3wt-7QR6cNYu3fLw5ySktJ0Mb5iydk5QIAPphFkvBuE-xwFuxsy57IGY5lVSQM"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/-tinv3wt-7QR6cNYu3fLw5ySktJ0Mb5iydk5QIAPphFkvBuE-xwFuxsy57IGY5lVSQM=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/-tinv3wt-7QR6cNYu3fLw5ySktJ0Mb5iydk5QIAPphFkvBuE-xwFuxsy57IGY5lVSQM"
      }
      -getScore(): float: 4.1803513
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    …
  ]
```

</details>

**Example 1. Gets top apps from page https://play.google.com/store/apps/top**
```php
$apps = $gplay->getTopApps();
```
<details>
  <summary>Results</summary>

```php
array:1074 [
    "com.whatsapp" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.whatsapp"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.whatsapp"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.whatsapp&hl=en_US&gl=us"
      -getName(): string: "WhatsApp Messenger"
      -getSummary(): ?string: "Simple. Personal. Secure."
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "WhatsApp Inc."
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=WhatsApp+Inc."
        -getName(): string: "WhatsApp Inc."
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/bYtqbOcTYOlgc6gqZ2rwb8lptHuwlNE75zYJu6Bn076-hTmvd96HH-6v7S0YUAAJXoJN"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/bYtqbOcTYOlgc6gqZ2rwb8lptHuwlNE75zYJu6Bn076-hTmvd96HH-6v7S0YUAAJXoJN=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/bYtqbOcTYOlgc6gqZ2rwb8lptHuwlNE75zYJu6Bn076-hTmvd96HH-6v7S0YUAAJXoJN"
      }
      -getScore(): float: 4.28501
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    "com.zhiliaoapp.musically" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.zhiliaoapp.musically"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.zhiliaoapp.musically"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.zhiliaoapp.musically&hl=en_US&gl=us"
      -getName(): string: "TikTok - Make Your Day"
      -getSummary(): ?string: "Real People. Real Videos."
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "TikTok Inc."
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=TikTok+Inc."
        -getName(): string: "TikTok Inc."
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/iBYjvYuNq8BB7EEEHktPG1fpX9NiY7Jcyg1iRtQxO442r9CZ8H-X9cLkTjpbORwWDG9d"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/iBYjvYuNq8BB7EEEHktPG1fpX9NiY7Jcyg1iRtQxO442r9CZ8H-X9cLkTjpbORwWDG9d=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/iBYjvYuNq8BB7EEEHktPG1fpX9NiY7Jcyg1iRtQxO442r9CZ8H-X9cLkTjpbORwWDG9d"
      }
      -getScore(): float: 4.581792
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    …
  ]
```

</details>



### GPlayApps::getNewApps [[docs]](classes/GPlayApps/gplayapps.getnewapps.md)
Returns an array of **new apps** from the Google Play store for the specified category.

**Example 1. Gets new apps by category.**
```php
$apps = $gplay->getNewApps(\Nelexa\GPlay\Enum\CategoryEnum::GAME_RACING());
```
<details>
  <summary>Results</summary>

```php
array:47 [
    "com.gym.racegame" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.gym.racegame"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.gym.racegame"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.gym.racegame&hl=en_US&gl=us"
      -getName(): string: "Epic Race 3D"
      -getSummary(): ?string: "50% Luck, 70% Skill, 30% Will"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "Good Job Games"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=Good+Job+Games"
        -getName(): string: "Good Job Games"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/u8Qv75lvrmBbv0kyDHnjX5Xi1g8SIUN5wOfKJXi3wVukaINv2lFuvr0MUl5FJelbKg2b"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/u8Qv75lvrmBbv0kyDHnjX5Xi1g8SIUN5wOfKJXi3wVukaINv2lFuvr0MUl5FJelbKg2b=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/u8Qv75lvrmBbv0kyDHnjX5Xi1g8SIUN5wOfKJXi3wVukaINv2lFuvr0MUl5FJelbKg2b"
      }
      -getScore(): float: 3.8746777
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    "com.fancyforce.happywheels" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.fancyforce.happywheels"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.fancyforce.happywheels"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.fancyforce.happywheels&hl=en_US&gl=us"
      -getName(): string: "Happy Wheels"
      -getSummary(): ?string: "Happy Wheels is an intense, side-scrolling, physics-based, obstacle course game."
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "James Bonacci"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=James+Bonacci"
        -getName(): string: "James Bonacci"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/SV8RsV5udSeeONjatT5SwleP6lzV6PjtNPs2VvyohJXWSG9fFLNOfslDEHbpDN337wQ"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/SV8RsV5udSeeONjatT5SwleP6lzV6PjtNPs2VvyohJXWSG9fFLNOfslDEHbpDN337wQ=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/SV8RsV5udSeeONjatT5SwleP6lzV6PjtNPs2VvyohJXWSG9fFLNOfslDEHbpDN337wQ"
      }
      -getScore(): float: 4.3360324
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    …
  ]
```

</details>

**Example 1. Gets new apps from the GAMES category with an age limit of 6-8 years.**
```php
$apps = $gplay->getNewApps(
    $category = \Nelexa\GPlay\Enum\CategoryEnum::GAME(),
    $ageLimit = \Nelexa\GPlay\Enum\AgeEnum::SIX_EIGHT(),
    $limit = \Nelexa\GPlay\GPlayApps::UNLIMIT
);
```
<details>
  <summary>Results</summary>

```php
array:188 [
    "com.appadvisory.drawclimber" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.appadvisory.drawclimber"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.appadvisory.drawclimber"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.appadvisory.drawclimber&hl=en_US&gl=us"
      -getName(): string: "Draw Climber"
      -getSummary(): ?string: "Draw your legs to win the race!"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "VOODOO"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=VOODOO"
        -getName(): string: "VOODOO"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/0tq7Z4-FvJd9rpPPIztraZcxoRsfX_U_6sH7Z5x_EdW3O-XyPUjXBkOLQprHgj0NJzQx"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/0tq7Z4-FvJd9rpPPIztraZcxoRsfX_U_6sH7Z5x_EdW3O-XyPUjXBkOLQprHgj0NJzQx=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/0tq7Z4-FvJd9rpPPIztraZcxoRsfX_U_6sH7Z5x_EdW3O-XyPUjXBkOLQprHgj0NJzQx"
      }
      -getScore(): float: 3.24
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    "com.HeroGames.WoodShop" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.HeroGames.WoodShop"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.HeroGames.WoodShop"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.HeroGames.WoodShop&hl=en_US&gl=us"
      -getName(): string: "Wood Shop"
      -getSummary(): ?string: "Satisfying Wood Carving Art"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "Rollic Games"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=Rollic+Games"
        -getName(): string: "Rollic Games"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/C3ztBVoJujqMojs59g4RLQHHpJD2K5wNikV9RBNAFtDd54_3fp_-jRUXC9h1SzXLRj4F"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/C3ztBVoJujqMojs59g4RLQHHpJD2K5wNikV9RBNAFtDd54_3fp_-jRUXC9h1SzXLRj4F=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/C3ztBVoJujqMojs59g4RLQHHpJD2K5wNikV9RBNAFtDd54_3fp_-jRUXC9h1SzXLRj4F"
      }
      -getScore(): float: 2.148289
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    …
  ]
```

</details>

**Example 1. Gets new apps from page https://play.google.com/store/apps/new**
```php
$apps = $gplay->getNewApps();
```
<details>
  <summary>Results</summary>

```php
array:399 [
    "com.fnaps.mod.addon" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.fnaps.mod.addon"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.fnaps.mod.addon"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.fnaps.mod.addon&hl=en_US&gl=us"
      -getName(): string: "Mod Freddy for MCPE"
      -getSummary(): ?string: "Download and install fnap mod for MCPE."
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "Seepaul"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=Seepaul"
        -getName(): string: "Seepaul"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/Rk0zW4o7HzcmU0skttNNSYcv-EIqsmPwVsNZp4lu2CUZEoMdlCctvXm2U_qtSlZT9BU"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/Rk0zW4o7HzcmU0skttNNSYcv-EIqsmPwVsNZp4lu2CUZEoMdlCctvXm2U_qtSlZT9BU=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/Rk0zW4o7HzcmU0skttNNSYcv-EIqsmPwVsNZp4lu2CUZEoMdlCctvXm2U_qtSlZT9BU"
      }
      -getScore(): float: 4.27
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    "com.video.magician" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.video.magician"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.video.magician"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.video.magician&hl=en_US&gl=us"
      -getName(): string: "Video Magician"
      -getSummary(): ?string: "Video Magician"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "More Money more"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=More+Money+more"
        -getName(): string: "More Money more"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): mixed: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/2OhNoYN55Op82vBizSjzRpAbH9w28YtDnZroZZCIU_eCFNfyPxgygKonWxc4V-wr178a"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/2OhNoYN55Op82vBizSjzRpAbH9w28YtDnZroZZCIU_eCFNfyPxgygKonWxc4V-wr178a=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/2OhNoYN55Op82vBizSjzRpAbH9w28YtDnZroZZCIU_eCFNfyPxgygKonWxc4V-wr178a"
      }
      -getScore(): float: 2.1
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    …
  ]
```

</details>



### GPlayApps::saveGoogleImages [[docs]](classes/GPlayApps/gplayapps.savegoogleimages.md)
Asynchronously saves images from googleusercontent.com and similar URLs to disk.

**Example 1 - Asynchronously save images**
```php
$app = $gplay->getAppInfo(new \Nelexa\GPlay\Model\AppId('com.rovio.angrybirds', 'ru'));
$screenshots = $app->getScreenshots();

// download and save images
$imageInfos = $gplay
    ->setConcurrency(10)
    ->saveGoogleImages(
        $screenshots,
        static function (Nelexa\GPlay\Model\GoogleImage $image) {
            // set width or height 700px
            $image->setSize(700);
            $hash = $image->getHashUrl($hashAlgo = 'md5', $parts = 2, $partLength = 2);

            return 'screenshots/' . $hash . '.{ext}';
        }
    )
;
```
<details>
  <summary>Results</summary>

```php
array:15 [
    0 => class Nelexa\GPlay\Model\ImageInfo {
      -getUrl(): string: "https://lh3.googleusercontent.com/Qty-abgT_-kvC_uU-cDgY9YyGqVbjMxoHjHKF5fBCEuBLv64Xn88RXY5hhcom92q3pE=s700"
      -getFilename(): string: "screenshots/6b/bb/6bbb94f8b009399ed1bc51d82dc9abc1.png"
      -getMimeType(): string: "image/png"
      -getExtension(): string: "png"
      -getWidth(): int: 394
      -getHeight(): int: 700
      -getFilesize(): int: 266242
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    1 => class Nelexa\GPlay\Model\ImageInfo {
      -getUrl(): string: "https://lh3.googleusercontent.com/APOh41DcYeFCRukZMmrvpmdKXurhhPhHKm8Pv-iezGxAWCiHPMEBwYZrgPItsy9ZpfQ=s700"
      -getFilename(): string: "screenshots/d7/49/d749ba30b0c9214b77eb4103b20082f9.png"
      -getMimeType(): string: "image/png"
      -getExtension(): string: "png"
      -getWidth(): int: 394
      -getHeight(): int: 700
      -getFilesize(): int: 328205
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    …
  ]
```

</details>

**Example 2 - Save one image**
```php
$app = $gplay->getAppInfo(new \Nelexa\GPlay\Model\AppId('com.rovio.angrybirds', 'ru'));

$imageInfo = $app->getIcon()
    ->setWidth(300)
    ->saveAs('icons/' . $app->getId() . '.{ext}')
;
```
<details>
  <summary>Results</summary>

```php
class Nelexa\GPlay\Model\ImageInfo {
  -getUrl(): string: "https://lh3.googleusercontent.com/iOi6YJxQwMenT5UQWGPWTrFMQFm68IC4uKlFtARveZzVD5lTZ7fC47_rnnF7Tk48DpY=w300"
  -getFilename(): string: "icons/com.rovio.angrybirds.png"
  -getMimeType(): string: "image/png"
  -getExtension(): string: "png"
  -getWidth(): int: 300
  -getHeight(): int: 300
  -getFilesize(): int: 59706
  -asArray(): array: …
  -jsonSerialize(): mixed: …
}
```

</details>




