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
    public setCache ( Psr\SimpleCache\CacheInterface | null $cache [, DateInterval | int | null $cacheTtl = null ] ) : Nelexa\GPlay\GPlayApps
    public setCacheTtl ( DateInterval | int | null $cacheTtl ) : Nelexa\GPlay\GPlayApps
    public setConcurrency ( int $concurrency ) : Nelexa\GPlay\GPlayApps
    public setProxy ( string | null $proxy ) : Nelexa\GPlay\GPlayApps
    public getAppInfo ( string | Nelexa\GPlay\Model\AppId $appId ) : Nelexa\GPlay\Model\AppInfo
    public getAppsInfo ( string[] | Nelexa\GPlay\Model\AppId[] $appIds ) : Nelexa\GPlay\Model\AppInfo[]
    public getAppInfoForLocales ( string | Nelexa\GPlay\Model\AppId $appId , string[] $locales ) : array<string, Nelexa\GPlay\Model\AppInfo>
    public getAppInfoForAvailableLocales ( string | Nelexa\GPlay\Model\AppId $appId ) : array<string, Nelexa\GPlay\Model\AppInfo>
    public existsApp ( string | Nelexa\GPlay\Model\AppId $appId ) : bool
    public existsApps ( string[] | Nelexa\GPlay\Model\AppId[] $appIds ) : bool[]
    public getReviews ( string | Nelexa\GPlay\Model\AppId $appId [, int $limit = 100 ] [, Nelexa\GPlay\Enum\SortEnum | null $sort = null ] ) : Nelexa\GPlay\Model\Review[]
    public getReviewById ( mixed $appId , string $reviewId ) 
    public getPermissions ( string | Nelexa\GPlay\Model\AppId $appId ) : Nelexa\GPlay\Model\Permission[]
    public getCategories ( void ) : Nelexa\GPlay\Model\Category[]
    public getDeveloperInfo ( string | Nelexa\GPlay\Model\Developer | Nelexa\GPlay\Model\App $developerId ) : Nelexa\GPlay\Model\Developer
    public getDeveloperInfoForLocales ( string | Nelexa\GPlay\Model\Developer | Nelexa\GPlay\Model\App $developerId [, string[] $locales = array() ] ) : Nelexa\GPlay\Model\Developer[]
    public getDeveloperApps ( string | Nelexa\GPlay\Model\Developer | Nelexa\GPlay\Model\App $developerId ) : Nelexa\GPlay\Model\App[]
    public getClusterApps ( string $clusterPageUrl ) : \Generator<Nelexa\GPlay\Model\App>
    public getSimilarApps ( string | Nelexa\GPlay\Model\AppId $appId [, int $limit = 50 ] ) : Nelexa\GPlay\Model\App[]
    public getClusterPages ( [ string | Nelexa\GPlay\Model\Category | Nelexa\GPlay\Enum\CategoryEnum | null $category = null ] [, Nelexa\GPlay\Enum\AgeEnum | null $age = null ] ) : \Generator<Nelexa\GPlay\Model\ClusterPage>
    public getSearchSuggestions ( string $query ) : string[]
    public search ( string $query [, int $limit = 50 ] [, Nelexa\GPlay\Enum\PriceEnum | null $price = null ] ) : Nelexa\GPlay\Model\App[]
    public getListApps ( [ string | Nelexa\GPlay\Model\Category | Nelexa\GPlay\Enum\CategoryEnum | null $category = null ] [, Nelexa\GPlay\Enum\AgeEnum | null $age = null ] [, int $limit = -1 ] ) : Nelexa\GPlay\Model\App[]
    public getTopApps ( [ string | Nelexa\GPlay\Model\Category | Nelexa\GPlay\Enum\CategoryEnum | null $category = null ] [, Nelexa\GPlay\Enum\AgeEnum | null $age = null ] [, int $limit = -1 ] ) : Nelexa\GPlay\Model\App[]
    public getTopSellingFreeApps ( [ string | Nelexa\GPlay\Model\Category | Nelexa\GPlay\Enum\CategoryEnum $category = "APPLICATION" ] [, int $limit = 500 ] ) : Nelexa\GPlay\Model\App[]
    public getTopSellingPaidApps ( [ string | Nelexa\GPlay\Model\Category | Nelexa\GPlay\Enum\CategoryEnum $category = "APPLICATION" ] [, int $limit = 500 ] ) : Nelexa\GPlay\Model\App[]
    public getTopGrossingApps ( [ string | Nelexa\GPlay\Model\Category | Nelexa\GPlay\Enum\CategoryEnum $category = "APPLICATION" ] [, int $limit = 500 ] ) : Nelexa\GPlay\Model\App[]
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
$gplay = new GPlayApps();
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
  -getInstallsText(): string: "10 000 000 000+"
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
  -getDeveloperName(): mixed: "Google LLC"
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

</details>

## Table of Contents
* [Nelexa\GPlay\GPlayApps::__construct](gplayapps.__construct.md) - Creates an object to retrieve data about Android applications from the Google Play store.
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
* [Nelexa\GPlay\GPlayApps::getReviewById](gplayapps.getreviewbyid.md)
* [Nelexa\GPlay\GPlayApps::getPermissions](gplayapps.getpermissions.md) - Returns a list of permissions for the application.
* [Nelexa\GPlay\GPlayApps::getCategories](gplayapps.getcategories.md) - Returns an array of application categories from the Google Play store.
* [Nelexa\GPlay\GPlayApps::getDeveloperInfo](gplayapps.getdeveloperinfo.md) - Returns information about the developer: name, icon, cover, description and website address.
* [Nelexa\GPlay\GPlayApps::getDeveloperInfoForLocales](gplayapps.getdeveloperinfoforlocales.md) - Returns information about the developer for the specified locales.
* [Nelexa\GPlay\GPlayApps::getDeveloperApps](gplayapps.getdeveloperapps.md) - Returns an array of applications from the Google Play store by developer id.
* [Nelexa\GPlay\GPlayApps::getClusterApps](gplayapps.getclusterapps.md) - Returns an iterator of applications from the Google Play store for the specified cluster page.
* [Nelexa\GPlay\GPlayApps::getSimilarApps](gplayapps.getsimilarapps.md) - Returns an array of similar applications with basic information about them in the Google Play store.
* [Nelexa\GPlay\GPlayApps::getClusterPages](gplayapps.getclusterpages.md) - Returns an iterator of cluster pages.
* [Nelexa\GPlay\GPlayApps::getSearchSuggestions](gplayapps.getsearchsuggestions.md) - Returns the Google Play search suggests.
* [Nelexa\GPlay\GPlayApps::search](gplayapps.search.md) - Returns a list of applications from the Google Play store for a search query.
* [Nelexa\GPlay\GPlayApps::getListApps](gplayapps.getlistapps.md) - Returns an array of applications from the Google Play store for the specified category.
* [Nelexa\GPlay\GPlayApps::getTopApps](gplayapps.gettopapps.md) - Returns an array of **top apps** from the Google Play store for the specified category.
* [Nelexa\GPlay\GPlayApps::getTopSellingFreeApps](gplayapps.gettopsellingfreeapps.md) - Returns an array of **top selling free apps** from the Google Play store for the specified category.
* [Nelexa\GPlay\GPlayApps::getTopSellingPaidApps](gplayapps.gettopsellingpaidapps.md) - Returns an array of **top selling paid apps** from the Google Play store for the specified category.
* [Nelexa\GPlay\GPlayApps::getTopGrossingApps](gplayapps.gettopgrossingapps.md) - Returns an array of **top grossing apps** from the Google Play store for the specified category.
* [Nelexa\GPlay\GPlayApps::getNewApps](gplayapps.getnewapps.md) - Returns an array of **new apps** from the Google Play store for the specified category.
* [Nelexa\GPlay\GPlayApps::saveGoogleImages](gplayapps.savegoogleimages.md) - Asynchronously saves images from googleusercontent.com and similar URLs to disk.
* [Nelexa\GPlay\GPlayApps::getDefaultLocale](gplayapps.getdefaultlocale.md) - Returns the locale (language) of the requests.
* [Nelexa\GPlay\GPlayApps::setDefaultLocale](gplayapps.setdefaultlocale.md) - Sets the locale (language) of requests.
* [Nelexa\GPlay\GPlayApps::getDefaultCountry](gplayapps.getdefaultcountry.md) - Returns the country of the requests.
* [Nelexa\GPlay\GPlayApps::setDefaultCountry](gplayapps.setdefaultcountry.md) - Sets the country of requests.
* [Nelexa\GPlay\GPlayApps::setConnectTimeout](gplayapps.setconnecttimeout.md) - Sets the number of seconds to wait when trying to connect to the server.
* [Nelexa\GPlay\GPlayApps::setTimeout](gplayapps.settimeout.md) - Sets the timeout of the request in second.

[Documentation](../../README.md) > **GPlayApps**
