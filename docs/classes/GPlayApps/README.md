# The `Nelexa\GPlay\GPlayApps` class

## Introduction
Contains methods for extracting information about Android applications from the Google Play store.

## Class synopsis
```php
Nelexa\GPlay\GPlayApps {

    /* Constants */
    const string DEFAULT_LOCALE = "en_US" ;
    const string DEFAULT_COUNTRY = "us" ;
    const string GOOGLE_PLAY_URL = "https://play.google.com" ;
    const string GOOGLE_PLAY_APPS_URL = "https://play.google.com/store/apps" ;
    const int UNLIMIT = -1 ;

    /* Methods */
    public __construct ( [ string $locale = "en_US" ] [, string $country = "us" ] ) 
    public setCache ( cacheInterface | null $cache [, DateInterval | int | null $cacheTtl = null ] ) : Nelexa\GPlay\GPlayApps
    public setCacheTtl ( DateInterval | int | null $cacheTtl ) : Nelexa\GPlay\GPlayApps
    public setConcurrency ( int $concurrency ) : Nelexa\GPlay\GPlayApps
    public setProxy ( string | null $proxy ) : Nelexa\GPlay\GPlayApps
    public getAppInfo ( string | Nelexa\GPlay\Model\AppId $appId ) : Nelexa\GPlay\Model\AppInfo
    public getAppsInfo ( string[] | Nelexa\GPlay\Model\AppId[] $appIds ) : Nelexa\GPlay\Model\AppInfo[]
    public getAppInfoForLocales ( string | Nelexa\GPlay\Model\AppId $appId , string[] $locales ) : Nelexa\GPlay\Model\AppInfo[]
    public getAppInfoForAvailableLocales ( string | Nelexa\GPlay\Model\AppId $appId ) : Nelexa\GPlay\Model\AppInfo[]
    public existsApp ( string | Nelexa\GPlay\Model\AppId $appId ) : bool
    public existsApps ( string[] | Nelexa\GPlay\Model\AppId[] $appIds ) : bool[]
    public getReviews ( string | Nelexa\GPlay\Model\AppId $appId [, int $limit = 100 ] [, Nelexa\GPlay\Enum\SortEnum | null $sort = null ] ) : Nelexa\GPlay\Model\Review[]
    public getReviewById ( string | Nelexa\GPlay\Model\AppId $appId , string $reviewId ) : Nelexa\GPlay\Model\Review
    public getPermissions ( string | Nelexa\GPlay\Model\AppId $appId ) : Nelexa\GPlay\Model\Permission[]
    public getCategories ( void ) : Nelexa\GPlay\Model\Category[]
    public getCategoriesForLocales ( string[] $locales ) : Nelexa\GPlay\Model\Category[][]
    public getCategoriesForAvailableLocales ( void ) : Nelexa\GPlay\Model\Category[][]
    public getDeveloperInfo ( string | Nelexa\GPlay\Model\Developer | Nelexa\GPlay\Model\App $developerId ) : Nelexa\GPlay\Model\Developer
    public getDeveloperInfoForLocales ( string | Nelexa\GPlay\Model\Developer | Nelexa\GPlay\Model\App $developerId [, string[] $locales = array() ] ) : Nelexa\GPlay\Model\Developer[]
    public getDeveloperApps ( string | Nelexa\GPlay\Model\Developer | Nelexa\GPlay\Model\App $developerId ) : Nelexa\GPlay\Model\App[]
    public getSimilarApps ( string | Nelexa\GPlay\Model\AppId $appId [, int $limit = 50 ] ) : Nelexa\GPlay\Model\App[]
    public getSearchSuggestions ( string $query ) : string[]
    public search ( string $query [, int $limit = 50 ] [, Nelexa\GPlay\Enum\PriceEnum | null $price = null ] ) : Nelexa\GPlay\Model\App[]
    public getListApps ( [ string | Nelexa\GPlay\Model\Category | Nelexa\GPlay\Enum\CategoryEnum | null $category = null ] [, Nelexa\GPlay\Enum\AgeEnum | null $age = null ] [, int $limit = -1 ] ) : Nelexa\GPlay\Model\App[]
    public getTopApps ( [ string | Nelexa\GPlay\Model\Category | Nelexa\GPlay\Enum\CategoryEnum | null $category = null ] [, Nelexa\GPlay\Enum\AgeEnum | null $age = null ] [, int $limit = -1 ] ) : Nelexa\GPlay\Model\App[]
    public getNewApps ( [ string | Nelexa\GPlay\Model\Category | Nelexa\GPlay\Enum\CategoryEnum | null $category = null ] [, Nelexa\GPlay\Enum\AgeEnum | null $age = null ] [, int $limit = -1 ] ) : Nelexa\GPlay\Model\App[]
    public saveGoogleImages ( Nelexa\GPlay\Model\GoogleImage[] $images , callable $destPathCallback [, bool $overwrite = false ] ) : Nelexa\GPlay\Model\ImageInfo[]
    public getDefaultLocale ( void ) : string
    public setDefaultLocale ( string $defaultLocale ) : Nelexa\GPlay\GPlayApps
    public getDefaultCountry ( void ) : string
    public setDefaultCountry ( string $defaultCountry ) : Nelexa\GPlay\GPlayApps
    public setConnectTimeout ( float $connectTimeout ) : Nelexa\GPlay\GPlayApps
    public setTimeout ( float $timeout ) : Nelexa\GPlay\GPlayApps
}
```

## Predefined Constants
* **`Nelexa\GPlay\GPlayApps::DEFAULT_LOCALE`**  (`"en_US"`)  
Default request locale.

* **`Nelexa\GPlay\GPlayApps::DEFAULT_COUNTRY`**  (`"us"`)  
Default request country.

* **`Nelexa\GPlay\GPlayApps::GOOGLE_PLAY_URL`**  (`"https://play.google.com"`)  
Google Play base url.

* **`Nelexa\GPlay\GPlayApps::GOOGLE_PLAY_APPS_URL`**  (`"https://play.google.com/store/apps"`)  
Google Play apps url.

* **`Nelexa\GPlay\GPlayApps::UNLIMIT`**  (`-1`)  
Unlimit results.


## Examples
```php
// PSR-16 Simple Cache
$cache = new \Symfony\Component\Cache\Psr16Cache(
    new \Symfony\Component\Cache\Adapter\RedisAdapter(
        \Symfony\Component\Cache\Adapter\RedisAdapter::createConnection('redis://localhost'),
        'gplay.v1'
    )
);

// initial
$gplay = new \Nelexa\GPlay\GPlayApps();
$gplay
    ->setDefaultLocale('fr_CA')
    ->setDefaultCountry('ca')
    ->setCache($cache, \DateInterval::createFromDateString('1 hour'))
    ->setConcurrency(8)
    ->setProxy(null)
    ->setTimeout(10)
    ->setConnectTimeout(10)
;

// get detail app info
$appInfo = $gplay->getAppInfo('com.google.android.youtube');
```
<details>
  <summary>Results</summary>

```php
class Nelexa\GPlay\Model\AppInfo {
  -getId(): string: "com.google.android.youtube"
  -getLocale(): string: "fr_CA"
  -getCountry(): string: "ca"
  -getUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.youtube"
  -getFullUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.youtube&hl=fr_CA&gl=ca"
  -getName(): string: "YouTube"
  -getSummary(): ?string: "Regardez vos vidéos, chaînes et playlists préférées où que vous soyez."
  -getDeveloper(): Nelexa\GPlay\Model\Developer: {
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
    -jsonSerialize(): mixed: …
  }
  -getIcon(): Nelexa\GPlay\Model\GoogleImage: {
    -getUrl(): string: "https://lh3.googleusercontent.com/lMoItBgdPPVDJsNOVtP26EKHePkwBg-PkuY9NOrc-fumRtTFP4XhpUNk_22syN4Datc"
    -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/lMoItBgdPPVDJsNOVtP26EKHePkwBg-PkuY9NOrc-fumRtTFP4XhpUNk_22syN4Datc=s0"
    -getBinaryImageContent(): string: …
    -__toString(): string: "https://lh3.googleusercontent.com/lMoItBgdPPVDJsNOVtP26EKHePkwBg-PkuY9NOrc-fumRtTFP4XhpUNk_22syN4Datc"
  }
  -getScore(): float: 4.2718096
  -getPriceText(): ?string: null
  -isFree(): bool: true
  -jsonSerialize(): mixed: …
  -getDescription(): string: """
    Téléchargez l'application officielle YouTube pour les téléphones et tablettes Android. Découvrez les contenus regardés partout dans le monde : clips m…
    """
  -isAutoTranslatedDescription(): bool: false
  -getTranslatedFromLocale(): ?string: null
  -getCover(): ?Nelexa\GPlay\Model\GoogleImage: {
    -getUrl(): string: "https://lh3.googleusercontent.com/vA4tG0v4aasE7oIvRIvTkOYTwom07DfqHdUPr6k7jmrDwy_qA_SonqZkw6KX0OXKAdk"
    -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/vA4tG0v4aasE7oIvRIvTkOYTwom07DfqHdUPr6k7jmrDwy_qA_SonqZkw6KX0OXKAdk=s0"
    -getBinaryImageContent(): string: …
    -__toString(): string: "https://lh3.googleusercontent.com/vA4tG0v4aasE7oIvRIvTkOYTwom07DfqHdUPr6k7jmrDwy_qA_SonqZkw6KX0OXKAdk"
  }
  -getScreenshots(): array:5 [
    0 => class Nelexa\GPlay\Model\GoogleImage {
      -getUrl(): string: "https://lh3.googleusercontent.com/8AL1NgPKQQ6HIeoIi4T0rro7N0lar315QIlGTzjFtOcBT1tdXjE3ERmADq7AIcmpHg"
      -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/8AL1NgPKQQ6HIeoIi4T0rro7N0lar315QIlGTzjFtOcBT1tdXjE3ERmADq7AIcmpHg=s0"
      -getBinaryImageContent(): string: …
      -__toString(): string: "https://lh3.googleusercontent.com/8AL1NgPKQQ6HIeoIi4T0rro7N0lar315QIlGTzjFtOcBT1tdXjE3ERmADq7AIcmpHg"
    }
    1 => class Nelexa\GPlay\Model\GoogleImage {
      -getUrl(): string: "https://lh3.googleusercontent.com/pMASxj8kBdFtDOeaHQ2vI4_MoLFlI0CCTjeTuXugQVBdGIEbLebkivMRgkt1wcflyKTc"
      -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/pMASxj8kBdFtDOeaHQ2vI4_MoLFlI0CCTjeTuXugQVBdGIEbLebkivMRgkt1wcflyKTc=s0"
      -getBinaryImageContent(): string: …
      -__toString(): string: "https://lh3.googleusercontent.com/pMASxj8kBdFtDOeaHQ2vI4_MoLFlI0CCTjeTuXugQVBdGIEbLebkivMRgkt1wcflyKTc"
    }
    …
  ]
  -getCategory(): Nelexa\GPlay\Model\Category: {
    -getId(): string: "VIDEO_PLAYERS"
    -getName(): string: "Lecteurs vidéo et éditeurs"
    -isGamesCategory(): bool: false
    -isFamilyCategory(): bool: false
    -isApplicationCategory(): bool: true
    -asArray(): array: …
    -jsonSerialize(): mixed: …
  }
  -getCategoryFamily(): ?Nelexa\GPlay\Model\Category: null
  -getVideo(): ?Nelexa\GPlay\Model\Video: null
  -getRecentChanges(): ?string: "Pour plus d'informations sur les nouvelles fonctionnalités et leur utilisation, consultez la documentation et les notifications intégrées au produit."
  -isEditorsChoice(): bool: true
  -getInstalls(): int: 7013548647
  -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
    -getFiveStars(): int: 46190797
    -getFourStars(): int: 6620150
    -getThreeStars(): int: 4116962
    -getTwoStars(): int: 2094322
    -getOneStar(): int: 6675930
    -asArray(): array: …
    -jsonSerialize(): mixed: …
  }
  -getPrice(): float: 0.0
  -getCurrency(): string: "USD"
  -isContainsIAP(): bool: false
  -getOffersIAPCost(): ?string: null
  -isContainsAds(): bool: true
  -getSize(): ?string: null
  -getAppVersion(): ?string: null
  -getAndroidVersion(): ?string: null
  -getMinAndroidVersion(): ?string: null
  -getContentRating(): ?string: "Adolescents"
  -getPrivacyPoliceUrl(): ?string: "http://www.google.com/policies/privacy"
  -getReleased(): ?DateTimeInterface: @1287532800 {
    date: 2010-10-20T00:00:00+00:00
  }
  -getUpdated(): ?DateTimeInterface: @1581539535 {
    date: 2020-02-12T20:32:15+00:00
  }
  -getNumberVoters(): int: 65698164
  -getNumberReviews(): int: 22599743
  -getReviews(): array:4 [
    0 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOGNJB2tiexHU1kXkxMdcWDbUzNfODnJAKh4Os_1Ip3lJxAO0FMI5LJDI6gsyhHqjk_p2iI_Yx5XVIGuHQ"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.youtube&reviewId=gp%3AAOqpTOGNJB2tiexHU1kXkxMdcWDbUzNfODnJAKh4Os_1Ip3lJxAO0FMI5LJDI6g…"
      -getUserName(): string: "Georges Vouilloz"
      -getText(): string: "Depuis la dernière version 15.04.56, il me semble, un problème magistral de sécurité apparaît. Si par malheur, vous «liker» ou commenter une vidéo, vo…"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/-wdgzHOQaOkg/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3reGV0DPON6ENaOMmi10qr0Vld8aug/s64/"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/-wdgzHOQaOkg/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3reGV0DPON6ENaOMmi10qr0Vld8aug/s0/"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/-wdgzHOQaOkg/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3reGV0DPON6ENaOMmi10qr0Vld8aug/s64/"
      }
      -getDate(): ?DateTimeInterface: @1580816830 {
        date: 2020-02-04T11:47:10+00:00
      }
      -getScore(): int: 2
      -getCountLikes(): int: 585
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    1 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOGjeAI4UiSjr8bCjxaBZBVdTgptr5XmBa7u1jFB9cnqqm1XCRp58_-C_ouf1iX_LYPH0aiuI4m-TUm1Rw"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.youtube&reviewId=gp%3AAOqpTOGjeAI4UiSjr8bCjxaBZBVdTgptr5XmBa7u1jFB9cnqqm1XCRp58_-C_ou…"
      -getUserName(): string: "Derdre Schildzer"
      -getText(): string: "On ne peut pas mettre l'écran en veille sans que YouTube s'arrête = Gaspillage d'énergie. les concepteurs sont sans imagination et sans bon sens. la l…"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mAVbFM_SXSu8AlfEi4bTeQ1qKrcvDVQqMjNkBiC=s64"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/a-/AAuE7mAVbFM_SXSu8AlfEi4bTeQ1qKrcvDVQqMjNkBiC=s0"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/a-/AAuE7mAVbFM_SXSu8AlfEi4bTeQ1qKrcvDVQqMjNkBiC=s64"
      }
      -getDate(): ?DateTimeInterface: @1581427833 {
        date: 2020-02-11T13:30:33+00:00
      }
      -getScore(): int: 1
      -getCountLikes(): int: 121
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

## Table of Contents
* [Nelexa\GPlay\GPlayApps::__construct](gplayapps.construct.md) - Creates an object to retrieve data about Android applications from the Google Play store.
* [Nelexa\GPlay\GPlayApps::setCache](gplayapps.setcache.md) - Sets caching for HTTP requests.
* [Nelexa\GPlay\GPlayApps::setCacheTtl](gplayapps.setcachettl.md) - Sets cache ttl.
* [Nelexa\GPlay\GPlayApps::setConcurrency](gplayapps.setconcurrency.md) - Sets the limit of concurrent HTTP requests.
* [Nelexa\GPlay\GPlayApps::setProxy](gplayapps.setproxy.md) - Sets proxy for outgoing HTTP requests.
* [Nelexa\GPlay\GPlayApps::getAppInfo](gplayapps.getappinfo.md) - Returns the full detail of an application.
* [Nelexa\GPlay\GPlayApps::getAppsInfo](gplayapps.getappsinfo.md) - Returns the full detail of multiple applications.
* [Nelexa\GPlay\GPlayApps::getAppInfoForLocales](gplayapps.getappinfoforlocales.md) - Returns the full details of an application in multiple languages.
* [Nelexa\GPlay\GPlayApps::getAppInfoForAvailableLocales](gplayapps.getappinfoforavailablelocales.md) - Returns detailed application information for all available locales.
* [Nelexa\GPlay\GPlayApps::existsApp](gplayapps.existsapp.md) - Checks if the specified application exists in the Google Play store.
* [Nelexa\GPlay\GPlayApps::existsApps](gplayapps.existsapps.md) - Checks if the specified applications exist in the Google Play store.
* [Nelexa\GPlay\GPlayApps::getReviews](gplayapps.getreviews.md) - Returns reviews of the Android app in the Google Play store.
* [Nelexa\GPlay\GPlayApps::getReviewById](gplayapps.getreviewbyid.md) - Returns review of the Android app in the Google Play store by review id.
* [Nelexa\GPlay\GPlayApps::getPermissions](gplayapps.getpermissions.md) - Returns a list of permissions for the application.
* [Nelexa\GPlay\GPlayApps::getCategories](gplayapps.getcategories.md) - Returns an array of application categories from the Google Play store.
* [Nelexa\GPlay\GPlayApps::getCategoriesForLocales](gplayapps.getcategoriesforlocales.md) - Returns an array of application categories from the Google Play store for the specified locales.
* [Nelexa\GPlay\GPlayApps::getCategoriesForAvailableLocales](gplayapps.getcategoriesforavailablelocales.md) - Returns an array of categories from the Google Play store for all available locales.
* [Nelexa\GPlay\GPlayApps::getDeveloperInfo](gplayapps.getdeveloperinfo.md) - Returns information about the developer: name, icon, cover, description and website address.
* [Nelexa\GPlay\GPlayApps::getDeveloperInfoForLocales](gplayapps.getdeveloperinfoforlocales.md) - Returns information about the developer for the specified locales.
* [Nelexa\GPlay\GPlayApps::getDeveloperApps](gplayapps.getdeveloperapps.md) - Returns an array of applications from the Google Play store by developer id.
* [Nelexa\GPlay\GPlayApps::getSimilarApps](gplayapps.getsimilarapps.md) - Returns an array of similar applications with basic information about them in the Google Play store.
* [Nelexa\GPlay\GPlayApps::getSearchSuggestions](gplayapps.getsearchsuggestions.md) - Returns the Google Play search suggests.
* [Nelexa\GPlay\GPlayApps::search](gplayapps.search.md) - Returns a list of applications from the Google Play store for a search query.
* [Nelexa\GPlay\GPlayApps::getListApps](gplayapps.getlistapps.md) - Returns an array of applications from the Google Play store for the specified category.
* [Nelexa\GPlay\GPlayApps::getTopApps](gplayapps.gettopapps.md) - Returns an array of **top apps** from the Google Play store for the specified category.
* [Nelexa\GPlay\GPlayApps::getNewApps](gplayapps.getnewapps.md) - Returns an array of **new apps** from the Google Play store for the specified category.
* [Nelexa\GPlay\GPlayApps::saveGoogleImages](gplayapps.savegoogleimages.md) - Asynchronously saves images from googleusercontent.com and similar URLs to disk.
* [Nelexa\GPlay\GPlayApps::getDefaultLocale](gplayapps.getdefaultlocale.md) - Returns the locale (language) of the requests.
* [Nelexa\GPlay\GPlayApps::setDefaultLocale](gplayapps.setdefaultlocale.md) - Sets the locale (language) of requests.
* [Nelexa\GPlay\GPlayApps::getDefaultCountry](gplayapps.getdefaultcountry.md) - Returns the country of the requests.
* [Nelexa\GPlay\GPlayApps::setDefaultCountry](gplayapps.setdefaultcountry.md) - Sets the country of requests.
* [Nelexa\GPlay\GPlayApps::setConnectTimeout](gplayapps.setconnecttimeout.md) - Sets the number of seconds to wait when trying to connect to the server.
* [Nelexa\GPlay\GPlayApps::setTimeout](gplayapps.settimeout.md) - Sets the timeout of the request in second.


