# Documentation

PHP library to scrape application data from the Google Play store.

[![Packagist Version](https://img.shields.io/packagist/v/nelexa/google-play-scraper.svg?style=popout&color=aa007f)](https://packagist.org/packages/nelexa/google-play-scraper) ![PHP from Packagist](https://img.shields.io/packagist/php-v/nelexa/google-play-scraper.svg?style=popout&color=d500a0) ![License](https://img.shields.io/packagist/l/nelexa/google-play-scraper.svg?style=popout&color=ff00bf)
[![Build Status](https://github.com/Ne-Lexa/google-play-scraper/workflows/build/badge.svg)](https://github.com/Ne-Lexa/google-play-scraper/actions) [![Build Status](https://scrutinizer-ci.com/g/Ne-Lexa/google-play-scraper/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Ne-Lexa/google-play-scraper/build-status/master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Ne-Lexa/google-play-scraper/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Ne-Lexa/google-play-scraper/?branch=master) [![Code Coverage](https://scrutinizer-ci.com/g/Ne-Lexa/google-play-scraper/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Ne-Lexa/google-play-scraper/?branch=master)

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
* [GPlayApps::getClusterApps](#gplayappsgetclusterapps-docs): Returns an iterator of applications from the Google Play store for the specified cluster page.
* [GPlayApps::getSimilarApps](#gplayappsgetsimilarapps-docs): Returns an array of similar applications with basic information about them in the Google Play store.
* [GPlayApps::getClusterPages](#gplayappsgetclusterpages-docs): Returns an iterator of cluster pages.
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
    -jsonSerialize(): array: …
  }
  -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
    -__toString(): string: "https://play-lh.googleusercontent.com/VSwHQjcAttxsLE47RuS4PqpC4LT7lCoSjE7Hx5AW_yCxtDvcnsHHvm5CTuL5BPN-uRTP"
    -getUrl(): string: "https://play-lh.googleusercontent.com/VSwHQjcAttxsLE47RuS4PqpC4LT7lCoSjE7Hx5AW_yCxtDvcnsHHvm5CTuL5BPN-uRTP"
    -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/VSwHQjcAttxsLE47RuS4PqpC4LT7lCoSjE7Hx5AW_yCxtDvcnsHHvm5CTuL5BPN-uRTP=s0"
    -getBinaryImageContent(): string: …
  }
  -getScore(): float: 4.5226836
  -getPriceText(): ?string: "209,99 грн"
  -isFree(): bool: false
  -jsonSerialize(): array: …
  -getDescription(): string: """
    Досліджуйте безкінечні світи та будуйте що завгодно: від простих хижок до розкішних замків. Грайте у творчому режимі з необмеженими ресурсами або вибе…
    """
  -isAutoTranslatedDescription(): bool: false
  -getTranslatedFromLocale(): ?string: null
  -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
    -__toString(): string: "https://play-lh.googleusercontent.com/yAtZnNL-9Eb5VYSsCaOC7KAsOVIJcY8mpKa0MoF-0HCL6b0OrFcBizURHywpuip-D6Y"
    -getUrl(): string: "https://play-lh.googleusercontent.com/yAtZnNL-9Eb5VYSsCaOC7KAsOVIJcY8mpKa0MoF-0HCL6b0OrFcBizURHywpuip-D6Y"
    -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/yAtZnNL-9Eb5VYSsCaOC7KAsOVIJcY8mpKa0MoF-0HCL6b0OrFcBizURHywpuip-D6Y=s0"
    -getBinaryImageContent(): string: …
  }
  -getScreenshots(): array: array:12 [
    0 => class Nelexa\GPlay\Model\GoogleImage {
      -__toString(): string: "https://play-lh.googleusercontent.com/2Qhsn-Uo3HjXKa5tJErKbSuoiHKO5M2gpD1dANPcHfLHFaEDUIOZpd5M0v_ois_c_n8"
      -getUrl(): string: "https://play-lh.googleusercontent.com/2Qhsn-Uo3HjXKa5tJErKbSuoiHKO5M2gpD1dANPcHfLHFaEDUIOZpd5M0v_ois_c_n8"
      -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/2Qhsn-Uo3HjXKa5tJErKbSuoiHKO5M2gpD1dANPcHfLHFaEDUIOZpd5M0v_ois_c_n8=s0"
      -getBinaryImageContent(): string: …
    }
    1 => class Nelexa\GPlay\Model\GoogleImage {
      -__toString(): string: "https://play-lh.googleusercontent.com/8ZAmvKPwrGfx-4eTBuU_h4-XlxLOcJM6zjMscVJUHHP8mb1ENo9sOMh9Ul4nTdGuW7M"
      -getUrl(): string: "https://play-lh.googleusercontent.com/8ZAmvKPwrGfx-4eTBuU_h4-XlxLOcJM6zjMscVJUHHP8mb1ENo9sOMh9Ul4nTdGuW7M"
      -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/8ZAmvKPwrGfx-4eTBuU_h4-XlxLOcJM6zjMscVJUHHP8mb1ENo9sOMh9Ul4nTdGuW7M=s0"
      -getBinaryImageContent(): string: …
    }
    …
  ]
  -getCategory(): ?Nelexa\GPlay\Model\Category: {
    -getId(): string: "GAME_ARCADE"
    -getName(): string: "Аркади"
    -isGamesCategory(): bool: true
    -isFamilyCategory(): bool: false
    -isApplicationCategory(): bool: false
    -asArray(): array: …
    -jsonSerialize(): array: …
  }
  -getCategoryFamily(): ?Nelexa\GPlay\Model\Category: null
  -getVideo(): ?Nelexa\GPlay\Model\Video: {
    -getImageUrl(): string: "https://play-lh.googleusercontent.com/yAtZnNL-9Eb5VYSsCaOC7KAsOVIJcY8mpKa0MoF-0HCL6b0OrFcBizURHywpuip-D6Y"
    -getVideoUrl(): string: "https://www.youtube.com/embed/KhPxEWUgZlg?ps=play&vq=large&rel=0&autohide=1&showinfo=0"
    -getYoutubeId(): ?string: "KhPxEWUgZlg"
    -asArray(): array: …
    -jsonSerialize(): array: …
  }
  -getRecentChanges(): ?string: """
    Що нового в 1.18.12:\n
    Різні виправлення помилок
    """
  -isEditorsChoice(): bool: false
  -getInstalls(): int: 40328325
  -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
    -getFiveStars(): int: 3584145
    -getFourStars(): int: 368668
    -getThreeStars(): int: 150635
    -getTwoStars(): int: 76037
    -getOneStar(): int: 311351
    -asArray(): array: …
    -jsonSerialize(): array: …
  }
  -getPrice(): float: 209.99
  -getCurrency(): string: "UAH"
  -isContainsIAP(): bool: true
  -getOffersIAPCost(): ?string: "9,36 грн – 1 349,99 грн за продукт"
  -isContainsAds(): bool: false
  -getSize(): ?string: null
  -getAppVersion(): ?string: "1.18.12.01"
  -getAndroidVersion(): ?string: "5.0 і новіших версій"
  -getMinAndroidVersion(): ?string: "5.0"
  -getContentRating(): ?string: "Від 7 років"
  -getPrivacyPoliceUrl(): ?string: "https://privacy.microsoft.com/en-us/privacystatement"
  -getReleased(): ?DateTimeInterface: @1313366400 {
    date: 2011-08-15T00:00:00+00:00
  }
  -getUpdated(): ?DateTimeInterface: @1644890219 {
    date: 2022-02-15T01:56:59+00:00
  }
  -getNumberVoters(): int: 4490983
  -getNumberReviews(): int: 14756
  -getReviews(): array: array:4 [
    0 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOG7XMyhwj7VRT8zAQ8VnIp31NeTn2taFtOKz9ExUR3tiMAIL7AFG3TtCoewoqsuliAQFHk7ei9uMTYEKhU"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe&reviewId=gp%3AAOqpTOG7XMyhwj7VRT8zAQ8VnIp31NeTn2taFtOKz9ExUR3tiMAIL7AFG3TtCoewoqs…"
      -getUserName(): string: "Kira Naumets"
      -getText(): string: "Гра просто супер!!!! Я давно її хотіла, але коли я заходжу в майнкрафт то спочатку мій скін стіва або алекса а потім все нормально."
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgNPA60Ok4r6qGM7B5GshrnzC5TL7y5CL0npenLHQ=s64"
        -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgNPA60Ok4r6qGM7B5GshrnzC5TL7y5CL0npenLHQ=s64"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgNPA60Ok4r6qGM7B5GshrnzC5TL7y5CL0npenLHQ=s0"
        -getBinaryImageContent(): string: …
      }
      -getDate(): ?DateTimeInterface: @1645125219 {
        date: 2022-02-17T19:13:39+00:00
      }
      -getScore(): int: 5
      -getCountLikes(): int: 828
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOHR-f11MFPOqd3fc9MH61C2ReUdFUtOoUkGknKBZOPSP-9WuK5fuWvZ5Fk0HG1Fwx0CFk54SXYU6rU5YMo"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe&reviewId=gp%3AAOqpTOHR-f11MFPOqd3fc9MH61C2ReUdFUtOoUkGknKBZOPSP-9WuK5fuWvZ5Fk0HG1…"
      -getUserName(): string: "Артем Шестак"
      -getText(): string: "Гра дуже крута мені нравится що можна грати на серверах гра дуже крута а якщо зайти на ноутбук то вобще отвал божки мені нравится що якщо приручити во…"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GiFmDR_D3agcilAMWtUTkoRblEKM9OrJ65_p8I7=s64"
        -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GiFmDR_D3agcilAMWtUTkoRblEKM9OrJ65_p8I7=s64"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GiFmDR_D3agcilAMWtUTkoRblEKM9OrJ65_p8I7=s0"
        -getBinaryImageContent(): string: …
      }
      -getDate(): ?DateTimeInterface: @1645336398 {
        date: 2022-02-20T05:53:18+00:00
      }
      -getScore(): int: 5
      -getCountLikes(): int: 0
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
      -asArray(): array: …
      -jsonSerialize(): array: …
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

$apps = $gplay->getAppsInfo([
    'chrome' => 'com.android.chrome',
    'minecraft' => new \Nelexa\GPlay\Model\AppId('com.mojang.minecraftpe', 'pt_BR', 'br'),
]);
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
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk"
        -getUrl(): string: "https://play-lh.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.126106
      -getPriceText(): ?string: ""
      -isFree(): bool: false
      -jsonSerialize(): array: …
      -getDescription(): string: """
        Google Chrome is a fast, easy to use, and secure web browser. Designed for Android, Chrome brings you personalized news articles, quick links to your …
        """
      -isAutoTranslatedDescription(): bool: false
      -getTranslatedFromLocale(): ?string: null
      -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/WPIJiEaY1kOU3-zogfv11ILu-mCaKhdq7hy2LXZ7JoLFTqGW3ZUXpRCTM7_dvPuBgB0"
        -getUrl(): string: "https://play-lh.googleusercontent.com/WPIJiEaY1kOU3-zogfv11ILu-mCaKhdq7hy2LXZ7JoLFTqGW3ZUXpRCTM7_dvPuBgB0"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/WPIJiEaY1kOU3-zogfv11ILu-mCaKhdq7hy2LXZ7JoLFTqGW3ZUXpRCTM7_dvPuBgB0=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:18 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/Usyjx1hHMLBCkpIpr56I74F1wYVncbZFTctqkDDgzfj1ABhCGu0GCg7pHwbyL-xhSV4"
          -getUrl(): string: "https://play-lh.googleusercontent.com/Usyjx1hHMLBCkpIpr56I74F1wYVncbZFTctqkDDgzfj1ABhCGu0GCg7pHwbyL-xhSV4"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/Usyjx1hHMLBCkpIpr56I74F1wYVncbZFTctqkDDgzfj1ABhCGu0GCg7pHwbyL-xhSV4=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/hQyOjY123zSEeZkXcyY9QvhBDd6iCkH5vL07gaoHhEKec-_bZyqD8IEbHpCJOQEDbA"
          -getUrl(): string: "https://play-lh.googleusercontent.com/hQyOjY123zSEeZkXcyY9QvhBDd6iCkH5vL07gaoHhEKec-_bZyqD8IEbHpCJOQEDbA"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/hQyOjY123zSEeZkXcyY9QvhBDd6iCkH5vL07gaoHhEKec-_bZyqD8IEbHpCJOQEDbA=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
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
      -getInstalls(): int: 10546228660
      -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
        -getFiveStars(): int: 23719921
        -getFourStars(): int: 4688358
        -getThreeStars(): int: 2543567
        -getTwoStars(): int: 1510499
        -getOneStar(): int: 4498126
        -asArray(): array: …
        -jsonSerialize(): array: …
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
      -getUpdated(): ?DateTimeInterface: @1645554664 {
        date: 2022-02-22T18:31:04+00:00
      }
      -getNumberVoters(): int: 36960498
      -getNumberReviews(): int: 864115
      -getReviews(): array: array:4 [
        0 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOGe8ai7cP4FaVAaYPRtiIcSPworf6t7APGHIWI2sdHbjJ0fHJAI0bjnoYPMr_27AQy3rKUvr5Xxj3NmgIk"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.android.chrome&reviewId=gp%3AAOqpTOGe8ai7cP4FaVAaYPRtiIcSPworf6t7APGHIWI2sdHbjJ0fHJAI0bjnoYPMr_27AQy…"
          -getUserName(): string: "Two Fisted Betty"
          -getText(): string: "Have been a VERY long time user and absolutely love Google and everything it has to offer. It's had it's glitches but all software has it's issues fro…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgW3jpEpXQL-PHX7dFUSGnmb0Ix7ZtNvV3w8SrarA=s64"
            -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgW3jpEpXQL-PHX7dFUSGnmb0Ix7ZtNvV3w8SrarA=s64"
            -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgW3jpEpXQL-PHX7dFUSGnmb0Ix7ZtNvV3w8SrarA=s0"
            -getBinaryImageContent(): string: …
          }
          -getDate(): ?DateTimeInterface: @1645673394 {
            date: 2022-02-24T03:29:54+00:00
          }
          -getScore(): int: 4
          -getCountLikes(): int: 0
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -asArray(): array: …
          -jsonSerialize(): array: …
        }
        1 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOGIgO0_ejFawLmyIyJt9YFuaauwHIsRq-bCyEEo7E41GTOqXM9STPrGmBjB_9O0ZuJgdGRhoG205Y_Dw-s"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.android.chrome&reviewId=gp%3AAOqpTOGIgO0_ejFawLmyIyJt9YFuaauwHIsRq-bCyEEo7E41GTOqXM9STPrGmBjB_9O0ZuJ…"
          -getUserName(): string: "Renae"
          -getText(): string: "I typically have no issues with the app, but this update seems to have broken it (though it was fine at first). For a few days now whenever I try to u…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GidFn_JBSyzJPZsa-usfRNWYeXEo3kEavIHjDiW6TM=s64"
            -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GidFn_JBSyzJPZsa-usfRNWYeXEo3kEavIHjDiW6TM=s64"
            -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GidFn_JBSyzJPZsa-usfRNWYeXEo3kEavIHjDiW6TM=s0"
            -getBinaryImageContent(): string: …
          }
          -getDate(): ?DateTimeInterface: @1644211105 {
            date: 2022-02-07T05:18:25+00:00
          }
          -getScore(): int: 1
          -getCountLikes(): int: 1655
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -asArray(): array: …
          -jsonSerialize(): array: …
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
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/VSwHQjcAttxsLE47RuS4PqpC4LT7lCoSjE7Hx5AW_yCxtDvcnsHHvm5CTuL5BPN-uRTP"
        -getUrl(): string: "https://play-lh.googleusercontent.com/VSwHQjcAttxsLE47RuS4PqpC4LT7lCoSjE7Hx5AW_yCxtDvcnsHHvm5CTuL5BPN-uRTP"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/VSwHQjcAttxsLE47RuS4PqpC4LT7lCoSjE7Hx5AW_yCxtDvcnsHHvm5CTuL5BPN-uRTP=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.5828166
      -getPriceText(): ?string: "R$ 37,99"
      -isFree(): bool: false
      -jsonSerialize(): array: …
      -getDescription(): string: """
        Explore mundos infinitos e construa desde simples casas a grandiosos castelos. Jogue no modo criativo com recursos ilimitados ou minere fundo no mundo…
        """
      -isAutoTranslatedDescription(): bool: false
      -getTranslatedFromLocale(): ?string: null
      -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/yAtZnNL-9Eb5VYSsCaOC7KAsOVIJcY8mpKa0MoF-0HCL6b0OrFcBizURHywpuip-D6Y"
        -getUrl(): string: "https://play-lh.googleusercontent.com/yAtZnNL-9Eb5VYSsCaOC7KAsOVIJcY8mpKa0MoF-0HCL6b0OrFcBizURHywpuip-D6Y"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/yAtZnNL-9Eb5VYSsCaOC7KAsOVIJcY8mpKa0MoF-0HCL6b0OrFcBizURHywpuip-D6Y=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:12 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/kwKiFARq0lUM_PrvxnOitjx_oh_0Z1_foxUU2AVttbj1Xiev7EbgPrYuWauvc0N9t4E"
          -getUrl(): string: "https://play-lh.googleusercontent.com/kwKiFARq0lUM_PrvxnOitjx_oh_0Z1_foxUU2AVttbj1Xiev7EbgPrYuWauvc0N9t4E"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/kwKiFARq0lUM_PrvxnOitjx_oh_0Z1_foxUU2AVttbj1Xiev7EbgPrYuWauvc0N9t4E=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/f00u4e1QwQGhdNLymA-_7LwQGRmX7a4kcTeMbLRFcRSWDQOeNAcLQcQByzcFnPdX8_Y"
          -getUrl(): string: "https://play-lh.googleusercontent.com/f00u4e1QwQGhdNLymA-_7LwQGRmX7a4kcTeMbLRFcRSWDQOeNAcLQcQByzcFnPdX8_Y"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/f00u4e1QwQGhdNLymA-_7LwQGRmX7a4kcTeMbLRFcRSWDQOeNAcLQcQByzcFnPdX8_Y=s0"
          -getBinaryImageContent(): string: …
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
        -jsonSerialize(): array: …
      }
      -getCategoryFamily(): ?Nelexa\GPlay\Model\Category: null
      -getVideo(): ?Nelexa\GPlay\Model\Video: {
        -getImageUrl(): string: "https://play-lh.googleusercontent.com/yAtZnNL-9Eb5VYSsCaOC7KAsOVIJcY8mpKa0MoF-0HCL6b0OrFcBizURHywpuip-D6Y"
        -getVideoUrl(): string: "https://www.youtube.com/embed/6Aaw7LzNQ88?ps=play&vq=large&rel=0&autohide=1&showinfo=0"
        -getYoutubeId(): ?string: "6Aaw7LzNQ88"
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getRecentChanges(): ?string: """
        Novidades na versão 1.18.12:\n
        Correção de diversos erros
        """
      -isEditorsChoice(): bool: true
      -getInstalls(): int: 40328325
      -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
        -getFiveStars(): int: 3696870
        -getFourStars(): int: 312998
        -getThreeStars(): int: 142202
        -getTwoStars(): int: 79491
        -getOneStar(): int: 259418
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getPrice(): float: 37.99
      -getCurrency(): string: "BRL"
      -isContainsIAP(): bool: true
      -getOffersIAPCost(): ?string: "R$ 1,33 – R$ 179,99 por item"
      -isContainsAds(): bool: false
      -getSize(): ?string: null
      -getAppVersion(): ?string: "1.18.12.01"
      -getAndroidVersion(): ?string: "5.0 ou superior"
      -getMinAndroidVersion(): ?string: "5.0"
      -getContentRating(): ?string: "Classificação Livre"
      -getPrivacyPoliceUrl(): ?string: "https://privacy.microsoft.com/en-us/privacystatement"
      -getReleased(): ?DateTimeInterface: @1313366400 {
        date: 2011-08-15T00:00:00+00:00
      }
      -getUpdated(): ?DateTimeInterface: @1644890219 {
        date: 2022-02-15T01:56:59+00:00
      }
      -getNumberVoters(): int: 4490990
      -getNumberReviews(): int: 269309
      -getReviews(): array: array:4 [
        0 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOFKhld3M6sJbWYOeQP_nhptO-nRWsDd5w0iB71Nk3j9bqKthoKytIojqnZz2VZIiApD4NE2o_jTCSfwXQg"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe&reviewId=gp%3AAOqpTOFKhld3M6sJbWYOeQP_nhptO-nRWsDd5w0iB71Nk3j9bqKthoKytIojqnZz2VZ…"
          -getUserName(): string: "Renald Lopes"
          -getText(): string: "Desenvolvedores incompetentes, conseguiram acabar com o jogo nessa atualização. Não renderiza, itens não dropam, mobs invisíveis, jogador não leva dan…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgcBwx1jdNjdC_cEXDJUFIKxV0skPiSzC3rmB8C=s64"
            -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgcBwx1jdNjdC_cEXDJUFIKxV0skPiSzC3rmB8C=s64"
            -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgcBwx1jdNjdC_cEXDJUFIKxV0skPiSzC3rmB8C=s0"
            -getBinaryImageContent(): string: …
          }
          -getDate(): ?DateTimeInterface: @1645796796 {
            date: 2022-02-25T13:46:36+00:00
          }
          -getScore(): int: 1
          -getCountLikes(): int: 0
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -asArray(): array: …
          -jsonSerialize(): array: …
        }
        1 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOGXWLBwfd5PTa_Tnp59qHst2-sOsTd2KaZGz-2AVfIaDeYJ0UT10DsD79wMM36U7qj8nMJ2yvMj7fHjhK0"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe&reviewId=gp%3AAOqpTOGXWLBwfd5PTa_Tnp59qHst2-sOsTd2KaZGz-2AVfIaDeYJ0UT10DsD79wMM36…"
          -getUserName(): string: "Maria Eduarda"
          -getText(): string: "Não tenho oque falar desse jogo,gráficos excelentes, não trava quase nunca! Esse app apesar do preço, vale muito a pena, comprei ele e não me arrepend…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GjKPq_b1nks0ltQrgqHBuu5yssEYH3gbcWTrgccHQ=s64"
            -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GjKPq_b1nks0ltQrgqHBuu5yssEYH3gbcWTrgccHQ=s64"
            -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GjKPq_b1nks0ltQrgqHBuu5yssEYH3gbcWTrgccHQ=s0"
            -getBinaryImageContent(): string: …
          }
          -getDate(): ?DateTimeInterface: @1645526625 {
            date: 2022-02-22T10:43:45+00:00
          }
          -getScore(): int: 5
          -getCountLikes(): int: 0
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -asArray(): array: …
          -jsonSerialize(): array: …
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
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk"
        -getUrl(): string: "https://play-lh.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.126106
      -getPriceText(): ?string: ""
      -isFree(): bool: false
      -jsonSerialize(): array: …
      -getDescription(): string: """
        Google Chrome is a fast, easy to use, and secure web browser. Designed for Android, Chrome brings you personalized news articles, quick links to your …
        """
      -isAutoTranslatedDescription(): bool: false
      -getTranslatedFromLocale(): ?string: null
      -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/WPIJiEaY1kOU3-zogfv11ILu-mCaKhdq7hy2LXZ7JoLFTqGW3ZUXpRCTM7_dvPuBgB0"
        -getUrl(): string: "https://play-lh.googleusercontent.com/WPIJiEaY1kOU3-zogfv11ILu-mCaKhdq7hy2LXZ7JoLFTqGW3ZUXpRCTM7_dvPuBgB0"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/WPIJiEaY1kOU3-zogfv11ILu-mCaKhdq7hy2LXZ7JoLFTqGW3ZUXpRCTM7_dvPuBgB0=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:18 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/Usyjx1hHMLBCkpIpr56I74F1wYVncbZFTctqkDDgzfj1ABhCGu0GCg7pHwbyL-xhSV4"
          -getUrl(): string: "https://play-lh.googleusercontent.com/Usyjx1hHMLBCkpIpr56I74F1wYVncbZFTctqkDDgzfj1ABhCGu0GCg7pHwbyL-xhSV4"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/Usyjx1hHMLBCkpIpr56I74F1wYVncbZFTctqkDDgzfj1ABhCGu0GCg7pHwbyL-xhSV4=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/hQyOjY123zSEeZkXcyY9QvhBDd6iCkH5vL07gaoHhEKec-_bZyqD8IEbHpCJOQEDbA"
          -getUrl(): string: "https://play-lh.googleusercontent.com/hQyOjY123zSEeZkXcyY9QvhBDd6iCkH5vL07gaoHhEKec-_bZyqD8IEbHpCJOQEDbA"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/hQyOjY123zSEeZkXcyY9QvhBDd6iCkH5vL07gaoHhEKec-_bZyqD8IEbHpCJOQEDbA=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
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
      -getInstalls(): int: 10546228660
      -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
        -getFiveStars(): int: 23719921
        -getFourStars(): int: 4688358
        -getThreeStars(): int: 2543567
        -getTwoStars(): int: 1510499
        -getOneStar(): int: 4498126
        -asArray(): array: …
        -jsonSerialize(): array: …
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
      -getUpdated(): ?DateTimeInterface: @1645554664 {
        date: 2022-02-22T18:31:04+00:00
      }
      -getNumberVoters(): int: 36960498
      -getNumberReviews(): int: 864115
      -getReviews(): array: array:4 [
        0 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOGe8ai7cP4FaVAaYPRtiIcSPworf6t7APGHIWI2sdHbjJ0fHJAI0bjnoYPMr_27AQy3rKUvr5Xxj3NmgIk"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.android.chrome&reviewId=gp%3AAOqpTOGe8ai7cP4FaVAaYPRtiIcSPworf6t7APGHIWI2sdHbjJ0fHJAI0bjnoYPMr_27AQy…"
          -getUserName(): string: "Two Fisted Betty"
          -getText(): string: "Have been a VERY long time user and absolutely love Google and everything it has to offer. It's had it's glitches but all software has it's issues fro…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgW3jpEpXQL-PHX7dFUSGnmb0Ix7ZtNvV3w8SrarA=s64"
            -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgW3jpEpXQL-PHX7dFUSGnmb0Ix7ZtNvV3w8SrarA=s64"
            -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgW3jpEpXQL-PHX7dFUSGnmb0Ix7ZtNvV3w8SrarA=s0"
            -getBinaryImageContent(): string: …
          }
          -getDate(): ?DateTimeInterface: @1645673394 {
            date: 2022-02-24T03:29:54+00:00
          }
          -getScore(): int: 4
          -getCountLikes(): int: 0
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -asArray(): array: …
          -jsonSerialize(): array: …
        }
        1 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOGIgO0_ejFawLmyIyJt9YFuaauwHIsRq-bCyEEo7E41GTOqXM9STPrGmBjB_9O0ZuJgdGRhoG205Y_Dw-s"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.android.chrome&reviewId=gp%3AAOqpTOGIgO0_ejFawLmyIyJt9YFuaauwHIsRq-bCyEEo7E41GTOqXM9STPrGmBjB_9O0ZuJ…"
          -getUserName(): string: "Renae"
          -getText(): string: "I typically have no issues with the app, but this update seems to have broken it (though it was fine at first). For a few days now whenever I try to u…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GidFn_JBSyzJPZsa-usfRNWYeXEo3kEavIHjDiW6TM=s64"
            -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GidFn_JBSyzJPZsa-usfRNWYeXEo3kEavIHjDiW6TM=s64"
            -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GidFn_JBSyzJPZsa-usfRNWYeXEo3kEavIHjDiW6TM=s0"
            -getBinaryImageContent(): string: …
          }
          -getDate(): ?DateTimeInterface: @1644211105 {
            date: 2022-02-07T05:18:25+00:00
          }
          -getScore(): int: 1
          -getCountLikes(): int: 1655
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
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
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk"
        -getUrl(): string: "https://play-lh.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/KwUBNPbMTk9jDXYS2AeX3illtVRTkrKVh5xR1Mg4WHd0CG2tV4mrh1z3kXi5z_warlk=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.126106
      -getPriceText(): ?string: ""
      -isFree(): bool: false
      -jsonSerialize(): array: …
      -getDescription(): string: """
        Google Chrome est un navigateur Web rapide, simple d'utilisation et sécurisé. Conçu pour Android, Chrome vous permet de consulter une sélection person…
        """
      -isAutoTranslatedDescription(): bool: false
      -getTranslatedFromLocale(): ?string: null
      -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/rcUvNWE0WrExleYaz3l2XS_8tMOJLtdNTzHz9AXLJDPrkUZqQcY-cMxSSRUOWJteNq4"
        -getUrl(): string: "https://play-lh.googleusercontent.com/rcUvNWE0WrExleYaz3l2XS_8tMOJLtdNTzHz9AXLJDPrkUZqQcY-cMxSSRUOWJteNq4"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/rcUvNWE0WrExleYaz3l2XS_8tMOJLtdNTzHz9AXLJDPrkUZqQcY-cMxSSRUOWJteNq4=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:18 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/BkLzaEgIaYIViqMAMnZnWrl9RcZouqH8mHstYVARFP3MYNZB6VeZJGJf3S7Xe_VUuyzt"
          -getUrl(): string: "https://play-lh.googleusercontent.com/BkLzaEgIaYIViqMAMnZnWrl9RcZouqH8mHstYVARFP3MYNZB6VeZJGJf3S7Xe_VUuyzt"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/BkLzaEgIaYIViqMAMnZnWrl9RcZouqH8mHstYVARFP3MYNZB6VeZJGJf3S7Xe_VUuyzt=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/tY1kWcWsc5FU3AJJ5ZzQSfsIqw9IGqejF5j75rh4wA9G0KtcEa_0ffZStfWtF_Zoi1U"
          -getUrl(): string: "https://play-lh.googleusercontent.com/tY1kWcWsc5FU3AJJ5ZzQSfsIqw9IGqejF5j75rh4wA9G0KtcEa_0ffZStfWtF_Zoi1U"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/tY1kWcWsc5FU3AJJ5ZzQSfsIqw9IGqejF5j75rh4wA9G0KtcEa_0ffZStfWtF_Zoi1U=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
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
      -getInstalls(): int: 10546228660
      -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
        -getFiveStars(): int: 23719921
        -getFourStars(): int: 4688358
        -getThreeStars(): int: 2543567
        -getTwoStars(): int: 1510499
        -getOneStar(): int: 4498126
        -asArray(): array: …
        -jsonSerialize(): array: …
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
      -getUpdated(): ?DateTimeInterface: @1645554664 {
        date: 2022-02-22T18:31:04+00:00
      }
      -getNumberVoters(): int: 36960498
      -getNumberReviews(): int: 864115
      -getReviews(): array: array:4 [
        0 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOF8R72xCrYXTAeso0BgPKXKbou5TR63V5pivkPPZc58NgQK74nIP9jFLw4Tih7ByxkPdwUSlUh45_UQxcU"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.android.chrome&reviewId=gp%3AAOqpTOF8R72xCrYXTAeso0BgPKXKbou5TR63V5pivkPPZc58NgQK74nIP9jFLw4Tih7Byxk…"
          -getUserName(): string: "Atmosphere"
          -getText(): string: "Impossible de télécharger la mise à jour . Cependant Chrome a été toujours été mon navigateur privilégié, j'apprécie beaucoup sa rapidité."
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GhVcyqo6-rX6DRa529Ke5PcSPd7ZW2YxJDFmMYGQQ=s64"
            -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GhVcyqo6-rX6DRa529Ke5PcSPd7ZW2YxJDFmMYGQQ=s64"
            -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GhVcyqo6-rX6DRa529Ke5PcSPd7ZW2YxJDFmMYGQQ=s0"
            -getBinaryImageContent(): string: …
          }
          -getDate(): ?DateTimeInterface: @1644365527 {
            date: 2022-02-09T00:12:07+00:00
          }
          -getScore(): int: 3
          -getCountLikes(): int: 0
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: {
            -getDate(): DateTimeInterface: @1644398667 {
              date: 2022-02-09T09:24:27+00:00
            }
            -getText(): string: "Bonjour et merci de nous avoir contactés ! Nous sommes au courant des soucis concernant la mise à jour de l'application. Nous avons partagé plus d'inf…"
            -asArray(): array: …
            -jsonSerialize(): array: …
          }
          -asArray(): array: …
          -jsonSerialize(): array: …
        }
        1 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOHzEutq7lmiHmWZ5uu8iRoBTRmLmwPtP5dQlvR1myIuUHObWGgKsjbsACBz1Abu_sqJ4RGNwAFWBh4vovc"
          -getUrl(): string: "https://play.google.com/store/apps/details?id=com.android.chrome&reviewId=gp%3AAOqpTOHzEutq7lmiHmWZ5uu8iRoBTRmLmwPtP5dQlvR1myIuUHObWGgKsjbsACBz1Abu_sq…"
          -getUserName(): string: "Said said"
          -getText(): string: "Pour une meilleure navigation je vous conseille firefox largement le meilleur navigateur sur Android en plus il supporte les modules complémentaires c…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgpjKVUrdtrAvjpqlQfEyMZLI7P3DDkI_ekIYPHMg=s64"
            -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgpjKVUrdtrAvjpqlQfEyMZLI7P3DDkI_ekIYPHMg=s64"
            -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgpjKVUrdtrAvjpqlQfEyMZLI7P3DDkI_ekIYPHMg=s0"
            -getBinaryImageContent(): string: …
          }
          -getDate(): ?DateTimeInterface: @1639445855 {
            date: 2021-12-14T01:37:35+00:00
          }
          -getScore(): int: 1
          -getCountLikes(): int: 62
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
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

$exists = $gplay->existsApps([
    'maps' => 'com.google.android.apps.maps',
    'docs' => new \Nelexa\GPlay\Model\AppId('com.google.android.apps.docs'),
    /* 0 => */ 'com.google.android.apps.googleassistant',
    /* 1 => */ 'com.google.android.keep',
    'invalid' => 'com.android.test',
    'com.google.android.apps.authenticator2' => 'com.google.android.apps.authenticator2',
]);
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
      -getId(): string: "gp:AOqpTOGobbFWlkxiu3je21EbN0izjZYCj888IJdkBfysY5aNS-hIsIsFVc_6yDusSX6MHpWUQsNT-MdlqPgMKG8"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=ru.yandex.metro&reviewId=gp%3AAOqpTOGobbFWlkxiu3je21EbN0izjZYCj888IJdkBfysY5aNS-hIsIsFVc_6yDusSX6MHpWUQs…"
      -getUserName(): string: "Татьяна Борисова"
      -getText(): string: "Удобное приложение. Всё варианты пересадок и время в пути показывает, временные закрытия станций - тоже. Это про Московское метро. Но схемы есть и дру…"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/a/AATXAJz1CMv1CYyC64JggEWAkCwXOZBlgU4DakbQKRLo=s64"
        -getUrl(): string: "https://play-lh.googleusercontent.com/a/AATXAJz1CMv1CYyC64JggEWAkCwXOZBlgU4DakbQKRLo=s64"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a/AATXAJz1CMv1CYyC64JggEWAkCwXOZBlgU4DakbQKRLo=s0"
        -getBinaryImageContent(): string: …
      }
      -getDate(): ?DateTimeInterface: @1645609417 {
        date: 2022-02-23T09:43:37+00:00
      }
      -getScore(): int: 5
      -getCountLikes(): int: 0
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: {
        -getDate(): DateTimeInterface: @1645612425 {
          date: 2022-02-23T10:33:45+00:00
        }
        -getText(): string: "Татьяна, спасибо, что пользуетесь сервисами Яндекса! Мы очень ценим ваше доверие и рады, что приложение оказалось полезным для вас."
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOGYqhgzbm47kLyxoHYlFHzF2v4k94k7i0ySzz43DWTQPIr5pLXrNBA5UL78PD0sk2stVg71MWKay-Jmpl8"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=ru.yandex.metro&reviewId=gp%3AAOqpTOGYqhgzbm47kLyxoHYlFHzF2v4k94k7i0ySzz43DWTQPIr5pLXrNBA5UL78PD0sk2stVg…"
      -getUserName(): string: "Анна Батлер"
      -getText(): string: "Очень удобное приложение , показывает в какой вагон удобнее сесть для перехода на другую ветку, сколько времени займет переход , в том числе и наземны…"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/a/AATXAJySgKDLGlL5yp4zPkFC6CnajA2YXlXxsQNig7jh=s64"
        -getUrl(): string: "https://play-lh.googleusercontent.com/a/AATXAJySgKDLGlL5yp4zPkFC6CnajA2YXlXxsQNig7jh=s64"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a/AATXAJySgKDLGlL5yp4zPkFC6CnajA2YXlXxsQNig7jh=s0"
        -getBinaryImageContent(): string: …
      }
      -getDate(): ?DateTimeInterface: @1645708636 {
        date: 2022-02-24T13:17:16+00:00
      }
      -getScore(): int: 5
      -getCountLikes(): int: 0
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: {
        -getDate(): DateTimeInterface: @1645740299 {
          date: 2022-02-24T22:04:59+00:00
        }
        -getText(): string: "Анна, спасибо вам за оценку! Мы рады, что вам нравится наше приложение :)"
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -asArray(): array: …
      -jsonSerialize(): array: …
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
    -__toString(): string: "https://play-lh.googleusercontent.com/a/AATXAJziqSeotXUfYPXZWqlg_qfxBBER-0bPb4Tt-in8=s64"
    -getUrl(): string: "https://play-lh.googleusercontent.com/a/AATXAJziqSeotXUfYPXZWqlg_qfxBBER-0bPb4Tt-in8=s64"
    -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a/AATXAJziqSeotXUfYPXZWqlg_qfxBBER-0bPb4Tt-in8=s0"
    -getBinaryImageContent(): string: …
  }
  -getDate(): ?DateTimeInterface: @1581236842 {
    date: 2020-02-09T08:27:22+00:00
  }
  -getScore(): int: 1
  -getCountLikes(): int: 8
  -getReply(): ?Nelexa\GPlay\Model\ReplyReview: {
    -getDate(): DateTimeInterface: @1581348449 {
      date: 2020-02-10T15:27:29+00:00
    }
    -getText(): string: """
      Hello, \n
      Thank you for letting us know, please also provide our support team this information allowing us to investigate it and assist you as soon as p…
      """
    -asArray(): array: …
    -jsonSerialize(): array: …
  }
  -asArray(): array: …
  -jsonSerialize(): array: …
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
        -__toString(): string: "https://play-lh.googleusercontent.com/pkKXoPl5q7n8T0s7KREtdvUZn1PLRgx-Ox0t4tkO8af4JpgGbyAxLBTsvEKKBCjwBACQsZisSYNmHPGbBA"
        -getUrl(): string: "https://play-lh.googleusercontent.com/pkKXoPl5q7n8T0s7KREtdvUZn1PLRgx-Ox0t4tkO8af4JpgGbyAxLBTsvEKKBCjwBACQsZisSYNmHPGbBA"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/pkKXoPl5q7n8T0s7KREtdvUZn1PLRgx-Ox0t4tkO8af4JpgGbyAxLBTsvEKKBCjwBACQsZisSYNmHPGbBA=s0"
        -getBinaryImageContent(): string: …
      }
      -getPermissions(): array: array:2 [
        0 => "view network connections"
        1 => "full network access"
      ]
      -asArray(): array: …
      -jsonSerialize(): array: …
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
array:53 [
    0 => class Nelexa\GPlay\Model\Category {
      -getId(): string: "ART_AND_DESIGN"
      -getName(): string: "Art & Design"
      -isGamesCategory(): bool: false
      -isFamilyCategory(): bool: false
      -isApplicationCategory(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\Category {
      -getId(): string: "AUTO_AND_VEHICLES"
      -getName(): string: "Auto & Vehicles"
      -isGamesCategory(): bool: false
      -isFamilyCategory(): bool: false
      -isApplicationCategory(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
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
    "en_US" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art & Design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto & Vehicles"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "pt_PT" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "FOOD_AND_DRINK"
        -getName(): string: "Alimentação e bebida"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Apps de relógio"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "pt_BR" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Apps para smartwatch"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Arte e design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "fr_FR" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "NEWS_AND_MAGAZINES"
        -getName(): string: "Actualités et magazines"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Applications montre"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
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
    "af" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BUSINESS"
        -getName(): string: "Besigheid"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "LIBRARIES_AND_DEMO"
        -getName(): string: "Biblioteke en demonstrasies"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "am" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "MEDICAL"
        -getName(): string: "ሕክምና"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "መሣሪያዎች"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "ar" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "VIDEO_PLAYERS"
        -getName(): string: "أدوات الفيديو"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BUSINESS"
        -getName(): string: "أعمال"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "az_AZ" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "Alətlər"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Avto və Nəqliyyat Vasitələri"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "be" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "Інструменты"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "EDUCATION"
        -getName(): string: "Адукацыя"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "bg" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "LIBRARIES_AND_DEMO"
        -getName(): string: "Библиотеки и демонстрации"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BUSINESS"
        -getName(): string: "Бизнес"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "bn_BD" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "FINANCE"
        -getName(): string: "Finance"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "SHOPPING"
        -getName(): string: "Shopping"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "ca" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Aplicacions de rellotge"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art i disseny"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "cs_CZ" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Aplikace pro hodinky"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auta a doprava"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "da_DK" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "EVENTS"
        -getName(): string: "Begivenheder"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "LIBRARIES_AND_DEMO"
        -getName(): string: "Biblioteker og demoer"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "de_DE" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Autos & Fahrzeuge"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BEAUTY"
        -getName(): string: "Beauty"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "el_GR" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "SHOPPING"
        -getName(): string: "Αγορές"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "SPORTS"
        -getName(): string: "Αθλήματα"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "en_AU" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art & Design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto & Vehicles"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "en_CA" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art & Design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto & Vehicles"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "en_GB" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art & Design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto & Vehicles"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "en_IN" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art & Design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto & Vehicles"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "en_SG" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art & Design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto & Vehicles"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "en_US" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art & Design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto & Vehicles"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "en_ZA" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Art & Design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto & Vehicles"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "es_419" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "VIDEO_PLAYERS"
        -getName(): string: "Aplicaciones de video"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Apps de reloj"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "es_ES" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Aplicaciones de reloj"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "VIDEO_PLAYERS"
        -getName(): string: "Aplicaciones de vídeo"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "es_US" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "VIDEO_PLAYERS"
        -getName(): string: "Aplicaciones de video"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Apps de reloj"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "et" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Autod ja sõidukid"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "LIFESTYLE"
        -getName(): string: "Elustiil"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "eu_ES" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ENTERTAINMENT"
        -getName(): string: "Aisia"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "NEWS_AND_MAGAZINES"
        -getName(): string: "Albisteak eta aldizkariak"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "fa" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "WEATHER"
        -getName(): string: "آب و هوا"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "EDUCATION"
        -getName(): string: "آموزش"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "fi_FI" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Autot ja ajoneuvot"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "LIBRARIES_AND_DEMO"
        -getName(): string: "Demot"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "fil" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ENTERTAINMENT"
        -getName(): string: "Aliwan"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "HOUSE_AND_HOME"
        -getName(): string: "Bahay at Tahanan"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "fr_CA" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "NEWS_AND_MAGAZINES"
        -getName(): string: "Actualités et magazines"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Applications pour montre intelligente"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "fr_FR" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "NEWS_AND_MAGAZINES"
        -getName(): string: "Actualités et magazines"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Applications montre"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "gl_ES" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Aplicacións de reloxo"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Arte e deseño"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "hi_IN" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "FINANCE"
        -getName(): string: "Finance"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "MAPS_AND_NAVIGATION"
        -getName(): string: "Maps और नेविगेशन ऐप्स"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "hr" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "Alati"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Aplikacija za sat"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "hu_HU" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Autók és járművek"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "HEALTH_AND_FITNESS"
        -getName(): string: "Egészség és fitnesz"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "hy_AM" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "HOUSE_AND_HOME"
        -getName(): string: "Ամեն ինչ տան համար"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PERSONALIZATION"
        -getName(): string: "Անհատականացում"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "id" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "Alat "
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Aplikasi smartwatch"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "is_IS" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ENTERTAINMENT"
        -getName(): string: "Afþreying"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PRODUCTIVITY"
        -getName(): string: "Aðstoð"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "it_IT" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BUSINESS"
        -getName(): string: "Affari"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "App dell'orologio"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "iw_IL" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "FOOD_AND_DRINK"
        -getName(): string: "אוכל ומשקאות"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "EVENTS"
        -getName(): string: "אירועים"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "ja_JP" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "アート＆デザイン"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "EVENTS"
        -getName(): string: "イベント"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "ka_GE" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Watch აპები"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "ავტომობილები და სატრანსპორტო საშუალებები"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "kk" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Авто және көліктер"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "WEATHER"
        -getName(): string: "Ауа райы"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "km_KH" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "VIDEO_PLAYERS"
        -getName(): string: "កម្មវិធីចាក់ និងកែវីដេអូ"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "កម្មវិធីនាឡិកា"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "kn_IN" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "FINANCE"
        -getName(): string: "Finance"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "MAPS_AND_NAVIGATION"
        -getName(): string: "Maps ಮತ್ತು ನ್ಯಾವಿಗೇಶನ್"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "ko_KR" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "HEALTH_AND_FITNESS"
        -getName(): string: "건강/운동"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "EDUCATION"
        -getName(): string: "교육"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "ky_KG" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "WEATHER"
        -getName(): string: "Аба ырайы"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Авто жана унаалар"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "lo_LA" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "COMICS"
        -getName(): string: "ກາຕູນ"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "SHOPPING"
        -getName(): string: "ການຊື້ເຄື່ອງ"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "lt" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "SHOPPING"
        -getName(): string: "Apsipirkimas"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Automobiliai ir transporto priemonės"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "lv" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "LIBRARIES_AND_DEMO"
        -getName(): string: "Bibliotēkas un demoversijas"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "mk_MK" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Автомобили и возила"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "Алатки"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "ml_IN" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "FINANCE"
        -getName(): string: "Finance"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "SHOPPING"
        -getName(): string: "Shopping"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "mn_MN" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Авто, тээврийн хэрэгсэл"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "LIFESTYLE"
        -getName(): string: "Амьдралын хэв маяг"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "mr_IN" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "FINANCE"
        -getName(): string: "Finance"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "HEALTH_AND_FITNESS"
        -getName(): string: "आरोग्य व स्वास्थ्य"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "ms" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "EVENTS"
        -getName(): string: "Acara"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "Alatan"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "my_MM" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "ကားနှင့်ယာဉ်များ"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "ကိရိယာများ"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "ne_NP" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "अटो र सवारीसाधनहरू"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PRODUCTIVITY"
        -getName(): string: "उत्पादकत्व"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "nl_NL" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Auto's en voertuigen"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BEAUTY"
        -getName(): string: "Beauty"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "no_NO" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "EVENTS"
        -getName(): string: "Arrangementer"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PARENTING"
        -getName(): string: "Barn og foreldre"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "pl_PL" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Aplikacje na zegarki"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "LIBRARIES_AND_DEMO"
        -getName(): string: "Biblioteki i wersje demo"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "pt_BR" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Apps para smartwatch"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ART_AND_DESIGN"
        -getName(): string: "Arte e design"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "pt_PT" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "FOOD_AND_DRINK"
        -getName(): string: "Alimentação e bebida"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Apps de relógio"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "ro" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BUSINESS"
        -getName(): string: "Afacere"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Aplicații pentru ceas"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "ru_RU" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Автомобили и транспорт"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BUSINESS"
        -getName(): string: "Бизнес"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "si_LK" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "watch යෙදුම"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "EDUCATION"
        -getName(): string: "අධ්‍යාපනය"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "sk" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Aplikácie pre hodinky"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Autá a doprava"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "sl" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Aplikacije za uro"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "Avtomobili in vozila"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "sr" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "Алатке"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Апликације за сат"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "sv_SE" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PERSONALIZATION"
        -getName(): string: "Anpassning"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "ANDROID_WEAR"
        -getName(): string: "Appar för smartklockor"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "sw" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "HEALTH_AND_FITNESS"
        -getName(): string: "Afya na Siha"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PERSONALIZATION"
        -getName(): string: "Badilisha upendavyo"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "ta_IN" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "FINANCE"
        -getName(): string: "Finance"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BEAUTY"
        -getName(): string: "அழகு"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "te_IN" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "AUTO_AND_VEHICLES"
        -getName(): string: "ఆటో & వాహనాలు"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "HEALTH_AND_FITNESS"
        -getName(): string: "ఆరోగ్యం & దృఢత్వం"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "th" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PERSONALIZATION"
        -getName(): string: "การกำหนดค่าส่วนบุคคล"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PHOTOGRAPHY"
        -getName(): string: "การถ่ายภาพ"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "tr_TR" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "SHOPPING"
        -getName(): string: "Alışveriş"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "Araçlar"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "uk" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "TOOLS"
        -getName(): string: "Інструменти"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "FOOD_AND_DRINK"
        -getName(): string: "Їжа та напої"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "vi" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "MAPS_AND_NAVIGATION"
        -getName(): string: "Bản đồ và dẫn đường"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PERSONALIZATION"
        -getName(): string: "Cá nhân hóa"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "zh_CN" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PERSONALIZATION"
        -getName(): string: "个性定制"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "SPORTS"
        -getName(): string: "体育"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "zh_HK" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PERSONALIZATION"
        -getName(): string: "個人化"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "HEALTH_AND_FITNESS"
        -getName(): string: "健康與健身"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "zh_TW" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "PERSONALIZATION"
        -getName(): string: "個人化"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "HEALTH_AND_FITNESS"
        -getName(): string: "健康塑身"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      …
    ]
    "zu" => array:53 [
      0 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "BOOKS_AND_REFERENCE"
        -getName(): string: "Amabhuku & Amaphatho"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      1 => class Nelexa\GPlay\Model\Category {
        -getId(): string: "COMICS"
        -getName(): string: "Amahlaya"
        -isGamesCategory(): bool: false
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: true
        -asArray(): array: …
        -jsonSerialize(): array: …
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
    -__toString(): string: "https://play-lh.googleusercontent.com/6UgEjh8Xuts4nwdWzTnWH8QtLuHqRMUB7dp24JYVE2xcYzq4HA8hFfcAbU-R-PC_9uA1"
    -getUrl(): string: "https://play-lh.googleusercontent.com/6UgEjh8Xuts4nwdWzTnWH8QtLuHqRMUB7dp24JYVE2xcYzq4HA8hFfcAbU-R-PC_9uA1"
    -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/6UgEjh8Xuts4nwdWzTnWH8QtLuHqRMUB7dp24JYVE2xcYzq4HA8hFfcAbU-R-PC_9uA1=s0"
    -getBinaryImageContent(): string: …
  }
  -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
    -__toString(): string: "https://play-lh.googleusercontent.com/1-hPxafOxdYpYZEOKzNIkSP43HXCNftVJVttoo4ucl7rsMASXW3Xr6GlXURCubE1tA"
    -getUrl(): string: "https://play-lh.googleusercontent.com/1-hPxafOxdYpYZEOKzNIkSP43HXCNftVJVttoo4ucl7rsMASXW3Xr6GlXURCubE1tA"
    -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/1-hPxafOxdYpYZEOKzNIkSP43HXCNftVJVttoo4ucl7rsMASXW3Xr6GlXURCubE1tA=s0"
    -getBinaryImageContent(): string: …
  }
  -getEmail(): ?string: null
  -getAddress(): ?string: null
  -asArray(): array: …
  -jsonSerialize(): array: …
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
        -__toString(): string: "https://play-lh.googleusercontent.com/6UgEjh8Xuts4nwdWzTnWH8QtLuHqRMUB7dp24JYVE2xcYzq4HA8hFfcAbU-R-PC_9uA1"
        -getUrl(): string: "https://play-lh.googleusercontent.com/6UgEjh8Xuts4nwdWzTnWH8QtLuHqRMUB7dp24JYVE2xcYzq4HA8hFfcAbU-R-PC_9uA1"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/6UgEjh8Xuts4nwdWzTnWH8QtLuHqRMUB7dp24JYVE2xcYzq4HA8hFfcAbU-R-PC_9uA1=s0"
        -getBinaryImageContent(): string: …
      }
      -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/1-hPxafOxdYpYZEOKzNIkSP43HXCNftVJVttoo4ucl7rsMASXW3Xr6GlXURCubE1tA"
        -getUrl(): string: "https://play-lh.googleusercontent.com/1-hPxafOxdYpYZEOKzNIkSP43HXCNftVJVttoo4ucl7rsMASXW3Xr6GlXURCubE1tA"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/1-hPxafOxdYpYZEOKzNIkSP43HXCNftVJVttoo4ucl7rsMASXW3Xr6GlXURCubE1tA=s0"
        -getBinaryImageContent(): string: …
      }
      -getEmail(): ?string: null
      -getAddress(): ?string: null
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    "es_ES" => class Nelexa\GPlay\Model\Developer {
      -getId(): string: "5700313618786177705"
      -getUrl(): string: "https://play.google.com/store/apps/dev?id=5700313618786177705"
      -getName(): string: "Google LLC"
      -getDescription(): ?string: "Apps from Google to help you get the most out of your day, across all your devices."
      -getWebsite(): ?string: null
      -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/6UgEjh8Xuts4nwdWzTnWH8QtLuHqRMUB7dp24JYVE2xcYzq4HA8hFfcAbU-R-PC_9uA1"
        -getUrl(): string: "https://play-lh.googleusercontent.com/6UgEjh8Xuts4nwdWzTnWH8QtLuHqRMUB7dp24JYVE2xcYzq4HA8hFfcAbU-R-PC_9uA1"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/6UgEjh8Xuts4nwdWzTnWH8QtLuHqRMUB7dp24JYVE2xcYzq4HA8hFfcAbU-R-PC_9uA1=s0"
        -getBinaryImageContent(): string: …
      }
      -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/1-hPxafOxdYpYZEOKzNIkSP43HXCNftVJVttoo4ucl7rsMASXW3Xr6GlXURCubE1tA"
        -getUrl(): string: "https://play-lh.googleusercontent.com/1-hPxafOxdYpYZEOKzNIkSP43HXCNftVJVttoo4ucl7rsMASXW3Xr6GlXURCubE1tA"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/1-hPxafOxdYpYZEOKzNIkSP43HXCNftVJVttoo4ucl7rsMASXW3Xr6GlXURCubE1tA=s0"
        -getBinaryImageContent(): string: …
      }
      -getEmail(): ?string: null
      -getAddress(): ?string: null
      -asArray(): array: …
      -jsonSerialize(): array: …
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
array:143 [
    0 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.google.android.apps.nbu.paisa.user"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.nbu.paisa.user"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.nbu.paisa.user&hl=en_US&gl=us"
      -getName(): string: "Google Pay: Save, Pay, Manage"
      -getSummary(): ?string: "Send money, shop, pay bills & earn rewards — plus a secure mobile wallet"
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
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/HArtbyi53u0jnqhnnxkQnMx9dHOERNcprZyKnInd2nrfM7Wd9ivMNTiz7IJP6-mSpwk"
        -getUrl(): string: "https://play-lh.googleusercontent.com/HArtbyi53u0jnqhnnxkQnMx9dHOERNcprZyKnInd2nrfM7Wd9ivMNTiz7IJP6-mSpwk"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/HArtbyi53u0jnqhnnxkQnMx9dHOERNcprZyKnInd2nrfM7Wd9ivMNTiz7IJP6-mSpwk=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.088699
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.google.android.apps.authenticator2"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en_US&gl=us"
      -getName(): string: "Google Authenticator"
      -getSummary(): ?string: "Enable 2-step verification to protect your account from hijacking."
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
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/HPc5gptPzRw3wFhJE1ZCnTqlvEvuVFBAsV9etfouOhdRbkp-zNtYTzKUmUVPERSZ_lAL"
        -getUrl(): string: "https://play-lh.googleusercontent.com/HPc5gptPzRw3wFhJE1ZCnTqlvEvuVFBAsV9etfouOhdRbkp-zNtYTzKUmUVPERSZ_lAL"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/HPc5gptPzRw3wFhJE1ZCnTqlvEvuVFBAsV9etfouOhdRbkp-zNtYTzKUmUVPERSZ_lAL=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 3.8315983
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    …
  ]
```

</details>



### GPlayApps::getClusterApps [[docs]](classes/GPlayApps/gplayapps.getclusterapps.md)
Returns an iterator of applications from the Google Play store for the specified cluster page.

**Example 1. Fetch all apps by cluster page**
```php
$clusterPage = 'https://play.google.com/store/apps/collection/cluster?clp=ogooCAEaHAoWcmVjc190b3BpY19vbDFxdl9tODloVRA7GAMqAggBUgIIAg%3D%3D:S:ANO1ljLnmTE&gsr=CiuiCigIARocChZyZWNzX3RvcGljX29sMXF2X204OWhVEDsYAyoCCAFSAggC:S:ANO1ljJBunU';

$apps = iterator_to_array($gplay->getClusterApps($clusterPage));
```
<details>
  <summary>Results</summary>

```php
array:170 [
    0 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.netflix.mediaclient"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.netflix.mediaclient"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.netflix.mediaclient&hl=en_US&gl=us"
      -getName(): string: "Netflix"
      -getSummary(): ?string: "Netflix is the leading subscription service for watching TV episodes and movies."
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "Netflix, Inc."
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=Netflix,+Inc."
        -getName(): string: "Netflix, Inc."
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/TBRwjS_qfJCSj1m7zZB93FnpJM5fSpMA_wUlFDLxWAb45T9RmwBvQd5cWR5viJJOhkI"
        -getUrl(): string: "https://play-lh.googleusercontent.com/TBRwjS_qfJCSj1m7zZB93FnpJM5fSpMA_wUlFDLxWAb45T9RmwBvQd5cWR5viJJOhkI"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/TBRwjS_qfJCSj1m7zZB93FnpJM5fSpMA_wUlFDLxWAb45T9RmwBvQd5cWR5viJJOhkI=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.4724298
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.t11.skyviewfree"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.t11.skyviewfree"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.t11.skyviewfree&hl=en_US&gl=us"
      -getName(): string: "SkyView® Lite"
      -getSummary(): ?string: "SkyView®, an augmented reality space app, brings stargazing to everyone!"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "Terminal Eleven"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=Terminal+Eleven"
        -getName(): string: "Terminal Eleven"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/PpPV2Ug-Cr05xLKQdZJoA9quSanR3Y6L1TtL80ppJgIpRkIU6v_H0UJoDR4VCE4m38RQ"
        -getUrl(): string: "https://play-lh.googleusercontent.com/PpPV2Ug-Cr05xLKQdZJoA9quSanR3Y6L1TtL80ppJgIpRkIU6v_H0UJoDR4VCE4m38RQ"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/PpPV2Ug-Cr05xLKQdZJoA9quSanR3Y6L1TtL80ppJgIpRkIU6v_H0UJoDR4VCE4m38RQ=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.388937
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    …
  ]
```

</details>

**Example 2. Fetch first 10 apps from cluster page url.**
```php
$clusterPage = 'https://play.google.com/store/apps/collection/cluster?clp=ogooCAEaHAoWcmVjc190b3BpY19pREdaa09EdG1UMBA7GAMqAggBUgIIAg%3D%3D:S:ANO1ljKeniA&gsr=CiuiCigIARocChZyZWNzX3RvcGljX2lER1prT0R0bVQwEDsYAyoCCAFSAggC:S:ANO1ljKPzfI&hl=ru';

$limit = 10;
$apps = [];
foreach ($gplay->getClusterApps($clusterPage) as $i => $app) {
    $apps[] = $app;
    if ($i > $limit) {
        break;
    }
}
```
<details>
  <summary>Results</summary>

```php
array:12 [
    0 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.chickfila.cfaflagship"
      -getLocale(): string: "ru_RU"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.chickfila.cfaflagship"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.chickfila.cfaflagship&hl=ru_RU&gl=us"
      -getName(): string: "Chick-fil-A®"
      -getSummary(): ?string: "Заказывайте заранее, получайте баллы за соответствующую покупку и используйте доступные награды."
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "Chick-fil-A, Inc."
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=Chick-fil-A,+Inc."
        -getName(): string: "Chick-fil-A, Inc."
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/yF2S41QGnGWs7JCD-t6L6AJ4KIm2ybwM0lirAiHQZR2ZKjbvYAgQ4e0MFVXYVLQWWA"
        -getUrl(): string: "https://play-lh.googleusercontent.com/yF2S41QGnGWs7JCD-t6L6AJ4KIm2ybwM0lirAiHQZR2ZKjbvYAgQ4e0MFVXYVLQWWA"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/yF2S41QGnGWs7JCD-t6L6AJ4KIm2ybwM0lirAiHQZR2ZKjbvYAgQ4e0MFVXYVLQWWA=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.693777
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.chuckecheese.app"
      -getLocale(): string: "ru_RU"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.chuckecheese.app"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.chuckecheese.app&hl=ru_RU&gl=us"
      -getName(): string: "Chuck E. Cheese"
      -getSummary(): ?string: "Зарабатывайте бонусные баллы за каждое посещение и открывайте эксклюзивные предложения!"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "8581794605065481540"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=8581794605065481540"
        -getName(): string: "Chuck E. Cheese"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/xCVK5YbFjD8obUoUuje3ZK-lhFG8XWWpZJKN1B8DUOPS8chirXl6KbP6pMNbjMcDOw"
        -getUrl(): string: "https://play-lh.googleusercontent.com/xCVK5YbFjD8obUoUuje3ZK-lhFG8XWWpZJKN1B8DUOPS8chirXl6KbP6pMNbjMcDOw"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/xCVK5YbFjD8obUoUuje3ZK-lhFG8XWWpZJKN1B8DUOPS8chirXl6KbP6pMNbjMcDOw=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.6525
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
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
array:163 [
    0 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.getmimo"
      -getLocale(): string: "ru_RU"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.getmimo"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.getmimo&hl=ru_RU&gl=us"
      -getName(): string: "Mimo: программирование на HTML, JavaScript, Python"
      -getSummary(): ?string: "Информатика, обучение программированию на Python, JavaScript, HTML, SQL"
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
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/4EbbMw6TnleJPtv4rc2C-8NVle1c9xxRkGfPLBzdqosNT61Fk7ag-TYXcVadm8V8uA4"
        -getUrl(): string: "https://play-lh.googleusercontent.com/4EbbMw6TnleJPtv4rc2C-8NVle1c9xxRkGfPLBzdqosNT61Fk7ag-TYXcVadm8V8uA4"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/4EbbMw6TnleJPtv4rc2C-8NVle1c9xxRkGfPLBzdqosNT61Fk7ag-TYXcVadm8V8uA4=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.7183843
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.freeit.java"
      -getLocale(): string: "ru_RU"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.freeit.java"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.freeit.java&hl=ru_RU&gl=us"
      -getName(): string: "Центр программирования: код"
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
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/PGoBnnmiiwDrkGf-i1YfUd7x8pE6GdGeS6NgzUZXOoXMws31QjyVBLNVhYeAkRO2kJE"
        -getUrl(): string: "https://play-lh.googleusercontent.com/PGoBnnmiiwDrkGf-i1YfUd7x8pE6GdGeS6NgzUZXOoXMws31QjyVBLNVhYeAkRO2kJE"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/PGoBnnmiiwDrkGf-i1YfUd7x8pE6GdGeS6NgzUZXOoXMws31QjyVBLNVhYeAkRO2kJE=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.707401
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    …
  ]
```

</details>



### GPlayApps::getClusterPages [[docs]](classes/GPlayApps/gplayapps.getclusterpages.md)
Returns an iterator of cluster pages.

**Example 1. Fetch all cluster pages**
```php
$clusterPage = 'https://play.google.com/store/apps/collection/cluster?clp=ogooCAEaHAoWcmVjc190b3BpY19vbDFxdl9tODloVRA7GAMqAggBUgIIAg%3D%3D:S:ANO1ljLnmTE&gsr=CiuiCigIARocChZyZWNzX3RvcGljX29sMXF2X204OWhVEDsYAyoCCAFSAggC:S:ANO1ljJBunU';

$clusterPages = iterator_to_array($gplay->getClusterPages());
```
<details>
  <summary>Results</summary>

```php
array:23 [
    0 => class Nelexa\GPlay\Model\ClusterPage {
      -getTitle(): string: "Recommended for you"
      -getUrl(): string: "https://play.google.com/store/apps/collection/cluster?clp=ogoKCAEqAggBUgIIAQ%3D%3D:S:ANO1ljJG6Aw&gsr=Cg2iCgoIASoCCAFSAggB:S:ANO1ljLKNqE"
    }
    1 => class Nelexa\GPlay\Model\ClusterPage {
      -getTitle(): string: "Entertainment"
      -getUrl(): string: "https://play.google.com/store/apps/collection/cluster?clp=ogooCAEaHAoWcmVjc190b3BpY19tRWdfUlNWMHY2QRA7GAMqAggBUgIIAg%3D%3D:S:ANO1ljKiaBY&gsr=CiuiCigIA…"
    }
    …
  ]
```

</details>

**Example 1. Fetch all top cluster pages by category "Game Puzzle" for ages up to 5.**
```php
$clusterPage = 'https://play.google.com/store/apps/collection/cluster?clp=ogooCAEaHAoWcmVjc190b3BpY19vbDFxdl9tODloVRA7GAMqAggBUgIIAg%3D%3D:S:ANO1ljLnmTE&gsr=CiuiCigIARocChZyZWNzX3RvcGljX29sMXF2X204OWhVEDsYAyoCCAFSAggC:S:ANO1ljJBunU';

$clusterPages = iterator_to_array(
    $gplay->getClusterPages(
        \Nelexa\GPlay\Enum\CategoryEnum::GAME_PUZZLE(),
        \Nelexa\GPlay\Enum\AgeEnum::FIVE_UNDER(),
        'top'
    )
);
```
<details>
  <summary>Results</summary>

```php
array:3 [
    0 => class Nelexa\GPlay\Model\ClusterPage {
      -getTitle(): string: "Top free"
      -getUrl(): string: "https://play.google.com/store/apps/collection/cluster?clp=0g4jCiEKG3RvcHNlbGxpbmdfZnJlZV9HQU1FX1BVWlpMRRAHGAM%3D:S:ANO1ljLYuNA&gsr=CibSDiMKIQobdG9wc2V…"
    }
    1 => class Nelexa\GPlay\Model\ClusterPage {
      -getTitle(): string: "Top paid"
      -getUrl(): string: "https://play.google.com/store/apps/collection/cluster?clp=0g4jCiEKG3RvcHNlbGxpbmdfcGFpZF9HQU1FX1BVWlpMRRAHGAM%3D:S:ANO1ljIFZPM&gsr=CibSDiMKIQobdG9wc2V…"
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
    1 => "maps for minecraft pe"
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
      -getName(): string: "Google Maps"
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
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/Kf8WTct65hFJxBUDm5E-EpYsiDoLQiGGbnuyP6HBNax43YShXti9THPon1YKB6zPYpA"
        -getUrl(): string: "https://play-lh.googleusercontent.com/Kf8WTct65hFJxBUDm5E-EpYsiDoLQiGGbnuyP6HBNax43YShXti9THPon1YKB6zPYpA"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/Kf8WTct65hFJxBUDm5E-EpYsiDoLQiGGbnuyP6HBNax43YShXti9THPon1YKB6zPYpA=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 3.8799007
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.google.android.apps.mapslite"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.mapslite"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.mapslite&hl=en_US&gl=us"
      -getName(): string: "Google Maps Go"
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
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/0uRNRSe4iS6nhvfbBcoScHcBTx1PMmxkCx8rrEsI2UQcQeZ5ByKz8fkhwRqR3vttOg"
        -getUrl(): string: "https://play-lh.googleusercontent.com/0uRNRSe4iS6nhvfbBcoScHcBTx1PMmxkCx8rrEsI2UQcQeZ5ByKz8fkhwRqR3vttOg"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/0uRNRSe4iS6nhvfbBcoScHcBTx1PMmxkCx8rrEsI2UQcQeZ5ByKz8fkhwRqR3vttOg=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.3178163
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
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
array:905 [
    "com.fingersoft.hillclimb" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.fingersoft.hillclimb"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.fingersoft.hillclimb"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.fingersoft.hillclimb&hl=en_US&gl=us"
      -getName(): string: "Hill Climb Racing"
      -getSummary(): ?string: "Race uphill to win in this offline physics based driving game!"
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
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/N0UxhBVUmx8s7y3F7Kqre2AcpXyPDKAp8nHjiPPoOONc_sfugHCYMjBpbUKCMlK_XUs"
        -getUrl(): string: "https://play-lh.googleusercontent.com/N0UxhBVUmx8s7y3F7Kqre2AcpXyPDKAp8nHjiPPoOONc_sfugHCYMjBpbUKCMlK_XUs"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/N0UxhBVUmx8s7y3F7Kqre2AcpXyPDKAp8nHjiPPoOONc_sfugHCYMjBpbUKCMlK_XUs=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.585985
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    "com.ea.game.nfs14_row" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.ea.game.nfs14_row"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.ea.game.nfs14_row"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.ea.game.nfs14_row&hl=en_US&gl=us"
      -getName(): string: "Need for Speed™ No Limits"
      -getSummary(): ?string: "Dominate the competition and rule the streets. Download to race now!"
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
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/3D39RIkfs0amH9MhhWRLHRILBQUmq1BlIqYMyNSJKb7HyqU6NhQR-toUMmSnPAi60t0"
        -getUrl(): string: "https://play-lh.googleusercontent.com/3D39RIkfs0amH9MhhWRLHRILBQUmq1BlIqYMyNSJKb7HyqU6NhQR-toUMmSnPAi60t0"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/3D39RIkfs0amH9MhhWRLHRILBQUmq1BlIqYMyNSJKb7HyqU6NhQR-toUMmSnPAi60t0=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.3452697
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
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
    "com.blizzard.diablo.immortal" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.blizzard.diablo.immortal"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.blizzard.diablo.immortal"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.blizzard.diablo.immortal&hl=en_US&gl=us"
      -getName(): string: "Diablo Immortal"
      -getSummary(): ?string: "A brand new, visceral Diablo action RPG experience at your fingertips"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "8636572569301896616"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=8636572569301896616"
        -getName(): string: "Blizzard Entertainment, Inc."
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/8DtlOHx-zIncYJE-kwHnOTBXycjAzwufkuk0uad7_MzWP17auA24THldTwhEru-b-7I"
        -getUrl(): string: "https://play-lh.googleusercontent.com/8DtlOHx-zIncYJE-kwHnOTBXycjAzwufkuk0uad7_MzWP17auA24THldTwhEru-b-7I"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/8DtlOHx-zIncYJE-kwHnOTBXycjAzwufkuk0uad7_MzWP17auA24THldTwhEru-b-7I=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 0.0
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    "com.empire.warriors2.premium.epic.tower.td.defender.rush" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.empire.warriors2.premium.epic.tower.td.defender.rush"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.empire.warriors2.premium.epic.tower.td.defender.rush"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.empire.warriors2.premium.epic.tower.td.defender.rush&hl=en_US&gl=us"
      -getName(): string: "Empire Defender TD: Premium"
      -getSummary(): ?string: "Strategy Offline TD Game! Become An Epic Defender! Premium Version"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "7674514660084826148"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=7674514660084826148"
        -getName(): string: "ZITGA"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/mBk-tv2a4eqmsA9uPT_nsmL89CzNeKXk_vgb8__xxKNyC9Unb6dH2awR10NyL20hD_0"
        -getUrl(): string: "https://play-lh.googleusercontent.com/mBk-tv2a4eqmsA9uPT_nsmL89CzNeKXk_vgb8__xxKNyC9Unb6dH2awR10NyL20hD_0"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/mBk-tv2a4eqmsA9uPT_nsmL89CzNeKXk_vgb8__xxKNyC9Unb6dH2awR10NyL20hD_0=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 0.0
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
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
array:1277 [
    "com.zhiliaoapp.musically" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.zhiliaoapp.musically"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.zhiliaoapp.musically"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.zhiliaoapp.musically&hl=en_US&gl=us"
      -getName(): string: "TikTok"
      -getSummary(): ?string: "Join your friends and discover videos you love, only on TikTok"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "TikTok Pte. Ltd."
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=TikTok+Pte.+Ltd."
        -getName(): string: "TikTok Pte. Ltd."
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/z5nin1RdQ4UZhv6fa1FNG7VE33imGqPgC4kKZIUjgf_up7E-Pj3AaojlMPwNNXaeGA"
        -getUrl(): string: "https://play-lh.googleusercontent.com/z5nin1RdQ4UZhv6fa1FNG7VE33imGqPgC4kKZIUjgf_up7E-Pj3AaojlMPwNNXaeGA"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/z5nin1RdQ4UZhv6fa1FNG7VE33imGqPgC4kKZIUjgf_up7E-Pj3AaojlMPwNNXaeGA=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.53436
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    "com.google.android.apps.youtube.kids" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.google.android.apps.youtube.kids"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.youtube.kids"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.youtube.kids&hl=en_US&gl=us"
      -getName(): string: "YouTube Kids"
      -getSummary(): ?string: "Encourage kids to discover the world with a suite of parental controls"
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
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/S4wylkvt2jz16hnG9IG0pAZosbB82nWWy8P-rQkb54uH-SCVd5L2j7z7x1Vz5pZvIRc"
        -getUrl(): string: "https://play-lh.googleusercontent.com/S4wylkvt2jz16hnG9IG0pAZosbB82nWWy8P-rQkb54uH-SCVd5L2j7z7x1Vz5pZvIRc"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/S4wylkvt2jz16hnG9IG0pAZosbB82nWWy8P-rQkb54uH-SCVd5L2j7z7x1Vz5pZvIRc=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.3300085
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
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
array:314 [
    "com.easygames.race" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.easygames.race"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.easygames.race"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.easygames.race&hl=en_US&gl=us"
      -getName(): string: "Race Master 3D - Car Racing"
      -getSummary(): ?string: "Become a track master in the wackiest, wildest, winningest racing game!"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "6392896734092635573"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=6392896734092635573"
        -getName(): string: "SayGames Ltd"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/qW1SrW0Gyr3JRMNrTqMjFwcvZVjLP6-Wp2tDY8Z9UWzf2_XteCit8n9CNEGpnHOEFS8"
        -getUrl(): string: "https://play-lh.googleusercontent.com/qW1SrW0Gyr3JRMNrTqMjFwcvZVjLP6-Wp2tDY8Z9UWzf2_XteCit8n9CNEGpnHOEFS8"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/qW1SrW0Gyr3JRMNrTqMjFwcvZVjLP6-Wp2tDY8Z9UWzf2_XteCit8n9CNEGpnHOEFS8=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.3804564
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    "com.luna.theyarecoming" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.luna.theyarecoming"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.luna.theyarecoming"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.luna.theyarecoming&hl=en_US&gl=us"
      -getName(): string: "They Are Coming"
      -getSummary(): ?string: "Defeat all enemies and win!"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "6018074114375198913"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=6018074114375198913"
        -getName(): string: "Rollic Games"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/3YCNUp1tvYhjT5lBRdmUYRVp1GISq-g_8Uk8tdm4wLtRmZPnJljVa7OBnS8PPYdabx4"
        -getUrl(): string: "https://play-lh.googleusercontent.com/3YCNUp1tvYhjT5lBRdmUYRVp1GISq-g_8Uk8tdm4wLtRmZPnJljVa7OBnS8PPYdabx4"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/3YCNUp1tvYhjT5lBRdmUYRVp1GISq-g_8Uk8tdm4wLtRmZPnJljVa7OBnS8PPYdabx4=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 1.583815
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
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
array:572 [
    "com.fusee.MergeMaster" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.fusee.MergeMaster"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.fusee.MergeMaster"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.fusee.MergeMaster&hl=en_US&gl=us"
      -getName(): string: "Merge Master - Dinosaur Fusion"
      -getSummary(): ?string: "Are you ready to fight and become a merge master?"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "4656343638685426415"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=4656343638685426415"
        -getName(): string: "HOMA GAMES"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/LUxutPFfkpuhZlK9mlBxlZI2J1ECDW-SPfNWnGtgENhasceP8r1vYNkwWf3-yHoZNII"
        -getUrl(): string: "https://play-lh.googleusercontent.com/LUxutPFfkpuhZlK9mlBxlZI2J1ECDW-SPfNWnGtgENhasceP8r1vYNkwWf3-yHoZNII"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/LUxutPFfkpuhZlK9mlBxlZI2J1ECDW-SPfNWnGtgENhasceP8r1vYNkwWf3-yHoZNII=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.043062
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    "com.arkhe.batteryrun" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.arkhe.batteryrun"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.arkhe.batteryrun"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.arkhe.batteryrun&hl=en_US&gl=us"
      -getName(): string: "Battery Run"
      -getSummary(): ?string: "Collect Batteries"
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
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/D8hlXQPeRnqMlTxd3kkvaVtEuGoPIVtrJjsDDfkXlKc-81CTyLCcD8BJO_yJr8xNbA"
        -getUrl(): string: "https://play-lh.googleusercontent.com/D8hlXQPeRnqMlTxd3kkvaVtEuGoPIVtrJjsDDfkXlKc-81CTyLCcD8BJO_yJr8xNbA"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/D8hlXQPeRnqMlTxd3kkvaVtEuGoPIVtrJjsDDfkXlKc-81CTyLCcD8BJO_yJr8xNbA=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.0819674
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
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
array:1141 [
    "com.zhiliaoapp.musically" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.zhiliaoapp.musically"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.zhiliaoapp.musically"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.zhiliaoapp.musically&hl=en_US&gl=us"
      -getName(): string: "TikTok"
      -getSummary(): ?string: "Join your friends and discover videos you love, only on TikTok"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "TikTok Pte. Ltd."
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=TikTok+Pte.+Ltd."
        -getName(): string: "TikTok Pte. Ltd."
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/z5nin1RdQ4UZhv6fa1FNG7VE33imGqPgC4kKZIUjgf_up7E-Pj3AaojlMPwNNXaeGA"
        -getUrl(): string: "https://play-lh.googleusercontent.com/z5nin1RdQ4UZhv6fa1FNG7VE33imGqPgC4kKZIUjgf_up7E-Pj3AaojlMPwNNXaeGA"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/z5nin1RdQ4UZhv6fa1FNG7VE33imGqPgC4kKZIUjgf_up7E-Pj3AaojlMPwNNXaeGA=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.53434
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    "com.picture.magic.imager" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.picture.magic.imager"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.picture.magic.imager"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.picture.magic.imager&hl=en_US&gl=us"
      -getName(): string: "Magic Photo Editor:Foto Repair"
      -getSummary(): ?string: "Handy photo editor : photo repair & coloring"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "Zachary Holt"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=Zachary+Holt"
        -getName(): string: "Zachary Holt"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/eZHrfJNrI0_dfxVvk8Ng_qGPqLj9TVRTQpsozVN_RbLFymXirvboqTeP2rKUNi5gpg"
        -getUrl(): string: "https://play-lh.googleusercontent.com/eZHrfJNrI0_dfxVvk8Ng_qGPqLj9TVRTQpsozVN_RbLFymXirvboqTeP2rKUNi5gpg"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/eZHrfJNrI0_dfxVvk8Ng_qGPqLj9TVRTQpsozVN_RbLFymXirvboqTeP2rKUNi5gpg=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 3.7973423
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
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
array:108 [
    "com.zerosum.coupleshuffle" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.zerosum.coupleshuffle"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.zerosum.coupleshuffle"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.zerosum.coupleshuffle&hl=en_US&gl=us"
      -getName(): string: "Couple Shuffle"
      -getSummary(): ?string: "Couple's Money Adventure"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "5006687761269120821"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=5006687761269120821"
        -getName(): string: "Zerosum"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/pJkzrkGuRs4wfW8En1adLZgYXD8fk5bR5Jq7vE_6S_tjKRDzll3_RAM35f80qQBy"
        -getUrl(): string: "https://play-lh.googleusercontent.com/pJkzrkGuRs4wfW8En1adLZgYXD8fk5bR5Jq7vE_6S_tjKRDzll3_RAM35f80qQBy"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/pJkzrkGuRs4wfW8En1adLZgYXD8fk5bR5Jq7vE_6S_tjKRDzll3_RAM35f80qQBy=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 1.5
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    "com.DogukanKurekci.ShootNDoor" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.DogukanKurekci.ShootNDoor"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.DogukanKurekci.ShootNDoor"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.DogukanKurekci.ShootNDoor&hl=en_US&gl=us"
      -getName(): string: "Shoot N Door"
      -getSummary(): ?string: "The most creative and fun way to shoot. You can do anything by shooting."
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "F13 Entertainment"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=F13+Entertainment"
        -getName(): string: "F13 Entertainment"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/6zNZbPZLnbQ4hyiVf4Sb5WGQA-ROQQb_qfGEcVzwOoUjJePHDp1uNoKO3yt6ReG1fbA"
        -getUrl(): string: "https://play-lh.googleusercontent.com/6zNZbPZLnbQ4hyiVf4Sb5WGQA-ROQQb_qfGEcVzwOoUjJePHDp1uNoKO3yt6ReG1fbA"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/6zNZbPZLnbQ4hyiVf4Sb5WGQA-ROQQb_qfGEcVzwOoUjJePHDp1uNoKO3yt6ReG1fbA=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 1.8666667
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
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
array:202 [
    "com.jura.freddy.rope.five.night" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.jura.freddy.rope.five.night"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.jura.freddy.rope.five.night"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.jura.freddy.rope.five.night&hl=en_US&gl=us"
      -getName(): string: "Bear Rope Hero, Security City"
      -getSummary(): ?string: "Find gangster snipers at the building's and kill them"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "5891027934210113676"
        -getUrl(): string: "https://play.google.com/store/apps/dev?id=5891027934210113676"
        -getName(): string: "Zego Global Publishing"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/9lIZMexQDGYxh82g176ql3r054cGFcXHNB6qVxtTcb_XMPbqwFLcEivK6vkx-DT-nw"
        -getUrl(): string: "https://play-lh.googleusercontent.com/9lIZMexQDGYxh82g176ql3r054cGFcXHNB6qVxtTcb_XMPbqwFLcEivK6vkx-DT-nw"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/9lIZMexQDGYxh82g176ql3r054cGFcXHNB6qVxtTcb_XMPbqwFLcEivK6vkx-DT-nw=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.390244
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    "com.brain.snake.thief.troll" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.brain.snake.thief.troll"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.brain.snake.thief.troll"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.brain.snake.thief.troll&hl=en_US&gl=us"
      -getName(): string: "Snake Troll : Thief master"
      -getSummary(): ?string: "Use your brain to steal them all"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "ABI Global Publishing"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=ABI+Global+Publishing"
        -getName(): string: "ABI Global Publishing"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/jVHQZOe6aEpYsjObeByIWJcOLJMt9_VGmSSBxLgAPgs2JakXt6vW6lJybpKi9J-kAn8"
        -getUrl(): string: "https://play-lh.googleusercontent.com/jVHQZOe6aEpYsjObeByIWJcOLJMt9_VGmSSBxLgAPgs2JakXt6vW6lJybpKi9J-kAn8"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/jVHQZOe6aEpYsjObeByIWJcOLJMt9_VGmSSBxLgAPgs2JakXt6vW6lJybpKi9J-kAn8=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 3.5714285
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
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
array:411 [
    "com.speedfiymax.app" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.speedfiymax.app"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.speedfiymax.app"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.speedfiymax.app&hl=en_US&gl=us"
      -getName(): string: "MaxSpeedfiy-Unlimited&Easy"
      -getSummary(): ?string: "Simple, fast and easy-to-use high-speed proxy"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "PRIME DIGITAL PTE. LTD."
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=PRIME+DIGITAL+PTE.+LTD."
        -getName(): string: "PRIME DIGITAL PTE. LTD."
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/um1SUFZ4MvJ6heUV-h6Ygt23X1gQhw9b5Gk38enw387Ke4xXGh2ixgFt8Y-Q1tXOTAg"
        -getUrl(): string: "https://play-lh.googleusercontent.com/um1SUFZ4MvJ6heUV-h6Ygt23X1gQhw9b5Gk38enw387Ke4xXGh2ixgFt8Y-Q1tXOTAg"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/um1SUFZ4MvJ6heUV-h6Ygt23X1gQhw9b5Gk38enw387Ke4xXGh2ixgFt8Y-Q1tXOTAg=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 4.5064936
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    "com.Blingwallpaper.hd" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.Blingwallpaper.hd"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.Blingwallpaper.hd"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.Blingwallpaper.hd&hl=en_US&gl=us"
      -getName(): string: "Bling Wallpeper-live,4K,HD"
      -getSummary(): ?string: "Easy，4K,HD，Livewallpaper"
      -getDeveloper(): Nelexa\GPlay\Model\Developer: {
        -getId(): string: "swmail9@gmail.com"
        -getUrl(): string: "https://play.google.com/store/apps/developer?id=swmail9@gmail.com"
        -getName(): string: "swmail9@gmail.com"
        -getDescription(): ?string: null
        -getWebsite(): ?string: null
        -getIcon(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getCover(): ?Nelexa\GPlay\Model\GoogleImage: null
        -getEmail(): ?string: null
        -getAddress(): ?string: null
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/-NL_6qpT4ETIEg5k5z2Sq3x-8LLfabt-GleIkTvfjyv2UitZ0hsRoRAXjVCqLyiOdg"
        -getUrl(): string: "https://play-lh.googleusercontent.com/-NL_6qpT4ETIEg5k5z2Sq3x-8LLfabt-GleIkTvfjyv2UitZ0hsRoRAXjVCqLyiOdg"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/-NL_6qpT4ETIEg5k5z2Sq3x-8LLfabt-GleIkTvfjyv2UitZ0hsRoRAXjVCqLyiOdg=s0"
        -getBinaryImageContent(): string: …
      }
      -getScore(): float: 3.0
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -asArray(): array: …
      -jsonSerialize(): array: …
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
    ->saveGoogleImages($screenshots, static function (Nelexa\GPlay\Model\GoogleImage $image) {
        // set width or height 700px
        $image->setSize(700);
        $hash = $image->getHashUrl($hashAlgo = 'md5', $parts = 2, $partLength = 2);

        return 'screenshots/' . $hash . '.{ext}';
    })
;
```
<details>
  <summary>Results</summary>

```php
array:15 [
    0 => class Nelexa\GPlay\Model\ImageInfo {
      -getUrl(): string: "https://play-lh.googleusercontent.com/n7uqiWBp3ej01JpnR3ShqB6jfn_FIEjnDn0vM0b535O9DHk5wdtWGE3g1V9mpw4rG24=s700"
      -getFilename(): string: "screenshots/ec/45/ec45b381683d65cd43f269a03a7bc518.png"
      -getMimeType(): string: "image/png"
      -getExtension(): string: "png"
      -getWidth(): int: 394
      -getHeight(): int: 700
      -getFilesize(): int: 261138
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\ImageInfo {
      -getUrl(): string: "https://play-lh.googleusercontent.com/NDrRfjlbFwrrGQAOkW5WoemB8QrBS6lp8c1C3gmXJXIITHBDS5LBnk5ypXySwudJiFQ=s700"
      -getFilename(): string: "screenshots/a8/89/a889866f987dd36b8f013e8750b7fab3.png"
      -getMimeType(): string: "image/png"
      -getExtension(): string: "png"
      -getWidth(): int: 394
      -getHeight(): int: 700
      -getFilesize(): int: 342036
      -asArray(): array: …
      -jsonSerialize(): array: …
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
  -getUrl(): string: "https://play-lh.googleusercontent.com/iOi6YJxQwMenT5UQWGPWTrFMQFm68IC4uKlFtARveZzVD5lTZ7fC47_rnnF7Tk48DpY=w300"
  -getFilename(): string: "icons/com.rovio.angrybirds.png"
  -getMimeType(): string: "image/png"
  -getExtension(): string: "png"
  -getWidth(): int: 300
  -getHeight(): int: 300
  -getFilesize(): int: 59706
  -asArray(): array: …
  -jsonSerialize(): array: …
}
```

</details>
