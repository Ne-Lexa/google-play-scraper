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
* [GPlayApps::getPermissions](#gplayappsgetpermissions-docs): Returns a list of permissions for the application.
* [GPlayApps::getCategories](#gplayappsgetcategories-docs): Returns an array of application categories from the Google Play store.
* [GPlayApps::getDeveloperInfo](#gplayappsgetdeveloperinfo-docs): Returns information about the developer: name, icon, cover, description and website address.
* [GPlayApps::getDeveloperInfoForLocales](#gplayappsgetdeveloperinfoforlocales-docs): Returns information about the developer for the specified locales.
* [GPlayApps::getDeveloperApps](#gplayappsgetdeveloperapps-docs): Returns an array of applications from the Google Play store by developer id.
* [GPlayApps::getClusterApps](#gplayappsgetclusterapps-docs): Returns an iterator of applications from the Google Play store for the specified cluster page.
* [GPlayApps::getSimilarApps](#gplayappsgetsimilarapps-docs): Returns an array of similar applications with basic information about them in the Google Play store.
* [GPlayApps::getClusterPages](#gplayappsgetclusterpages-docs): Returns an iterator of cluster pages.
* [GPlayApps::getSearchSuggestions](#gplayappsgetsearchsuggestions-docs): Returns the Google Play search suggests.
* [GPlayApps::search](#gplayappssearch-docs): Returns a list of applications from the Google Play store for a search query.
* [GPlayApps::getListApps](#gplayappsgetlistapps-docs): Returns an array of applications from the Google Play store for the specified category.
* [GPlayApps::getTopSellingFreeApps](#gplayappsgettopsellingfreeapps-docs): Returns an array of **top selling free apps** from the Google Play store for the specified category.
* [GPlayApps::getTopSellingPaidApps](#gplayappsgettopsellingpaidapps-docs): Returns an array of **top selling paid apps** from the Google Play store for the specified category.
* [GPlayApps::getTopGrossingApps](#gplayappsgettopgrossingapps-docs): Returns an array of **top grossing apps** from the Google Play store for the specified category.
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
  -getDescription(): string: """
    Досліджуйте безкінечні світи та будуйте що завгодно: від простих хижок до розкішних замків. Грайте у творчому режимі з необмеженими ресурсами або вибе…
    """
  -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
    -__toString(): string: "https://play-lh.googleusercontent.com/VSwHQjcAttxsLE47RuS4PqpC4LT7lCoSjE7Hx5AW_yCxtDvcnsHHvm5CTuL5BPN-uRTP"
    -getUrl(): string: "https://play-lh.googleusercontent.com/VSwHQjcAttxsLE47RuS4PqpC4LT7lCoSjE7Hx5AW_yCxtDvcnsHHvm5CTuL5BPN-uRTP"
    -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/VSwHQjcAttxsLE47RuS4PqpC4LT7lCoSjE7Hx5AW_yCxtDvcnsHHvm5CTuL5BPN-uRTP=s0"
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
  -getScore(): float: 4.4919477
  -getPriceText(): ?string: "209,99 грн"
  -isFree(): bool: false
  -getInstallsText(): string: "10 000 000+"
  -jsonSerialize(): array: …
  -getDeveloper(): ?Nelexa\GPlay\Model\Developer: {
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
  -getDeveloperName(): mixed: "Mojang"
  -getSummary(): string: "Minecraft – це гра, у якій ви розставляєте блоки та шукаєте пригоди."
  -getTranslatedFromLocale(): mixed: null
  -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
    -__toString(): string: "https://play-lh.googleusercontent.com/yAtZnNL-9Eb5VYSsCaOC7KAsOVIJcY8mpKa0MoF-0HCL6b0OrFcBizURHywpuip-D6Y"
    -getUrl(): string: "https://play-lh.googleusercontent.com/yAtZnNL-9Eb5VYSsCaOC7KAsOVIJcY8mpKa0MoF-0HCL6b0OrFcBizURHywpuip-D6Y"
    -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/yAtZnNL-9Eb5VYSsCaOC7KAsOVIJcY8mpKa0MoF-0HCL6b0OrFcBizURHywpuip-D6Y=s0"
    -getBinaryImageContent(): string: …
  }
  -getCategory(): ?Nelexa\GPlay\Model\Category: {
    -getId(): string: "GAME_ARCADE"
    -getName(): string: "Аркади"
    -isGamesCategory(): bool: true
    -isFamilyCategory(): bool: false
    -isApplicationCategory(): bool: false
    -asArray(): array: …
    -jsonSerialize(): array: …
  }
  -getCategoryFamily(): ?Nelexa\GPlay\Model\Category: {
    -getId(): string: "GAME_SIMULATION"
    -getName(): string: "Симулятори"
    -isGamesCategory(): bool: true
    -isFamilyCategory(): bool: false
    -isApplicationCategory(): bool: false
    -asArray(): array: …
    -jsonSerialize(): array: …
  }
  -getVideo(): ?Nelexa\GPlay\Model\Video: null
  -getRecentChanges(): ?string: """
    Що нового в 1.18.32:\n
    Різні виправлення помилок
    """
  -isEditorsChoice(): bool: false
  -getInstalls(): int: 42698734
  -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
    -getFiveStars(): int: 338429
    -getFourStars(): int: 85306
    -getThreeStars(): int: 173410
    -getTwoStars(): int: 381782
    -getOneStar(): int: 3623437
    -asArray(): array: …
    -jsonSerialize(): array: …
  }
  -getPrice(): float: 209.99
  -getCurrency(): string: "UAH"
  -isContainsIAP(): bool: true
  -getOffersIAPCost(): ?string: "9,36 грн – 1 349,99 грн за продукт"
  -isContainsAds(): bool: false
  -getSize(): mixed: null
  -getAppVersion(): ?string: "1.18.32.02"
  -getAndroidVersion(): ?string: "5.0"
  -getMinAndroidVersion(): ?string: "5.0"
  -getContentRating(): ?string: ""
  -getPrivacyPoliceUrl(): ?string: "https://privacy.microsoft.com/en-us/privacystatement"
  -getReleased(): ?DateTimeInterface: @1313475441 {
    date: 2011-08-16T06:17:21+00:00
  }
  -getUpdated(): ?DateTimeInterface: @1651770636 {
    date: 2022-05-05T17:10:36+00:00
  }
  -getNumberVoters(): int: 4602507
  -getNumberReviews(): int: 15548
  -getReviews(): array: array:40 [
    0 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOHh4V5ct0qTBE4SFSkJeGICh2eSzzuDD-6iGMql52mF8A8GwJ6VlKtDdM7slZ0cHlnU2ReOc-j7-WLAbvQ"
      -getUrl(): mixed: ""
      -getUserName(): string: "Мангли"
      -getText(): string: "Гра чудова мені подобається 😁"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14Ghgk5ZshoNrKtQGrcAJkFicpeXqq_YXmqcP_BPJZA=s64"
        -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14Ghgk5ZshoNrKtQGrcAJkFicpeXqq_YXmqcP_BPJZA=s64"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14Ghgk5ZshoNrKtQGrcAJkFicpeXqq_YXmqcP_BPJZA=s0"
        -getBinaryImageContent(): string: …
      }
      -getDate(): ?DateTimeInterface: @1652859421 {
        date: 2022-05-18T07:37:01+00:00
      }
      -getScore(): int: 5
      -getCountLikes(): int: 769
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
      -getAppVersion(): ?string: "1.18.32.02"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOFjX8MX-dIrpBWlo70C9RtYKsvwJEreIzhVdj6eS0rPgwdTRH2lNVZ6pnXw7nBWmGICJ_FbFb-FY-NJAwE"
      -getUrl(): mixed: ""
      -getUserName(): string: "GM LX"
      -getText(): string: "Прікольна гра, тільки загрузуа довговата стала раніше була краще, хімія вабще супер!👍!"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GiwgvL2ui8R3mJEZkQ3VAV-AJG97w-ZepDFG4wNZg=s64"
        -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GiwgvL2ui8R3mJEZkQ3VAV-AJG97w-ZepDFG4wNZg=s64"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GiwgvL2ui8R3mJEZkQ3VAV-AJG97w-ZepDFG4wNZg=s0"
        -getBinaryImageContent(): string: …
      }
      -getDate(): ?DateTimeInterface: @1652444165 {
        date: 2022-05-13T12:16:05+00:00
      }
      -getScore(): int: 5
      -getCountLikes(): int: 723
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
      -getAppVersion(): ?string: "1.18.32.02"
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
    "minecraft" => class Nelexa\GPlay\Model\AppInfo {
      -getId(): string: "com.mojang.minecraftpe"
      -getLocale(): string: "pt_BR"
      -getCountry(): string: "br"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.mojang.minecraftpe&hl=pt_BR&gl=br"
      -getName(): string: "Minecraft"
      -getDescription(): string: """
        Explore mundos infinitos e construa desde simples casas a grandiosos castelos. Jogue no modo criativo com recursos ilimitados ou minere fundo no mundo…
        """
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/VSwHQjcAttxsLE47RuS4PqpC4LT7lCoSjE7Hx5AW_yCxtDvcnsHHvm5CTuL5BPN-uRTP"
        -getUrl(): string: "https://play-lh.googleusercontent.com/VSwHQjcAttxsLE47RuS4PqpC4LT7lCoSjE7Hx5AW_yCxtDvcnsHHvm5CTuL5BPN-uRTP"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/VSwHQjcAttxsLE47RuS4PqpC4LT7lCoSjE7Hx5AW_yCxtDvcnsHHvm5CTuL5BPN-uRTP=s0"
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
      -getScore(): float: 4.636201
      -getPriceText(): ?string: "R$ 37,99"
      -isFree(): bool: false
      -getInstallsText(): string: "10.000.000+"
      -jsonSerialize(): array: …
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: {
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
      -getDeveloperName(): mixed: "Mojang"
      -getSummary(): string: "Minecraft é um jogo sobre blocos e aventuras!"
      -getTranslatedFromLocale(): mixed: null
      -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/yAtZnNL-9Eb5VYSsCaOC7KAsOVIJcY8mpKa0MoF-0HCL6b0OrFcBizURHywpuip-D6Y"
        -getUrl(): string: "https://play-lh.googleusercontent.com/yAtZnNL-9Eb5VYSsCaOC7KAsOVIJcY8mpKa0MoF-0HCL6b0OrFcBizURHywpuip-D6Y"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/yAtZnNL-9Eb5VYSsCaOC7KAsOVIJcY8mpKa0MoF-0HCL6b0OrFcBizURHywpuip-D6Y=s0"
        -getBinaryImageContent(): string: …
      }
      -getCategory(): ?Nelexa\GPlay\Model\Category: {
        -getId(): string: "GAME_ARCADE"
        -getName(): string: "Arcade"
        -isGamesCategory(): bool: true
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: false
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getCategoryFamily(): ?Nelexa\GPlay\Model\Category: {
        -getId(): string: "GAME_SIMULATION"
        -getName(): string: "Simulação"
        -isGamesCategory(): bool: true
        -isFamilyCategory(): bool: false
        -isApplicationCategory(): bool: false
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getVideo(): ?Nelexa\GPlay\Model\Video: null
      -getRecentChanges(): ?string: """
        Novidades na versão 1.18.32:\n
        Correção de diversos erros
        """
      -isEditorsChoice(): bool: false
      -getInstalls(): int: 42698734
      -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
        -getFiveStars(): int: 237088
        -getFourStars(): int: 66225
        -getThreeStars(): int: 124403
        -getTwoStars(): int: 278526
        -getOneStar(): int: 3896259
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getPrice(): float: 37.99
      -getCurrency(): string: "BRL"
      -isContainsIAP(): bool: true
      -getOffersIAPCost(): ?string: "R$ 1,33 – R$ 179,99 por item"
      -isContainsAds(): bool: false
      -getSize(): mixed: null
      -getAppVersion(): ?string: "1.18.32.02"
      -getAndroidVersion(): ?string: "5.0"
      -getMinAndroidVersion(): ?string: "5.0"
      -getContentRating(): ?string: ""
      -getPrivacyPoliceUrl(): ?string: "https://privacy.microsoft.com/en-us/privacystatement"
      -getReleased(): ?DateTimeInterface: @1313475441 {
        date: 2011-08-16T06:17:21+00:00
      }
      -getUpdated(): ?DateTimeInterface: @1651770636 {
        date: 2022-05-05T17:10:36+00:00
      }
      -getNumberVoters(): int: 4602522
      -getNumberReviews(): int: 283192
      -getReviews(): array: array:40 [
        0 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOGvo6tKp6yEY1gfAc--RizRY6u3QcIrPeD6WZxqPoat6eJuoODGEQmBjUBHDHbRtd-QB3oLhMs2kwTMQjA"
          -getUrl(): mixed: ""
          -getUserName(): string: "Brayan Buchmann"
          -getText(): string: "O que eu preciso dizer‽ O jogo é perfeito, e obviamente muitos conhecem, então eu nem preciso elogiá-lo ou descrevê-lo, mas gostaria de reportar um pr…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgvklYmVLcaeGXC6_CBXCHv87FVk_3nYrxIUBRK=s64"
            -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgvklYmVLcaeGXC6_CBXCHv87FVk_3nYrxIUBRK=s64"
            -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgvklYmVLcaeGXC6_CBXCHv87FVk_3nYrxIUBRK=s0"
            -getBinaryImageContent(): string: …
          }
          -getDate(): ?DateTimeInterface: @1654227404 {
            date: 2022-06-03T03:36:44+00:00
          }
          -getScore(): int: 5
          -getCountLikes(): int: 1253
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -getAppVersion(): ?string: "1.18.32.02"
          -asArray(): array: …
          -jsonSerialize(): array: …
        }
        1 => class Nelexa\GPlay\Model\Review {
          -getId(): string: "gp:AOqpTOF1lO4-Jkss_lvWCdbhk444TR36w02v5hcnQfhqHsI3knOm031R33ex7tKq6BftxwhwZ08Zd0lRQUlI85U"
          -getUrl(): mixed: ""
          -getUserName(): string: "Kobayashii"
          -getText(): string: "Mine é uns dos meus jogos favoritos, o jogo é simplesmente perfeito! Só acho que deveria ter controles melhores na tela, eu acho muito difícil jogar d…"
          -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
            -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgW-9lDuXjNL3fy8cwDIiG1KB-OpEFnMwl7ap73=s64"
            -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgW-9lDuXjNL3fy8cwDIiG1KB-OpEFnMwl7ap73=s64"
            -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14GgW-9lDuXjNL3fy8cwDIiG1KB-OpEFnMwl7ap73=s0"
            -getBinaryImageContent(): string: …
          }
          -getDate(): ?DateTimeInterface: @1653207630 {
            date: 2022-05-22T08:20:30+00:00
          }
          -getScore(): int: 3
          -getCountLikes(): int: 4911
          -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
          -getAppVersion(): ?string: "1.18.32.02"
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
      -getId(): string: "gp:AOqpTOGMQH49VsMM5PMKe-d6SYrxGzo-sFQ9Apr2Q0ROtv1rx8BidV3yU5pz9WKf3sJnHZ4tzAoBmembGkyaUNY"
      -getUrl(): mixed: ""
      -getUserName(): string: "Анатолий Котеленец"
      -getText(): string: "Отличное приложение. Теперь написанно сколько будет на такси стоить ))) Люди пишут по поводу GPS навигации со одной стороны это было бы отлично. С дру…"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14Gg2Yaj5bSn60zXWgPouzpVkbzDZvyHaNJR8Uwm1lw=s64"
        -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14Gg2Yaj5bSn60zXWgPouzpVkbzDZvyHaNJR8Uwm1lw=s64"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14Gg2Yaj5bSn60zXWgPouzpVkbzDZvyHaNJR8Uwm1lw=s0"
        -getBinaryImageContent(): string: …
      }
      -getDate(): ?DateTimeInterface: @1653108314 {
        date: 2022-05-21T04:45:14+00:00
      }
      -getScore(): int: 5
      -getCountLikes(): int: 50
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: {
        -getDate(): DateTimeInterface: @1653293986 {
          date: 2022-05-23T08:19:46+00:00
        }
        -getText(): string: "Анатолий, спасибо, что пользуетесь сервисами Яндекса! Мы очень ценим ваше доверие и рады, что приложение оказалось полезным для вас."
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getAppVersion(): ?string: "3.6.4"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOENZ-EPam3izLvzWuxR2PkIVfqVoQv8OOyCNwz76SssaO5XDXNJKhDMEcRIlY1wqm-gklLbCtVnRclmeUU"
      -getUrl(): mixed: ""
      -getUserName(): string: "Сергей"
      -getText(): string: "Реклама в схеме метро, которая закрывает саму схему и которую нельзя отключить - это изобретение садиста. Re: Стараетесь, чтобы было ненавязчиво? А ес…"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/a-/AOh14Gg7TaltJFqmYQfvOZW9sjEIegbuBFBlBb_PMP2hSg=s64"
        -getUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14Gg7TaltJFqmYQfvOZW9sjEIegbuBFBlBb_PMP2hSg=s64"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/a-/AOh14Gg7TaltJFqmYQfvOZW9sjEIegbuBFBlBb_PMP2hSg=s0"
        -getBinaryImageContent(): string: …
      }
      -getDate(): ?DateTimeInterface: @1652507283 {
        date: 2022-05-14T05:48:03+00:00
      }
      -getScore(): int: 1
      -getCountLikes(): int: 80
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: {
        -getDate(): DateTimeInterface: @1652677566 {
          date: 2022-05-16T05:06:06+00:00
        }
        -getText(): string: "Сергей, понимаем, что подобное поведение приложения вас расстраивает. Действительно, сейчас в Яндекс Метро нет возможности отключить рекламу. Мы внима…"
        -asArray(): array: …
        -jsonSerialize(): array: …
      }
      -getAppVersion(): ?string: "3.6.4"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    …
  ]
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
array:59 [
    0 => class Nelexa\GPlay\Model\Category {
      -getId(): string: "GAME"
      -getName(): string: "Game"
      -isGamesCategory(): bool: true
      -isFamilyCategory(): bool: false
      -isApplicationCategory(): bool: false
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\Category {
      -getId(): string: "FAMILY"
      -getName(): string: "Family"
      -isGamesCategory(): bool: false
      -isFamilyCategory(): bool: true
      -isApplicationCategory(): bool: false
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    …
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
array:142 [
    0 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.google.android.apps.nbu.paisa.user"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.nbu.paisa.user"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.nbu.paisa.user&hl=en_US&gl=us"
      -getName(): string: "Google Pay: Save, Pay, Manage"
      -getDescription(): string: """
        Google Pay is a safe, simple, and helpful way to manage your money, giving you a clearer picture of your spending and savings:\n
        - Pay at your favorite …
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "Google LLC"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/HArtbyi53u0jnqhnnxkQnMx9dHOERNcprZyKnInd2nrfM7Wd9ivMNTiz7IJP6-mSpwk"
        -getUrl(): string: "https://play-lh.googleusercontent.com/HArtbyi53u0jnqhnnxkQnMx9dHOERNcprZyKnInd2nrfM7Wd9ivMNTiz7IJP6-mSpwk"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/HArtbyi53u0jnqhnnxkQnMx9dHOERNcprZyKnInd2nrfM7Wd9ivMNTiz7IJP6-mSpwk=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:8 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/_e4zCcgrRdWrkQ0Lp4dDdxxCD-mBD14UPzGD3gm0sIWs4vqw5cecjqnahb-tL7_4VPrc"
          -getUrl(): string: "https://play-lh.googleusercontent.com/_e4zCcgrRdWrkQ0Lp4dDdxxCD-mBD14UPzGD3gm0sIWs4vqw5cecjqnahb-tL7_4VPrc"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/_e4zCcgrRdWrkQ0Lp4dDdxxCD-mBD14UPzGD3gm0sIWs4vqw5cecjqnahb-tL7_4VPrc=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/uZulu3Y729zkyXyHK_38xmUuIEZFKY_rQ4fV2-6DXfW8RHYmGs9GDRDnn_rlp_0ENCBP"
          -getUrl(): string: "https://play-lh.googleusercontent.com/uZulu3Y729zkyXyHK_38xmUuIEZFKY_rQ4fV2-6DXfW8RHYmGs9GDRDnn_rlp_0ENCBP"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/uZulu3Y729zkyXyHK_38xmUuIEZFKY_rQ4fV2-6DXfW8RHYmGs9GDRDnn_rlp_0ENCBP=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.031678
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "500,000,000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.google.android.apps.youtube.unplugged"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.youtube.unplugged"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.youtube.unplugged&hl=en_US&gl=us"
      -getName(): string: "YouTube TV: Live TV & more"
      -getDescription(): string: """
        • Cable-free live TV. No cable box required.\n
        • Watch major broadcast and cable networks, including ABC, CBS, FOX, NBC, NFL Network, ESPN, AMC, Univisi…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "Google LLC"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/gk-WYYED1OJNr0G28ucBPUTPric5QCLwW2q_rNcYg-XTQCbPkhcp3CqVJ-1dHiBql10"
        -getUrl(): string: "https://play-lh.googleusercontent.com/gk-WYYED1OJNr0G28ucBPUTPric5QCLwW2q_rNcYg-XTQCbPkhcp3CqVJ-1dHiBql10"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/gk-WYYED1OJNr0G28ucBPUTPric5QCLwW2q_rNcYg-XTQCbPkhcp3CqVJ-1dHiBql10=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:15 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/P-0BzvPbLYzXoPS5AnObWyrePFABTNpAqpBnC87cGPncCY_ImcPChV73Jokj8MlZ3g"
          -getUrl(): string: "https://play-lh.googleusercontent.com/P-0BzvPbLYzXoPS5AnObWyrePFABTNpAqpBnC87cGPncCY_ImcPChV73Jokj8MlZ3g"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/P-0BzvPbLYzXoPS5AnObWyrePFABTNpAqpBnC87cGPncCY_ImcPChV73Jokj8MlZ3g=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/vcWbsStnrJ2BwPkDXp1rG3EoRHY4JyhpK6aDfe51l6Mi8fZ71pCH-E5s5zSYQQjaBrVS"
          -getUrl(): string: "https://play-lh.googleusercontent.com/vcWbsStnrJ2BwPkDXp1rG3EoRHY4JyhpK6aDfe51l6Mi8fZ71pCH-E5s5zSYQQjaBrVS"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/vcWbsStnrJ2BwPkDXp1rG3EoRHY4JyhpK6aDfe51l6Mi8fZ71pCH-E5s5zSYQQjaBrVS=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 3.917587
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "10,000,000+"
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
array:203 [
    0 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.netflix.mediaclient"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.netflix.mediaclient"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.netflix.mediaclient&hl=en_US&gl=us"
      -getName(): string: "Netflix"
      -getDescription(): string: """
        Looking for the most talked about TV shows and movies from the around the world? They’re all on Netflix.\n
        \n
        We’ve got award-winning series, movies, docu…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "Netflix, Inc."
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/TBRwjS_qfJCSj1m7zZB93FnpJM5fSpMA_wUlFDLxWAb45T9RmwBvQd5cWR5viJJOhkI"
        -getUrl(): string: "https://play-lh.googleusercontent.com/TBRwjS_qfJCSj1m7zZB93FnpJM5fSpMA_wUlFDLxWAb45T9RmwBvQd5cWR5viJJOhkI"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/TBRwjS_qfJCSj1m7zZB93FnpJM5fSpMA_wUlFDLxWAb45T9RmwBvQd5cWR5viJJOhkI=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:24 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/m7mg_DZ1uTb6jfGewOOtZ4ejmDaBYfEWZVfEP0pkSX60OsoG7YDgjuFLPCCc6rBnYJk"
          -getUrl(): string: "https://play-lh.googleusercontent.com/m7mg_DZ1uTb6jfGewOOtZ4ejmDaBYfEWZVfEP0pkSX60OsoG7YDgjuFLPCCc6rBnYJk"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/m7mg_DZ1uTb6jfGewOOtZ4ejmDaBYfEWZVfEP0pkSX60OsoG7YDgjuFLPCCc6rBnYJk=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/K4-4tkQJD0U0H_FiAn5yHz_-9Y8bP6f1tGCmFtYwBzn-5Gk1AM8Ga4S3c0T6s4ex_HI"
          -getUrl(): string: "https://play-lh.googleusercontent.com/K4-4tkQJD0U0H_FiAn5yHz_-9Y8bP6f1tGCmFtYwBzn-5Gk1AM8Ga4S3c0T6s4ex_HI"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/K4-4tkQJD0U0H_FiAn5yHz_-9Y8bP6f1tGCmFtYwBzn-5Gk1AM8Ga4S3c0T6s4ex_HI=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.4518275
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "1,000,000,000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.microsoft.office.officehubrow"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.microsoft.office.officehubrow"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.microsoft.office.officehubrow&hl=en_US&gl=us"
      -getName(): string: "Microsoft Office: Edit & Share"
      -getDescription(): string: """
        Microsoft Office brings you Word, Excel, and PowerPoint all in one app. Take advantage of a seamless experience with Microsoft tools on the go with th…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "Microsoft Corporation"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/D6XDCje7pB0nNP1sOZkwD-tXkV0_As3ni21us5yZ71_sy0FTWv1s_MQBe1JUnHlgE94"
        -getUrl(): string: "https://play-lh.googleusercontent.com/D6XDCje7pB0nNP1sOZkwD-tXkV0_As3ni21us5yZ71_sy0FTWv1s_MQBe1JUnHlgE94"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/D6XDCje7pB0nNP1sOZkwD-tXkV0_As3ni21us5yZ71_sy0FTWv1s_MQBe1JUnHlgE94=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:8 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/cDvFQbu-3O3NfyrNSkx9d1Ua25bYS3Ly8fCcPgdMnj5ktHh0uidRp0OiNVIb5OFB5ck"
          -getUrl(): string: "https://play-lh.googleusercontent.com/cDvFQbu-3O3NfyrNSkx9d1Ua25bYS3Ly8fCcPgdMnj5ktHh0uidRp0OiNVIb5OFB5ck"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/cDvFQbu-3O3NfyrNSkx9d1Ua25bYS3Ly8fCcPgdMnj5ktHh0uidRp0OiNVIb5OFB5ck=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/h054Q_gu6miJlzLA59fyO6sgtSFlEVIa1iSgHeqUXik07F2-ppZNPUK8XjLdnIVI0PA"
          -getUrl(): string: "https://play-lh.googleusercontent.com/h054Q_gu6miJlzLA59fyO6sgtSFlEVIa1iSgHeqUXik07F2-ppZNPUK8XjLdnIVI0PA"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/h054Q_gu6miJlzLA59fyO6sgtSFlEVIa1iSgHeqUXik07F2-ppZNPUK8XjLdnIVI0PA=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.5317974
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "500,000,000+"
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
      -getId(): string: "com.propel.ebenefits"
      -getLocale(): string: "ru_RU"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.propel.ebenefits"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.propel.ebenefits&hl=ru_RU&gl=us"
      -getName(): string: "Providers: EBT, debit, & more"
      -getDescription(): string: """
        Providers (formerly Fresh EBT) is the #1 rated EBT app  for checking your food stamp balance. Plus, you can now manage other benefits and income with …
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "Propel Inc"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/KZZXWqhPRrC90BMBPYDErwovMvxHgmp9Oq3kWOBPgMl0ySoQktr9sQ1ItEKWtGr_VcJE"
        -getUrl(): string: "https://play-lh.googleusercontent.com/KZZXWqhPRrC90BMBPYDErwovMvxHgmp9Oq3kWOBPgMl0ySoQktr9sQ1ItEKWtGr_VcJE"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/KZZXWqhPRrC90BMBPYDErwovMvxHgmp9Oq3kWOBPgMl0ySoQktr9sQ1ItEKWtGr_VcJE=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:8 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/8s0av_Mi4dWXeR1LQaEVk4MtpjDpGqb-uOc7C2IcNqTaQffa_XwYDqsF8zxTDjBi4LOJ"
          -getUrl(): string: "https://play-lh.googleusercontent.com/8s0av_Mi4dWXeR1LQaEVk4MtpjDpGqb-uOc7C2IcNqTaQffa_XwYDqsF8zxTDjBi4LOJ"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/8s0av_Mi4dWXeR1LQaEVk4MtpjDpGqb-uOc7C2IcNqTaQffa_XwYDqsF8zxTDjBi4LOJ=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/xkw61UodnuL9G6tjyLlLbRUgWWbrDrjBduAV8LmGhImSDnIkMXGGiKZaOPmNVSZI0ds"
          -getUrl(): string: "https://play-lh.googleusercontent.com/xkw61UodnuL9G6tjyLlLbRUgWWbrDrjBduAV8LmGhImSDnIkMXGGiKZaOPmNVSZI0ds"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/xkw61UodnuL9G6tjyLlLbRUgWWbrDrjBduAV8LmGhImSDnIkMXGGiKZaOPmNVSZI0ds=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.7484856
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "10 000 000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.tacobell.ordering"
      -getLocale(): string: "ru_RU"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.tacobell.ordering"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.tacobell.ordering&hl=ru_RU&gl=us"
      -getName(): string: "Taco Bell – Order Fast Food"
      -getDescription(): string: """
        With the Taco Bell App, you can order and pay ahead, skip our line, get access to new deals and offers, and more.\n
        \n
        App Features include:\n
        \n
        REDEEM REWAR…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "Taco Bell Mobile"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/wWXePJtJwa8slrpch_scAqld5hNDAQKx-KSLDo5uo69yfQv-_k6o5OPPjEQrdRHFHOo"
        -getUrl(): string: "https://play-lh.googleusercontent.com/wWXePJtJwa8slrpch_scAqld5hNDAQKx-KSLDo5uo69yfQv-_k6o5OPPjEQrdRHFHOo"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/wWXePJtJwa8slrpch_scAqld5hNDAQKx-KSLDo5uo69yfQv-_k6o5OPPjEQrdRHFHOo=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:6 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/Jk2tFc36FvYTpisapcpQzMuReYHaxvua5wetPgD6oE4tXgPTQZS-Ii39mcUTW9XbIs6Y"
          -getUrl(): string: "https://play-lh.googleusercontent.com/Jk2tFc36FvYTpisapcpQzMuReYHaxvua5wetPgD6oE4tXgPTQZS-Ii39mcUTW9XbIs6Y"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/Jk2tFc36FvYTpisapcpQzMuReYHaxvua5wetPgD6oE4tXgPTQZS-Ii39mcUTW9XbIs6Y=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/vvh-ryJMzMcFDGDEdfv92jiWjAn-Gw7B5nFLA314RKMG-sp82TQEJEzciOHX_F8zFko"
          -getUrl(): string: "https://play-lh.googleusercontent.com/vvh-ryJMzMcFDGDEdfv92jiWjAn-Gw7B5nFLA314RKMG-sp82TQEJEzciOHX_F8zFko"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/vvh-ryJMzMcFDGDEdfv92jiWjAn-Gw7B5nFLA314RKMG-sp82TQEJEzciOHX_F8zFko=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.1398363
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "10 000 000+"
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
array:117 [
    0 => class Nelexa\GPlay\Model\App {
      -getId(): string: "org.khanacademy.android"
      -getLocale(): string: "ru_RU"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=org.khanacademy.android"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=org.khanacademy.android&hl=ru_RU&gl=us"
      -getName(): string: "Khan Academy"
      -getDescription(): string: """
        You can learn anything. For free.\n
        \n
        Spend an afternoon brushing up on statistics. Discover how the Krebs cycle works. Get a head start on next semester…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "Khan Academy"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/TpK0AcjPn5-XDKgSZ5jAob1H7MsQuJILOMR4M4QYkTt5CBPgTJVr7mysrKM6Ia8SrX8"
        -getUrl(): string: "https://play-lh.googleusercontent.com/TpK0AcjPn5-XDKgSZ5jAob1H7MsQuJILOMR4M4QYkTt5CBPgTJVr7mysrKM6Ia8SrX8"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/TpK0AcjPn5-XDKgSZ5jAob1H7MsQuJILOMR4M4QYkTt5CBPgTJVr7mysrKM6Ia8SrX8=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:21 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/PXIsGEzRrYDqBoQBFUJ974YnhN3ZM7dwyTIBz_HQsr34we2Zo07st7eSKuLEeyYNy58"
          -getUrl(): string: "https://play-lh.googleusercontent.com/PXIsGEzRrYDqBoQBFUJ974YnhN3ZM7dwyTIBz_HQsr34we2Zo07st7eSKuLEeyYNy58"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/PXIsGEzRrYDqBoQBFUJ974YnhN3ZM7dwyTIBz_HQsr34we2Zo07st7eSKuLEeyYNy58=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/wCNs_buIVMJuf0oDFYPLswTpNIL7T9ylcIxruo5dcQz3DkBM0WqFeF8VnDB9xss1eQ"
          -getUrl(): string: "https://play-lh.googleusercontent.com/wCNs_buIVMJuf0oDFYPLswTpNIL7T9ylcIxruo5dcQz3DkBM0WqFeF8VnDB9xss1eQ"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/wCNs_buIVMJuf0oDFYPLswTpNIL7T9ylcIxruo5dcQz3DkBM0WqFeF8VnDB9xss1eQ=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.3420167
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "10 000 000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\App {
      -getId(): string: "smsr.com.cw"
      -getLocale(): string: "ru_RU"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=smsr.com.cw"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=smsr.com.cw&hl=ru_RU&gl=us"
      -getName(): string: "Обратный отсчет виджет"
      -getDescription(): string: """
        Обратный отсчет дней виджет / Счетчик дней это бесплатное приложение, которое напоминает Вам о важных датах и событиях в вашей жизни, Вам не нужно вру…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "SMSROBOT LTD"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/7jdy2-FrcvJXTB5zARXSszm9yl2-vfd3Lh9h92NeEUMl7mnx0ILseUsNA9fImo-zzXo"
        -getUrl(): string: "https://play-lh.googleusercontent.com/7jdy2-FrcvJXTB5zARXSszm9yl2-vfd3Lh9h92NeEUMl7mnx0ILseUsNA9fImo-zzXo"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/7jdy2-FrcvJXTB5zARXSszm9yl2-vfd3Lh9h92NeEUMl7mnx0ILseUsNA9fImo-zzXo=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:24 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/FfVFdSy8llsMoc4ZcaogZZN419t79f0w-9jIWS1pPMcXw-3AZnifY5W7iGv2aGcRZtk"
          -getUrl(): string: "https://play-lh.googleusercontent.com/FfVFdSy8llsMoc4ZcaogZZN419t79f0w-9jIWS1pPMcXw-3AZnifY5W7iGv2aGcRZtk"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/FfVFdSy8llsMoc4ZcaogZZN419t79f0w-9jIWS1pPMcXw-3AZnifY5W7iGv2aGcRZtk=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/z1MIbBt3KeGCFogbYbXB5O5U2xAnSiMN3yxS_nCWK7Ji2MW4nHCg2u55zUtM5NxnXZ0"
          -getUrl(): string: "https://play-lh.googleusercontent.com/z1MIbBt3KeGCFogbYbXB5O5U2xAnSiMN3yxS_nCWK7Ji2MW4nHCg2u55zUtM5NxnXZ0"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/z1MIbBt3KeGCFogbYbXB5O5U2xAnSiMN3yxS_nCWK7Ji2MW4nHCg2u55zUtM5NxnXZ0=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.530501
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "5 000 000+"
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
array:27 [
    0 => class Nelexa\GPlay\Model\ClusterPage {
      -getTitle(): string: "Popular apps"
      -getUrl(): string: "https://play.google.com/store/apps/collection/cluster?gsr=ShwSFwoCCAEQBBoLQVBQTElDQVRJT04qAggB-AEA:S:ANO1ljLOWNs"
    }
    1 => class Nelexa\GPlay\Model\ClusterPage {
      -getTitle(): string: "Low on space?"
      -getUrl(): string: "https://play.google.com/store/apps/collection/cluster?gsr=SmoKZQodChlwcm9tb3Rpb25fMzAwMTg1OF9sb3dfYXBrEAISPgo6bmV3X2hvbWVfZGV2aWNlX2ZlYXR1cmVkX3JlY3My…"
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
array:20 [
    0 => class Nelexa\GPlay\Model\ClusterPage {
      -getTitle(): string: "Top-rated games"
      -getUrl(): string: "https://play.google.com/store/apps/collection/cluster?clp=ogoXCAkSC0dBTUVfUFVaWkxFKgIIB1ICCAE%3D:S:ANO1ljIIXE4&gsr=ChqiChcICRILR0FNRV9QVVpaTEUqAggHUgI…"
    }
    1 => class Nelexa\GPlay\Model\ClusterPage {
      -getTitle(): string: "Recommended for you"
      -getUrl(): string: "https://play.google.com/store/apps/collection/cluster?clp=ogoXCAESC0dBTUVfUFVaWkxFKgIIB1ICCAE%3D:S:ANO1ljKwRMs&gsr=ChqiChcIARILR0FNRV9QVVpaTEUqAggHUgI…"
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
    1 => "maps go"
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
array:30 [
    0 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.google.android.apps.maps"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.maps"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.apps.maps&hl=en_US&gl=us"
      -getName(): string: "Google Maps"
      -getDescription(): string: """
        Navigate your world faster and easier with Google Maps. Over 220 countries and territories mapped and hundreds of millions of businesses and places on…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "Google LLC"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/Kf8WTct65hFJxBUDm5E-EpYsiDoLQiGGbnuyP6HBNax43YShXti9THPon1YKB6zPYpA"
        -getUrl(): string: "https://play-lh.googleusercontent.com/Kf8WTct65hFJxBUDm5E-EpYsiDoLQiGGbnuyP6HBNax43YShXti9THPon1YKB6zPYpA"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/Kf8WTct65hFJxBUDm5E-EpYsiDoLQiGGbnuyP6HBNax43YShXti9THPon1YKB6zPYpA=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:31 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/FK7X8M1BCF0Ji6-TkHaww2qP8FEdIrvofW6qDRMCNjszqq5XiVmGNCV00KXSSuETMS8"
          -getUrl(): string: "https://play-lh.googleusercontent.com/FK7X8M1BCF0Ji6-TkHaww2qP8FEdIrvofW6qDRMCNjszqq5XiVmGNCV00KXSSuETMS8"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/FK7X8M1BCF0Ji6-TkHaww2qP8FEdIrvofW6qDRMCNjszqq5XiVmGNCV00KXSSuETMS8=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/PJkiXQiABQxpVdHMpvOux53wP2TVuYg0fq9K5JYYDO336nvbX-0ShhHWzZGnagmWlw"
          -getUrl(): string: "https://play-lh.googleusercontent.com/PJkiXQiABQxpVdHMpvOux53wP2TVuYg0fq9K5JYYDO336nvbX-0ShhHWzZGnagmWlw"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/PJkiXQiABQxpVdHMpvOux53wP2TVuYg0fq9K5JYYDO336nvbX-0ShhHWzZGnagmWlw=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 3.9432514
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "10,000,000,000+"
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
      -getDescription(): string: """
        Google Maps Go is the lightweight Progressive Web App variation of the original Google Maps app, now with navigation support!\n
        \n
        This version requires C…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "Google LLC"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/0uRNRSe4iS6nhvfbBcoScHcBTx1PMmxkCx8rrEsI2UQcQeZ5ByKz8fkhwRqR3vttOg"
        -getUrl(): string: "https://play-lh.googleusercontent.com/0uRNRSe4iS6nhvfbBcoScHcBTx1PMmxkCx8rrEsI2UQcQeZ5ByKz8fkhwRqR3vttOg"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/0uRNRSe4iS6nhvfbBcoScHcBTx1PMmxkCx8rrEsI2UQcQeZ5ByKz8fkhwRqR3vttOg=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:8 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/3vPSgESCm8Js8Rc4aQpyhTW4jDw1c2Byo5-GqJvOZK-ZLCxM4uUw04cQ_BqtEXbmQ2k"
          -getUrl(): string: "https://play-lh.googleusercontent.com/3vPSgESCm8Js8Rc4aQpyhTW4jDw1c2Byo5-GqJvOZK-ZLCxM4uUw04cQ_BqtEXbmQ2k"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/3vPSgESCm8Js8Rc4aQpyhTW4jDw1c2Byo5-GqJvOZK-ZLCxM4uUw04cQ_BqtEXbmQ2k=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/DroqcHHG9bjFKR9DxP8iNQI_ziraiu8aVH-FoHmJNN0ex9hA5BmC5MA3DOOdqojYCI0D"
          -getUrl(): string: "https://play-lh.googleusercontent.com/DroqcHHG9bjFKR9DxP8iNQI_ziraiu8aVH-FoHmJNN0ex9hA5BmC5MA3DOOdqojYCI0D"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/DroqcHHG9bjFKR9DxP8iNQI_ziraiu8aVH-FoHmJNN0ex9hA5BmC5MA3DOOdqojYCI0D=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.3651714
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "500,000,000+"
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
array:1286 [
    "com.ea.game.nfs14_row" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.ea.game.nfs14_row"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.ea.game.nfs14_row"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.ea.game.nfs14_row&hl=en_US&gl=us"
      -getName(): string: "Need for Speed™ No Limits"
      -getDescription(): string: """
        Claim the crown and rule the underground as you race for dominance in the first white-knuckle edition of Need for Speed made just for mobile – from th…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "ELECTRONIC ARTS"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/jR32DXa15ObFAKr1KTL46qY8DZA5UUWK-qz_Ji4pu_Z-Ue-uQOunCY6GW9VRoVvgYQ"
        -getUrl(): string: "https://play-lh.googleusercontent.com/jR32DXa15ObFAKr1KTL46qY8DZA5UUWK-qz_Ji4pu_Z-Ue-uQOunCY6GW9VRoVvgYQ"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/jR32DXa15ObFAKr1KTL46qY8DZA5UUWK-qz_Ji4pu_Z-Ue-uQOunCY6GW9VRoVvgYQ=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:12 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/YIPVKEX-vldJN9ZAyFTaT05Qf53tq90MBZLfrQqaE_C6MZ7kzlloS01EBMkhWixcUvk"
          -getUrl(): string: "https://play-lh.googleusercontent.com/YIPVKEX-vldJN9ZAyFTaT05Qf53tq90MBZLfrQqaE_C6MZ7kzlloS01EBMkhWixcUvk"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/YIPVKEX-vldJN9ZAyFTaT05Qf53tq90MBZLfrQqaE_C6MZ7kzlloS01EBMkhWixcUvk=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/aKXKOVc6-ejZoXMcraRjPBxkreHKI_f95Y6j-JARGhj-j2qs6ma6l_g2WWKjsrCQDmc"
          -getUrl(): string: "https://play-lh.googleusercontent.com/aKXKOVc6-ejZoXMcraRjPBxkreHKI_f95Y6j-JARGhj-j2qs6ma6l_g2WWKjsrCQDmc"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/aKXKOVc6-ejZoXMcraRjPBxkreHKI_f95Y6j-JARGhj-j2qs6ma6l_g2WWKjsrCQDmc=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.3578167
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "100,000,000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    "com.skgames.trafficrider" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.skgames.trafficrider"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.skgames.trafficrider"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.skgames.trafficrider&hl=en_US&gl=us"
      -getName(): string: "Traffic Rider"
      -getDescription(): string: """
        Another masterpiece from the creators of Traffic Racer. This time, you are behind the wheels of a motorbike in a much more detailed gaming experience,…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "Soner Kara"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/590AflDt-hW2t85Cit_ODJPJdRiMMRn2cSF0vYNfsBpjm895x1zDy0npbD7IlDCvmNvI"
        -getUrl(): string: "https://play-lh.googleusercontent.com/590AflDt-hW2t85Cit_ODJPJdRiMMRn2cSF0vYNfsBpjm895x1zDy0npbD7IlDCvmNvI"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/590AflDt-hW2t85Cit_ODJPJdRiMMRn2cSF0vYNfsBpjm895x1zDy0npbD7IlDCvmNvI=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:18 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/9r6683uXT-9FUsHDxEewq7rjWGJM4si0wVHUPWV3qk334V50PscxGXhCJ3P8BTAWObk"
          -getUrl(): string: "https://play-lh.googleusercontent.com/9r6683uXT-9FUsHDxEewq7rjWGJM4si0wVHUPWV3qk334V50PscxGXhCJ3P8BTAWObk"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/9r6683uXT-9FUsHDxEewq7rjWGJM4si0wVHUPWV3qk334V50PscxGXhCJ3P8BTAWObk=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/IQB8k1MwuRpuo3Ns9k77nXxOasPhSmHMCVhL7zEfL0iWBbzS5fQ4Byx8bwJsQM0aDfYC"
          -getUrl(): string: "https://play-lh.googleusercontent.com/IQB8k1MwuRpuo3Ns9k77nXxOasPhSmHMCVhL7zEfL0iWBbzS5fQ4Byx8bwJsQM0aDfYC"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/IQB8k1MwuRpuo3Ns9k77nXxOasPhSmHMCVhL7zEfL0iWBbzS5fQ4Byx8bwJsQM0aDfYC=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.2793527
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "100,000,000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    …
  ]
```

</details>

**Example 1. Gets applications from the FAMILY_ACTION category with an age limit of 6-8 years.**
```php
$apps = $gplay->getListApps(
    $category = \Nelexa\GPlay\Enum\CategoryEnum::FAMILY_ACTION(),
    $ageLimit = \Nelexa\GPlay\Enum\AgeEnum::SIX_EIGHT(),
    $limit = 100
);
```
<details>
  <summary>Results</summary>

```php
array:100 [
    "com.imayi.trainbuilderfree" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.imayi.trainbuilderfree"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.imayi.trainbuilderfree"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.imayi.trainbuilderfree&hl=en_US&gl=us"
      -getName(): string: "Train Builder - Games for kids"
      -getDescription(): string: """
        Assemble your own unique train! Experience the fun of driving! Pick up fruits from the farm, get your favorite animals from the zoo, and don’t forget …
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "Yateland - Learning Games For Kids"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/HHmaZwsT0_KhM1NZguKUJaBWQ6ycEaMF_UIi3omN2LhKxLB9EUlyOPlKg6XiHa6zmQ"
        -getUrl(): string: "https://play-lh.googleusercontent.com/HHmaZwsT0_KhM1NZguKUJaBWQ6ycEaMF_UIi3omN2LhKxLB9EUlyOPlKg6XiHa6zmQ"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/HHmaZwsT0_KhM1NZguKUJaBWQ6ycEaMF_UIi3omN2LhKxLB9EUlyOPlKg6XiHa6zmQ=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:18 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/pXWq7snZUlu0_NUY6IxmWANpkSX_7wVs43iM_XP0m0auX3GqqjF-vvph5QjqkjME_vYc"
          -getUrl(): string: "https://play-lh.googleusercontent.com/pXWq7snZUlu0_NUY6IxmWANpkSX_7wVs43iM_XP0m0auX3GqqjF-vvph5QjqkjME_vYc"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/pXWq7snZUlu0_NUY6IxmWANpkSX_7wVs43iM_XP0m0auX3GqqjF-vvph5QjqkjME_vYc=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/3Cx1GAaFpVxww1qTyGz7nYnqEmrkcAcBbLKNSRzkSa0zOEgCpSLEDsxHLL_d6MLF3m0i"
          -getUrl(): string: "https://play-lh.googleusercontent.com/3Cx1GAaFpVxww1qTyGz7nYnqEmrkcAcBbLKNSRzkSa0zOEgCpSLEDsxHLL_d6MLF3m0i"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/3Cx1GAaFpVxww1qTyGz7nYnqEmrkcAcBbLKNSRzkSa0zOEgCpSLEDsxHLL_d6MLF3m0i=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.18
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "1,000,000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    "com.imayi.monstertruckgofree" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.imayi.monstertruckgofree"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.imayi.monstertruckgofree"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.imayi.monstertruckgofree&hl=en_US&gl=us"
      -getName(): string: "Monster Truck Games for kids"
      -getDescription(): string: """
        VVRROOOM! Time to race in the big monster truck rally! \n
        \n
        Race over obstacles and across beautiful landscapes on your way to the finish line. Choose fr…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "Yateland - Learning Games For Kids"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/xT5t0ExiuD0Hu_3Q7KmGrQvnvNGofqzx_eXThtN2lw3BDw-m8u1dKR_Ix_vs_4DtxcM"
        -getUrl(): string: "https://play-lh.googleusercontent.com/xT5t0ExiuD0Hu_3Q7KmGrQvnvNGofqzx_eXThtN2lw3BDw-m8u1dKR_Ix_vs_4DtxcM"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/xT5t0ExiuD0Hu_3Q7KmGrQvnvNGofqzx_eXThtN2lw3BDw-m8u1dKR_Ix_vs_4DtxcM=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:23 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/w7ZEGbDZ5xhDzS7YUCXKVGJ6nFiNTKBVd611ggv_W2pjbkpeXBP-WiZet7zKh1EORQ"
          -getUrl(): string: "https://play-lh.googleusercontent.com/w7ZEGbDZ5xhDzS7YUCXKVGJ6nFiNTKBVd611ggv_W2pjbkpeXBP-WiZet7zKh1EORQ"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/w7ZEGbDZ5xhDzS7YUCXKVGJ6nFiNTKBVd611ggv_W2pjbkpeXBP-WiZet7zKh1EORQ=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/_KjZA3k2ENftAXItu84QnvxNCwv_8juVUHJdQPpJu8s45dN_ulSHArtU38-y-_dtiEE"
          -getUrl(): string: "https://play-lh.googleusercontent.com/_KjZA3k2ENftAXItu84QnvxNCwv_8juVUHJdQPpJu8s45dN_ulSHArtU38-y-_dtiEE"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/_KjZA3k2ENftAXItu84QnvxNCwv_8juVUHJdQPpJu8s45dN_ulSHArtU38-y-_dtiEE=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.254464
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "1,000,000+"
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
array:1435 [
    "com.snapchat.android" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.snapchat.android"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.snapchat.android"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.snapchat.android&hl=en_US&gl=us"
      -getName(): string: "Snapchat"
      -getDescription(): string: """
        Snapchat is a fast and fun way to share the moment with your friends and family 👻\n
        \n
        SNAP \n
        • Snapchat opens right to the Camera — just tap to take a pho…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "Snap Inc"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/KxeSAjPTKliCErbivNiXrd6cTwfbqUJcbSRPe_IBVK_YmwckfMRS1VIHz-5cgT09yMo"
        -getUrl(): string: "https://play-lh.googleusercontent.com/KxeSAjPTKliCErbivNiXrd6cTwfbqUJcbSRPe_IBVK_YmwckfMRS1VIHz-5cgT09yMo"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/KxeSAjPTKliCErbivNiXrd6cTwfbqUJcbSRPe_IBVK_YmwckfMRS1VIHz-5cgT09yMo=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:8 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/xKCYMMuIshGmxLVckXnGYsdorvBxF0oI58Yt82Vkj_cn3Dby52gdrt4Lmr7BTYiVww"
          -getUrl(): string: "https://play-lh.googleusercontent.com/xKCYMMuIshGmxLVckXnGYsdorvBxF0oI58Yt82Vkj_cn3Dby52gdrt4Lmr7BTYiVww"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/xKCYMMuIshGmxLVckXnGYsdorvBxF0oI58Yt82Vkj_cn3Dby52gdrt4Lmr7BTYiVww=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/yoN8h1j4M0Axz1UK2-iyPOmlQmIHqZ1tO8p7PjRicfmyPxj3-rztyB3YImG58zeMvOI"
          -getUrl(): string: "https://play-lh.googleusercontent.com/yoN8h1j4M0Axz1UK2-iyPOmlQmIHqZ1tO8p7PjRicfmyPxj3-rztyB3YImG58zeMvOI"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/yoN8h1j4M0Axz1UK2-iyPOmlQmIHqZ1tO8p7PjRicfmyPxj3-rztyB3YImG58zeMvOI=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.211082
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "1,000,000,000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    "com.netflix.mediaclient" => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.netflix.mediaclient"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.netflix.mediaclient"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.netflix.mediaclient&hl=en_US&gl=us"
      -getName(): string: "Netflix"
      -getDescription(): string: """
        Looking for the most talked about TV shows and movies from the around the world? They’re all on Netflix.\n
        \n
        We’ve got award-winning series, movies, docu…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "Netflix, Inc."
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/TBRwjS_qfJCSj1m7zZB93FnpJM5fSpMA_wUlFDLxWAb45T9RmwBvQd5cWR5viJJOhkI"
        -getUrl(): string: "https://play-lh.googleusercontent.com/TBRwjS_qfJCSj1m7zZB93FnpJM5fSpMA_wUlFDLxWAb45T9RmwBvQd5cWR5viJJOhkI"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/TBRwjS_qfJCSj1m7zZB93FnpJM5fSpMA_wUlFDLxWAb45T9RmwBvQd5cWR5viJJOhkI=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:24 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/m7mg_DZ1uTb6jfGewOOtZ4ejmDaBYfEWZVfEP0pkSX60OsoG7YDgjuFLPCCc6rBnYJk"
          -getUrl(): string: "https://play-lh.googleusercontent.com/m7mg_DZ1uTb6jfGewOOtZ4ejmDaBYfEWZVfEP0pkSX60OsoG7YDgjuFLPCCc6rBnYJk"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/m7mg_DZ1uTb6jfGewOOtZ4ejmDaBYfEWZVfEP0pkSX60OsoG7YDgjuFLPCCc6rBnYJk=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/K4-4tkQJD0U0H_FiAn5yHz_-9Y8bP6f1tGCmFtYwBzn-5Gk1AM8Ga4S3c0T6s4ex_HI"
          -getUrl(): string: "https://play-lh.googleusercontent.com/K4-4tkQJD0U0H_FiAn5yHz_-9Y8bP6f1tGCmFtYwBzn-5Gk1AM8Ga4S3c0T6s4ex_HI"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/K4-4tkQJD0U0H_FiAn5yHz_-9Y8bP6f1tGCmFtYwBzn-5Gk1AM8Ga4S3c0T6s4ex_HI=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.451842
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "1,000,000,000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    …
  ]
```

</details>



### GPlayApps::getTopSellingFreeApps [[docs]](classes/GPlayApps/gplayapps.gettopsellingfreeapps.md)
Returns an array of **top selling free apps** from the Google Play store for the specified category.

**Example 1. Gets top selling free apps by category.**
```php
$apps = $gplay->getTopSellingFreeApps(\Nelexa\GPlay\Enum\CategoryEnum::GAME_RACING());
```
<details>
  <summary>Results</summary>

```php
array:500 [
    0 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.easygames.race"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.easygames.race"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.easygames.race&hl=en_US&gl=us"
      -getName(): string: "Race Master 3D - Car Racing"
      -getDescription(): string: """
        🏎️ Race Master 3D – Fast, furious and super-fun racing \n
        \n
        Keep your finger to the floor and be ready for absolutely anything in this ridiculously enter…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "SayGames Ltd"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/qW1SrW0Gyr3JRMNrTqMjFwcvZVjLP6-Wp2tDY8Z9UWzf2_XteCit8n9CNEGpnHOEFS8"
        -getUrl(): string: "https://play-lh.googleusercontent.com/qW1SrW0Gyr3JRMNrTqMjFwcvZVjLP6-Wp2tDY8Z9UWzf2_XteCit8n9CNEGpnHOEFS8"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/qW1SrW0Gyr3JRMNrTqMjFwcvZVjLP6-Wp2tDY8Z9UWzf2_XteCit8n9CNEGpnHOEFS8=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:15 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/XUsmpo5uQIT9nqVf-N7xJdzKVlQVTmi1UCwHjvNE-4Uw-d3iX98EoFrjeYE8CKKUlMU"
          -getUrl(): string: "https://play-lh.googleusercontent.com/XUsmpo5uQIT9nqVf-N7xJdzKVlQVTmi1UCwHjvNE-4Uw-d3iX98EoFrjeYE8CKKUlMU"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/XUsmpo5uQIT9nqVf-N7xJdzKVlQVTmi1UCwHjvNE-4Uw-d3iX98EoFrjeYE8CKKUlMU=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/1y_bSspylmUF9HtyZkpYI2RrSM6WhheloT781-1JU9OsOumxgluvt8eSCuUJC6q6o-4"
          -getUrl(): string: "https://play-lh.googleusercontent.com/1y_bSspylmUF9HtyZkpYI2RrSM6WhheloT781-1JU9OsOumxgluvt8eSCuUJC6q6o-4"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/1y_bSspylmUF9HtyZkpYI2RrSM6WhheloT781-1JU9OsOumxgluvt8eSCuUJC6q6o-4=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.4214983
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "100,000,000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.uuyu.carflygame"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.uuyu.carflygame"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.uuyu.carflygame&hl=en_US&gl=us"
      -getName(): string: "Crashing Cars"
      -getDescription(): string: """
        Crashing Cars is a super fun racing game with extreme freedom.\n
        Endless possibilities: remodel your ride, fly, perform rolls, and create destruction!\n
        T…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "Meiosei Game Studio"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/n16yk0-rt2flzOsB6cTJFI6IhCJI1Wak9TsURiOCwBC7_-f3QHDuNeJzXUs-_KA2_Cw"
        -getUrl(): string: "https://play-lh.googleusercontent.com/n16yk0-rt2flzOsB6cTJFI6IhCJI1Wak9TsURiOCwBC7_-f3QHDuNeJzXUs-_KA2_Cw"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/n16yk0-rt2flzOsB6cTJFI6IhCJI1Wak9TsURiOCwBC7_-f3QHDuNeJzXUs-_KA2_Cw=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:15 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/DXo2l3ZAy06vOTtDRlTQ_3XQD-ajFiiRrJ1QOFz9pVbraS9zcTUXqOU9NX4c640WdZOH"
          -getUrl(): string: "https://play-lh.googleusercontent.com/DXo2l3ZAy06vOTtDRlTQ_3XQD-ajFiiRrJ1QOFz9pVbraS9zcTUXqOU9NX4c640WdZOH"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/DXo2l3ZAy06vOTtDRlTQ_3XQD-ajFiiRrJ1QOFz9pVbraS9zcTUXqOU9NX4c640WdZOH=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/drxUPNz8HJvNW2pbmTQNAFFjug6J-CV_VfUFfiuSSrbjUfGExwFkKKc1v0YyTWIt7jw"
          -getUrl(): string: "https://play-lh.googleusercontent.com/drxUPNz8HJvNW2pbmTQNAFFjug6J-CV_VfUFfiuSSrbjUfGExwFkKKc1v0YyTWIt7jw"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/drxUPNz8HJvNW2pbmTQNAFFjug6J-CV_VfUFfiuSSrbjUfGExwFkKKc1v0YyTWIt7jw=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 2.6601942
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "500,000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    …
  ]
```

</details>



### GPlayApps::getTopSellingPaidApps [[docs]](classes/GPlayApps/gplayapps.gettopsellingpaidapps.md)
Returns an array of **top selling paid apps** from the Google Play store for the specified category.

**Example 1. Gets top selling paid apps by category.**
```php
$apps = $gplay->getTopSellingPaidApps(\Nelexa\GPlay\Enum\CategoryEnum::GAME_RACING());
```
<details>
  <summary>Results</summary>

```php
array:38 [
    0 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.ea.games.nfs13_na"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.ea.games.nfs13_na"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.ea.games.nfs13_na&hl=en_US&gl=us"
      -getName(): string: "Need for Speed Most Wanted"
      -getDescription(): string: """
        Google Play Special Offer - Get over 80% off for a limited time only!\n
        \n
        “The graphics are absolutely awesome” (Eurogamer.es)\n
        \n
        “It pushes the mobile pla…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "ELECTRONIC ARTS"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/E0yjOHksPFKkjALyEth4SzpWE_ynsCj5o9w9kIP5zm7QBzbVjF4pUOifiU_q2ecWZplU"
        -getUrl(): string: "https://play-lh.googleusercontent.com/E0yjOHksPFKkjALyEth4SzpWE_ynsCj5o9w9kIP5zm7QBzbVjF4pUOifiU_q2ecWZplU"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/E0yjOHksPFKkjALyEth4SzpWE_ynsCj5o9w9kIP5zm7QBzbVjF4pUOifiU_q2ecWZplU=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:7 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/59zYhJsE3XhzzvQQRSOnIoMssQ6kPJbGaW6fzCC5LgHmmo9K5DXVGJnWWZg6-QV3bg"
          -getUrl(): string: "https://play-lh.googleusercontent.com/59zYhJsE3XhzzvQQRSOnIoMssQ6kPJbGaW6fzCC5LgHmmo9K5DXVGJnWWZg6-QV3bg"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/59zYhJsE3XhzzvQQRSOnIoMssQ6kPJbGaW6fzCC5LgHmmo9K5DXVGJnWWZg6-QV3bg=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/syir6zy2llwJYDt7OyO-SgalgKvLbYXXSTDDtZT4oRekf9D41Haz-D2rvD7gFq5eK85N"
          -getUrl(): string: "https://play-lh.googleusercontent.com/syir6zy2llwJYDt7OyO-SgalgKvLbYXXSTDDtZT4oRekf9D41Haz-D2rvD7gFq5eK85N"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/syir6zy2llwJYDt7OyO-SgalgKvLbYXXSTDDtZT4oRekf9D41Haz-D2rvD7gFq5eK85N=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 3.9224076
      -getPriceText(): ?string: "$4.99"
      -isFree(): bool: false
      -getInstallsText(): string: "1,000,000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.digitaldreamlabs.retrodrive"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.digitaldreamlabs.retrodrive"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.digitaldreamlabs.retrodrive&hl=en_US&gl=us"
      -getName(): string: "Overdrive 2.6 Relaunched by Digital Dream Labs"
      -getDescription(): string: """
        Digital Dream Labs is proud to present Overdrive 2.6, back by popular demand! This version of Overdrive reverts some of the most current changes back …
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "Digital Dream Labs, Inc."
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/0IEK2PVOicsQIqiKggQRX5JvqSzohlaSG4bIlf4ntG66d0tHCHlJQqnnERJnm1HFc_jE"
        -getUrl(): string: "https://play-lh.googleusercontent.com/0IEK2PVOicsQIqiKggQRX5JvqSzohlaSG4bIlf4ntG66d0tHCHlJQqnnERJnm1HFc_jE"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/0IEK2PVOicsQIqiKggQRX5JvqSzohlaSG4bIlf4ntG66d0tHCHlJQqnnERJnm1HFc_jE=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:5 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/dK_HMrqJbDcwvvTClixDdfxkcatvK0JnS_wW6sFoK7aoNBAMWtp-pLXTQ1z0bbemZW8"
          -getUrl(): string: "https://play-lh.googleusercontent.com/dK_HMrqJbDcwvvTClixDdfxkcatvK0JnS_wW6sFoK7aoNBAMWtp-pLXTQ1z0bbemZW8"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/dK_HMrqJbDcwvvTClixDdfxkcatvK0JnS_wW6sFoK7aoNBAMWtp-pLXTQ1z0bbemZW8=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/XpBHKJBh7HL65S_v_R-nOQ9dCNwsW9-u-oa4Vgs4QnrvftoeYDNe1KlVn202lqjZFw"
          -getUrl(): string: "https://play-lh.googleusercontent.com/XpBHKJBh7HL65S_v_R-nOQ9dCNwsW9-u-oa4Vgs4QnrvftoeYDNe1KlVn202lqjZFw"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/XpBHKJBh7HL65S_v_R-nOQ9dCNwsW9-u-oa4Vgs4QnrvftoeYDNe1KlVn202lqjZFw=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 1.95
      -getPriceText(): ?string: "$2.99"
      -isFree(): bool: false
      -getInstallsText(): string: "10,000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    …
  ]
```

</details>



### GPlayApps::getTopGrossingApps [[docs]](classes/GPlayApps/gplayapps.gettopgrossingapps.md)
Returns an array of **top grossing apps** from the Google Play store for the specified category.

**Example 1. Gets top grossing free apps by category.**
```php
$apps = $gplay->getTopGrossingApps(\Nelexa\GPlay\Enum\CategoryEnum::GAME_RACING());
```
<details>
  <summary>Results</summary>

```php
array:500 [
    0 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.naturalmotion.customstreetracer2"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.naturalmotion.customstreetracer2"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.naturalmotion.customstreetracer2&hl=en_US&gl=us"
      -getName(): string: "CSR 2 - Drag Racing Car Games"
      -getDescription(): string: """
        CSR2 is a real driving simulator that delivers hyper-real drag racing to the palm of your hand. In its 3rd iteration after CSR Racing and CSR Classics…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "NaturalMotionGames Ltd"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/fzkDKGJ3eoQQ7ZfpmQXQO30NRBVXqGORVgKOTcE9jUugLGoX3vCuL9Qix1vNn3CeBQ"
        -getUrl(): string: "https://play-lh.googleusercontent.com/fzkDKGJ3eoQQ7ZfpmQXQO30NRBVXqGORVgKOTcE9jUugLGoX3vCuL9Qix1vNn3CeBQ"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/fzkDKGJ3eoQQ7ZfpmQXQO30NRBVXqGORVgKOTcE9jUugLGoX3vCuL9Qix1vNn3CeBQ=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:15 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/ZxGvJWP4tm3de5IA3ksXaqDVhxL77bRMBMltoAU3Tz8lUodNnJS9-silrfkDtrxNPDw"
          -getUrl(): string: "https://play-lh.googleusercontent.com/ZxGvJWP4tm3de5IA3ksXaqDVhxL77bRMBMltoAU3Tz8lUodNnJS9-silrfkDtrxNPDw"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/ZxGvJWP4tm3de5IA3ksXaqDVhxL77bRMBMltoAU3Tz8lUodNnJS9-silrfkDtrxNPDw=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/toJnhyt42hquoNsd20L8Xxh9-0ZkDLYGwj2u30uodnrsERBFpoPWRIKPjimtIsfLFik"
          -getUrl(): string: "https://play-lh.googleusercontent.com/toJnhyt42hquoNsd20L8Xxh9-0ZkDLYGwj2u30uodnrsERBFpoPWRIKPjimtIsfLFik"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/toJnhyt42hquoNsd20L8Xxh9-0ZkDLYGwj2u30uodnrsERBFpoPWRIKPjimtIsfLFik=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.5836105
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "50,000,000+"
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\App {
      -getId(): string: "com.ea.game.nfs14_row"
      -getLocale(): string: "en_US"
      -getCountry(): string: "us"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.ea.game.nfs14_row"
      -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.ea.game.nfs14_row&hl=en_US&gl=us"
      -getName(): string: "Need for Speed™ No Limits"
      -getDescription(): string: """
        Claim the crown and rule the underground as you race for dominance in the first white-knuckle edition of Need for Speed made just for mobile – from th…
        """
      -getSummary(): ?string: null
      -getDeveloper(): ?Nelexa\GPlay\Model\Developer: null
      -getDeveloperName(): ?string: "ELECTRONIC ARTS"
      -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
        -__toString(): string: "https://play-lh.googleusercontent.com/jR32DXa15ObFAKr1KTL46qY8DZA5UUWK-qz_Ji4pu_Z-Ue-uQOunCY6GW9VRoVvgYQ"
        -getUrl(): string: "https://play-lh.googleusercontent.com/jR32DXa15ObFAKr1KTL46qY8DZA5UUWK-qz_Ji4pu_Z-Ue-uQOunCY6GW9VRoVvgYQ"
        -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/jR32DXa15ObFAKr1KTL46qY8DZA5UUWK-qz_Ji4pu_Z-Ue-uQOunCY6GW9VRoVvgYQ=s0"
        -getBinaryImageContent(): string: …
      }
      -getScreenshots(): array: array:12 [
        0 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/YIPVKEX-vldJN9ZAyFTaT05Qf53tq90MBZLfrQqaE_C6MZ7kzlloS01EBMkhWixcUvk"
          -getUrl(): string: "https://play-lh.googleusercontent.com/YIPVKEX-vldJN9ZAyFTaT05Qf53tq90MBZLfrQqaE_C6MZ7kzlloS01EBMkhWixcUvk"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/YIPVKEX-vldJN9ZAyFTaT05Qf53tq90MBZLfrQqaE_C6MZ7kzlloS01EBMkhWixcUvk=s0"
          -getBinaryImageContent(): string: …
        }
        1 => class Nelexa\GPlay\Model\GoogleImage {
          -__toString(): string: "https://play-lh.googleusercontent.com/aKXKOVc6-ejZoXMcraRjPBxkreHKI_f95Y6j-JARGhj-j2qs6ma6l_g2WWKjsrCQDmc"
          -getUrl(): string: "https://play-lh.googleusercontent.com/aKXKOVc6-ejZoXMcraRjPBxkreHKI_f95Y6j-JARGhj-j2qs6ma6l_g2WWKjsrCQDmc"
          -getOriginalSizeUrl(): string: "https://play-lh.googleusercontent.com/aKXKOVc6-ejZoXMcraRjPBxkreHKI_f95Y6j-JARGhj-j2qs6ma6l_g2WWKjsrCQDmc=s0"
          -getBinaryImageContent(): string: …
        }
        …
      ]
      -getScore(): float: 4.3578386
      -getPriceText(): ?string: null
      -isFree(): bool: true
      -getInstallsText(): string: "100,000,000+"
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
      -getUrl(): string: "https://play-lh.googleusercontent.com/VcMpf4HOZEGOZl11sHgJ85FTg006NG1lnnjqsUQEYfkJ6eog4wVi8aQktQI9zXnXoA=s700"
      -getFilename(): string: "screenshots/d9/12/d912cbd91cdb547b33720009ea703a7b.png"
      -getMimeType(): string: "image/png"
      -getExtension(): string: "png"
      -getWidth(): int: 394
      -getHeight(): int: 700
      -getFilesize(): int: 318706
      -asArray(): array: …
      -jsonSerialize(): array: …
    }
    1 => class Nelexa\GPlay\Model\ImageInfo {
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
