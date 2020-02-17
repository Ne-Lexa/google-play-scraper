[Documentation](../../README.md) > **GPlayApps**

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
  -getScore(): float: 4.2702456
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
  -getInstalls(): int: 7031586741
  -getHistogramRating(): Nelexa\GPlay\Model\HistogramRating: {
    -getFiveStars(): int: 46293839
    -getFourStars(): int: 6604000
    -getThreeStars(): int: 4119923
    -getTwoStars(): int: 2102244
    -getOneStar(): int: 6725025
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
  -getUpdated(): ?DateTimeInterface: @1581726651 {
    date: 2020-02-15T00:30:51+00:00
  }
  -getNumberVoters(): int: 65845033
  -getNumberReviews(): int: 22662148
  -getReviews(): array:4 [
    0 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOFv5o4-aYf5iNfp3rzCH_aMGwnydc81bauwOmvDufGH-q2Soghj4xy-uu0bgycvTEHCz-dYexkiDjQerA"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.youtube&reviewId=gp%3AAOqpTOFv5o4-aYf5iNfp3rzCH_aMGwnydc81bauwOmvDufGH-q2Soghj4xy-uu0…"
      -getUserName(): string: "Armada Main De Feer"
      -getText(): string: "Il y a moins de 5 ans YouTube était très bien, lecture de vidéo lorsque le téléphone est éteint, très peu de pub ou des pub indiqué dès le début de la…"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/-lyBtSOmBK-Q/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rdBBfAB8BXTby_LQ6V0tzUMNvQUAw/s64/"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/-lyBtSOmBK-Q/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rdBBfAB8BXTby_LQ6V0tzUMNvQUAw/s0/"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/-lyBtSOmBK-Q/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rdBBfAB8BXTby_LQ6V0tzUMNvQUAw/s64/"
      }
      -getDate(): ?DateTimeInterface: @1581718360 {
        date: 2020-02-14T22:12:40+00:00
      }
      -getScore(): int: 2
      -getCountLikes(): int: 79
      -getReply(): ?Nelexa\GPlay\Model\ReplyReview: null
      -asArray(): array: …
      -jsonSerialize(): mixed: …
    }
    1 => class Nelexa\GPlay\Model\Review {
      -getId(): string: "gp:AOqpTOG6NjEMVtgqVenK24PtboizUULevM-aX1iE_ttsompnAGT7VhpK_tRMyQ5p-H-GvEQtq1DzXbJom-lLTA"
      -getUrl(): string: "https://play.google.com/store/apps/details?id=com.google.android.youtube&reviewId=gp%3AAOqpTOG6NjEMVtgqVenK24PtboizUULevM-aX1iE_ttsompnAGT7VhpK_tRMyQ5…"
      -getUserName(): string: "Yolande Mombo"
      -getText(): string: "Trés trés bien, parce que c'est par aplication il faut le faire pour les autres aussi surtout pour la TV qui souvre mais ne veut pas me donné les émis…"
      -getAvatar(): Nelexa\GPlay\Model\GoogleImage: {
        -getUrl(): string: "https://lh3.googleusercontent.com/-QS-3y3fDnEI/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3re1NF0j8W4oumNRobHYjw3FP7_p6Q/s64/"
        -getOriginalSizeUrl(): string: "https://lh3.googleusercontent.com/-QS-3y3fDnEI/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3re1NF0j8W4oumNRobHYjw3FP7_p6Q/s0/"
        -getBinaryImageContent(): string: …
        -__toString(): string: "https://lh3.googleusercontent.com/-QS-3y3fDnEI/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3re1NF0j8W4oumNRobHYjw3FP7_p6Q/s64/"
      }
      -getDate(): ?DateTimeInterface: @1581753650 {
        date: 2020-02-15T08:00:50+00:00
      }
      -getScore(): int: 5
      -getCountLikes(): int: 21
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

[Documentation](../../README.md) > **GPlayApps**
