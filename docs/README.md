# nelexa/google-play-scraper

PHP Scraper to extract information about Android applications from the Google Play store.

[![Packagist Version](https://img.shields.io/packagist/v/nelexa/google-play-scraper.svg?style=popout)](https://packagist.org/packages/nelexa/google-play-scraper)
![PHP from Packagist](https://img.shields.io/packagist/php-v/nelexa/google-play-scraper.svg?style=popout&color=yellowgreen)
[![Build Status](https://secure.travis-ci.org/Ne-Lexa/google-play-scraper.png)](http://travis-ci.org/Ne-Lexa/google-play-scraper)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Ne-Lexa/google-play-scraper/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Ne-Lexa/google-play-scraper/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/Ne-Lexa/google-play-scraper/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Ne-Lexa/google-play-scraper/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/Ne-Lexa/google-play-scraper/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Ne-Lexa/google-play-scraper/build-status/master)
[![License](https://img.shields.io/packagist/l/nelexa/google-play-scraper.svg?style=popout&color=01f176)](https://packagist.org/packages/nelexa/google-play-scraper)

## Installation
Add `nelexa/google-play-scraper` as a require dependency in your composer.json file:

```shell
composer require nelexa/google-play-scraper
```

## Usage
Create an instance of `\Nelexa\GPlay\GPlayApps`:

```php
$gplay = new \Nelexa\GPlay\GPlayApps();
```

By default, the information is extracted for the `en_US` locale and for the country `US`.

The locale affects which language the information will be extracted for.  
Country affects the price and currency of paid applications.

You can set the locale and country for all requests.
```php
$gplay = new GPlayApps($locale = 'uk', $country = 'ua');
```
or
```php
$gplay
    ->setLocale('uk')
    ->setCountry('ua');
```

#### Caching
Since each library method performs one or more HTTP-requests to the Google Play server, it is sometimes useful to cache the results so as not to request the same data twice. 

Use [PSR-16 Simple Cache](https://packagist.org/providers/psr/simple-cache-implementation) compliant cache provider.

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
  -getScore(): float: 4.4578714
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
  -getNumberVoters(): int: 3084782
  -getNumberReviews(): int: 1595840
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
      -getCountLikes(): int: 9712
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
      -getCountLikes(): int: 4150
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
      -getScore(): float: 4.4578714
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
      -getInstalls(): int: 27323886
      -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
        -getFiveStars(): int: 2405991
        -getFourStars(): int: 246493
        -getThreeStars(): int: 118772
        -getTwoStars(): int: 65780
        -getOneStar(): int: 247742
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
      -getNumberVoters(): int: 3084780
      -getNumberReviews(): int: 1595838
      -getReviews(): array:4 [
        0 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOHXInX9_Y5AfQjP7N1nb71L_VaOG9CKzF3gtEefqCVZYvTocYmp5mVge3QHh0-QrIpuEj4lIzSpR1iwz5U"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe&reviewId=gp%3AAOqpTOHXInX9_Y5AfQjP7N1nb71L_VaOG9CKzF3gtEefqCVZYvTocYmp5mVge3QHh0-…"
          -getUserName(): string: "rafa fabi"
          -getText(): string: "muito decepcionante pagar pelo jogo e mesmo assim deparar-se com problemas de jogabilidade. jogar online em endereços diferentes é praticamente imposs…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -getUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mAU5Be_53SOaVPuVirDHDE6iTyK0vCefsgK-VVUjA=s64"
            -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mAU5Be_53SOaVPuVirDHDE6iTyK0vCefsgK-VVUjA=s0"
            -getBinaryImageContent(): string: …
            -__toString(): string: "https://lh3.googleusercontent.com/a-/AAuE7mAU5Be_53SOaVPuVirDHDE6iTyK0vCefsgK-VVUjA=s64"
          }
          -getDate(): ?DateTimeInterface: @1581385130 {
            date: 2020-02-11T01:38:50+00:00
          }
          -getScore(): int: 1
          -getCountLikes(): int: 64
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -asArray(): array: …
          -jsonSerialize(): mixed: …
        }
        1 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOGccABYmTwtROuk6toEz8s3tkbKyeF_xnN56glRuELrr0bWvBi0m71So26rs3w3ji5degaHBw5V2mAmYFI"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe&reviewId=gp%3AAOqpTOGccABYmTwtROuk6toEz8s3tkbKyeF_xnN56glRuELrr0bWvBi0m71So26rs3w…"
          -getUserName(): string: "Andressa Santos"
          -getText(): string: "Depois da última atualização, Não consigo conectar ao jogo/mundo multiplayer. Há erros na conexão por servidor e também não consigo conectar ao multip…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -getUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mAtL3gJ8zGBmOeb6FGh7myKTfSlMEonTm9d2fko4g=s64"
            -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mAtL3gJ8zGBmOeb6FGh7myKTfSlMEonTm9d2fko4g=s0"
            -getBinaryImageContent(): string: …
            -__toString(): string: "https://lh3.googleusercontent.com/a-/AAuE7mAtL3gJ8zGBmOeb6FGh7myKTfSlMEonTm9d2fko4g=s64"
          }
          -getDate(): ?DateTimeInterface: @1580688212 {
            date: 2020-02-03T00:03:32+00:00
          }
          -getScore(): int: 1
          -getCountLikes(): int: 626
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
      -getScore(): float: 3.8194444
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
      -getInstalls(): int: 595303
      -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
        -getFiveStars(): int: 1259
        -getFourStars(): int: 191
        -getThreeStars(): int: 151
        -getTwoStars(): int: 221
        -getOneStar(): int: 352
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
      -getUpdated(): ?DateTimeInterface: @1580899434 {
        date: 2020-02-05T10:43:54+00:00
      }
      -getNumberVoters(): int: 2176
      -getNumberReviews(): int: 556
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
          -getCountLikes(): int: 14
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
          -getCountLikes(): int: 56
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
      -getScore(): float: 3.8194444
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
      -getInstalls(): int: 595303
      -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
        -getFiveStars(): int: 1259
        -getFourStars(): int: 191
        -getThreeStars(): int: 151
        -getTwoStars(): int: 221
        -getOneStar(): int: 352
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
      -getUpdated(): ?DateTimeInterface: @1580899434 {
        date: 2020-02-05T10:43:54+00:00
      }
      -getNumberVoters(): int: 2176
      -getNumberReviews(): int: 556
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
    1 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOG_xA95u0_lmV3wsgCsQtowloGBgg6npK5MD_dHWE1dFhsFsZXU6SlHjZGHdIZhvVUfyhhCjDAzBPOfSuA"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=ru.yandex.metro&reviewId=gp%3AAOqpTOG_xA95u0_lmV3wsgCsQtowloGBgg6npK5MD_dHWE1dFhsFsZXU6SlHjZGHdIZhvVUfyh…"
      -getUserName(): string: "Андрей Жигалов"
      -getText(): string: "После пополнения карты, запись ден. средств на карту происходит только раза с восьмого. Постоянно ошибки какие-то. Приложение удобное, но работает не …"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/-djEIryva90g/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rcNhSmP66ktNvsWeLcIEBM59ypA9g/s64/"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/-djEIryva90g/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rcNhSmP66ktNvsWeLcIEBM59ypA9g/s0/"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/-djEIryva90g/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rcNhSmP66ktNvsWeLcIEBM59ypA9g/s64/"
      }
      -getDate(): ?DateTimeInterface: @1580965709 {
        date: 2020-02-06T05:08:29+00:00
      }
      -getScore(): int: 3
      -getCountLikes(): int: 2
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: {
        -getDate(): DateTimeInterface: @1581004502 {
          date: 2020-02-06T15:55:02+00:00
        }
        -getText(): string: "Пожалуйста, напишите нам о ситуации на geopay@support.yandex.ru. Обязательно всё проверим."
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
        0 => "full network access"
        1 => "view network connections"
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
array:130 [
    0 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.google.android.projection.gearhead"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.projection.gearhead"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.projection.gearhead&hl=en_US&gl=us"
      -getName(): string: "Android Auto - Google Maps, Media & Messaging"
      -getSummary(): ?string: "Control maps, media and messaging, with the Google Assistant while you drive"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/drnkC46hMwqPTdRLLLufhKgy_dRhA7uNTN14-tq2NxtI3deDakYOAR_4zeHcqbGg4Q"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/drnkC46hMwqPTdRLLLufhKgy_dRhA7uNTN14-tq2NxtI3deDakYOAR_4zeHcqbGg4Q=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/drnkC46hMwqPTdRLLLufhKgy_dRhA7uNTN14-tq2NxtI3deDakYOAR_4zeHcqbGg4Q"
      }
      -getScore(): float: 4.1934695
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    1 => class Nelexa\GPlay\Model\App {
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
      -getScore(): float: 4.353653
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
        -getId(): string: "Coding and Programming"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=Coding+and+Programming"
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
      -getScore(): float: 4.5916324
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
      -getScore(): float: 4.674122
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
      -getScore(): float: 4.328209
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
      -getScore(): float: 4.3055086
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
array:180 [
    "com.x3m.tx4" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.x3m.tx4"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.x3m.tx4"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.x3m.tx4&hl=en_US&gl=us"
      -getName(): string: "Trial Xtreme 4: extreme bike racing champions"
      -getSummary(): ?string: "Less than 1% of the players managed to achieve ⭐⭐⭐ on all levels - can you?"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "5042939762592943088"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=5042939762592943088"
        -getName(): string: "Deemedya INC"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/3JzjZwWDGuk49msstnvR3k7tjd7vo_461jLMMiZIdvxlz_lhF6oXF0Ws4s_8599hdrBL"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/3JzjZwWDGuk49msstnvR3k7tjd7vo_461jLMMiZIdvxlz_lhF6oXF0Ws4s_8599hdrBL=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/3JzjZwWDGuk49msstnvR3k7tjd7vo_461jLMMiZIdvxlz_lhF6oXF0Ws4s_8599hdrBL"
      }
      -getScore(): float: 4.247471
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    "com.herocraft.game.free.deadparadise" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.herocraft.game.free.deadparadise"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.herocraft.game.free.deadparadise"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.herocraft.game.free.deadparadise&hl=en_US&gl=us"
      -getName(): string: "Dead Paradise: Race Shooter"
      -getSummary(): ?string: "Race Shooter, Destruction, Cars Upgrades, Win The Death Race!"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "5866306697629323411"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=5866306697629323411"
        -getName(): string: "SMOKOKO LTD"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/S0FPKiVK7AwibF8dZC3LvZAFXl-ugmqup3e6UImS67zqdyu4N30KadzpokZMfI_Ilu8"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/S0FPKiVK7AwibF8dZC3LvZAFXl-ugmqup3e6UImS67zqdyu4N30KadzpokZMfI_Ilu8=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/S0FPKiVK7AwibF8dZC3LvZAFXl-ugmqup3e6UImS67zqdyu4N30KadzpokZMfI_Ilu8"
      }
      -getScore(): float: 4.531811
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
    "net.wooga.junes_journey_hidden_object_mystery_game" => class Nelexa\GPlay\Model\App {
      -getId(): string: "net.wooga.junes_journey_hidden_object_mystery_game"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=net.wooga.junes_journey_hidden_object_mystery_game"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=net.wooga.junes_journey_hidden_object_mystery_game&hl=en_US&gl=us"
      -getName(): string: "June's Journey - Hidden Objects"
      -getSummary(): ?string: "Find hidden objects in stunning vintage scenes to solve mind-teasing mysteries"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "5187629073610793871"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=5187629073610793871"
        -getName(): string: "Wooga"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/jq_PkkiyZGyEOx9eGgCVTU3Oyv2zHAea13zSxgj_9al0Rc_cp2PxWAySj1ywjpJ3y4U"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/jq_PkkiyZGyEOx9eGgCVTU3Oyv2zHAea13zSxgj_9al0Rc_cp2PxWAySj1ywjpJ3y4U=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/jq_PkkiyZGyEOx9eGgCVTU3Oyv2zHAea13zSxgj_9al0Rc_cp2PxWAySj1ywjpJ3y4U"
      }
      -getScore(): float: 4.6209693
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    "com.ea.games.simsfreeplay_row" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.ea.games.simsfreeplay_row"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.ea.games.simsfreeplay_row"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.ea.games.simsfreeplay_row&hl=en_US&gl=us"
      -getName(): string: "The Sims FreePlay"
      -getSummary(): ?string: "What’s your story? Create and customize every aspect of your Sims’ lives!"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "6605125519975771237"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=6605125519975771237"
        -getName(): string: "ELECTRONIC ARTS"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/0KahR-oT7Q6ziHAEru_KHYcrz8s7x_egKpm8RPqg1uuLmYpuri7qdMhnWHtUJq5NKNs"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/0KahR-oT7Q6ziHAEru_KHYcrz8s7x_egKpm8RPqg1uuLmYpuri7qdMhnWHtUJq5NKNs=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/0KahR-oT7Q6ziHAEru_KHYcrz8s7x_egKpm8RPqg1uuLmYpuri7qdMhnWHtUJq5NKNs"
      }
      -getScore(): float: 3.9615788
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
array:682 [
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
      -getScore(): float: 4.2857103
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    "com.vkontakte.android" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.vkontakte.android"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.vkontakte.android"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.vkontakte.android&hl=en_US&gl=us"
      -getName(): string: "VK — live chatting & free calls"
      -getSummary(): ?string: "Social network with text messaging and photo stories"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "VK.com"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=VK.com"
        -getName(): string: "VK.com"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/bgAuxUGArC8zH3NLJip3hn7CJur37IRotIqB5Xly--Zind-JD9r-ndCj30b1Wec7aOQ"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/bgAuxUGArC8zH3NLJip3hn7CJur37IRotIqB5Xly--Zind-JD9r-ndCj30b1Wec7aOQ=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/bgAuxUGArC8zH3NLJip3hn7CJur37IRotIqB5Xly--Zind-JD9r-ndCj30b1Wec7aOQ"
      }
      -getScore(): float: 3.7000844
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
array:279 [
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
      -getScore(): float: 3.9453926
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
      -getScore(): float: 4.1609874
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
array:524 [
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
      -getScore(): float: 4.207692
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    "com.maroieqrwlk.unpin" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.maroieqrwlk.unpin"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.maroieqrwlk.unpin"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.maroieqrwlk.unpin&hl=en_US&gl=us"
      -getName(): string: "Pull the Pin"
      -getSummary(): ?string: "Can you reach the pinnacle?"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "7948217467540814816"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=7948217467540814816"
        -getName(): string: "Popcore Games"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/1f8VVY8jrDNERyXOSGm_f_yKfpSg3wiZYrBXuojLSpCTUdCpyIt9sA6aCOWa1EDUt3OK"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/1f8VVY8jrDNERyXOSGm_f_yKfpSg3wiZYrBXuojLSpCTUdCpyIt9sA6aCOWa1EDUt3OK=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/1f8VVY8jrDNERyXOSGm_f_yKfpSg3wiZYrBXuojLSpCTUdCpyIt9sA6aCOWa1EDUt3OK"
      }
      -getScore(): float: 3.4897423
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
array:1075 [
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
      -getScore(): float: 4.2857103
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
      -getScore(): float: 4.5814614
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
array:50 [
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
      -getScore(): float: 3.9453926
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
      -getScore(): float: 4.3361487
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
array:206 [
    "com.maroieqrwlk.unpin" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.maroieqrwlk.unpin"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.maroieqrwlk.unpin"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.maroieqrwlk.unpin&hl=en_US&gl=us"
      -getName(): string: "Pull the Pin"
      -getSummary(): ?string: "Can you reach the pinnacle?"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "7948217467540814816"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=7948217467540814816"
        -getName(): string: "Popcore Games"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/1f8VVY8jrDNERyXOSGm_f_yKfpSg3wiZYrBXuojLSpCTUdCpyIt9sA6aCOWa1EDUt3OK"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/1f8VVY8jrDNERyXOSGm_f_yKfpSg3wiZYrBXuojLSpCTUdCpyIt9sA6aCOWa1EDUt3OK=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/1f8VVY8jrDNERyXOSGm_f_yKfpSg3wiZYrBXuojLSpCTUdCpyIt9sA6aCOWa1EDUt3OK"
      }
      -getScore(): float: 3.4897423
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
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
      -getScore(): float: 3.9453926
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
array:404 [
    "com.ledflash.phonecall.colorcallerscreen" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.ledflash.phonecall.colorcallerscreen"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.ledflash.phonecall.colorcallerscreen"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.ledflash.phonecall.colorcallerscreen&hl=en_US&gl=us"
      -getName(): string: "Color Caller Screen:  LED Flash Alert & Flashlight"
      -getSummary(): ?string: "LED call flash and flashlight application"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "GoodTool"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=GoodTool"
        -getName(): string: "GoodTool"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/OWMr9ORfJq5R010ZH-AiIczsYf-w8tP5dQ3X0Hdk8A6AZsDRl3vQBVoxvQqlNsLqWKRp"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/OWMr9ORfJq5R010ZH-AiIczsYf-w8tP5dQ3X0Hdk8A6AZsDRl3vQBVoxvQqlNsLqWKRp=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/OWMr9ORfJq5R010ZH-AiIczsYf-w8tP5dQ3X0Hdk8A6AZsDRl3vQBVoxvQqlNsLqWKRp"
      }
      -getScore(): float: 1.5137615
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    "com.constellation.facefuture" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.constellation.facefuture"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.constellation.facefuture"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.constellation.facefuture&hl=en_US&gl=us"
      -getName(): string: "Face Secret"
      -getSummary(): ?string: "Face Secret"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "rich2020"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=rich2020"
        -getName(): string: "rich2020"
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
        -getUrl(): string: "https://lh3.googleusercontent.com/Gl7agzUItoi_i6PEn7jCkNkIoL_wI-5G1J3rbChM2JQBpMxbxELajHzEIffDT9cSKlM"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/Gl7agzUItoi_i6PEn7jCkNkIoL_wI-5G1J3rbChM2JQBpMxbxELajHzEIffDT9cSKlM=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/Gl7agzUItoi_i6PEn7jCkNkIoL_wI-5G1J3rbChM2JQBpMxbxELajHzEIffDT9cSKlM"
      }
      -getScore(): float: 2.85
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
      -getUrl(): string: "https://lh3.googleusercontent.com/NDrRfjlbFwrrGQAOkW5WoemB8QrBS6lp8c1C3gmXJXIITHBDS5LBnk5ypXySwudJiFQ=s700"
      -getFilename(): string: "screenshots/fc/c6/fcc6eb96e7090020bc3bb5e0bc8bd810.png"
      -getMimeType(): string: "image/png"
      -getExtension(): string: "png"
      -getWidth(): int: 394
      -getHeight(): int: 700
      -getFilesize(): int: 342036
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    1 => class Nelexa\GPlay\Model\ImageInfo {
      -getUrl(): string: "https://lh3.googleusercontent.com/VcMpf4HOZEGOZl11sHgJ85FTg006NG1lnnjqsUQEYfkJ6eog4wVi8aQktQI9zXnXoA=s700"
      -getFilename(): string: "screenshots/63/b2/63b277ac4edd774c0f0c8381532492ad.png"
      -getMimeType(): string: "image/png"
      -getExtension(): string: "png"
      -getWidth(): int: 394
      -getHeight(): int: 700
      -getFilesize(): int: 318706
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





[All documentation](Home)
