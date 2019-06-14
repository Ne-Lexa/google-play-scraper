<?php
declare(strict_types=1);

/**
 * @author   Ne-Lexa
 * @license  MIT
 * @link     https://github.com/Ne-Lexa/google-play-scraper
 */

namespace Nelexa\GPlay;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Promise\EachPromise;
use GuzzleHttp\Promise\FulfilledPromise;
use GuzzleHttp\RequestOptions;
use Nelexa\GPlay\Enum\AgeEnum;
use Nelexa\GPlay\Enum\CategoryEnum;
use Nelexa\GPlay\Enum\CollectionEnum;
use Nelexa\GPlay\Enum\PriceEnum;
use Nelexa\GPlay\Enum\SortEnum;
use Nelexa\GPlay\Exception\GooglePlayException;
use Nelexa\GPlay\Http\HttpClient;
use Nelexa\GPlay\Model\App;
use Nelexa\GPlay\Model\AppDetail;
use Nelexa\GPlay\Model\AppId;
use Nelexa\GPlay\Model\Category;
use Nelexa\GPlay\Model\Developer;
use Nelexa\GPlay\Model\GoogleImage;
use Nelexa\GPlay\Model\ImageInfo;
use Nelexa\GPlay\Model\Permission;
use Nelexa\GPlay\Model\Review;
use Nelexa\GPlay\Scraper\AppDetailScraper;
use Nelexa\GPlay\Scraper\CategoriesScraper;
use Nelexa\GPlay\Scraper\CategoryAppsScraper;
use Nelexa\GPlay\Scraper\ClusterAppsScraper;
use Nelexa\GPlay\Scraper\DeveloperInfoScraper;
use Nelexa\GPlay\Scraper\ExistsAppScraper;
use Nelexa\GPlay\Scraper\FindDevAppsUrlScraper;
use Nelexa\GPlay\Scraper\FindSimilarAppsUrlScraper;
use Nelexa\GPlay\Scraper\PermissionScraper;
use Nelexa\GPlay\Scraper\PlayStoreUiAppsScraper;
use Nelexa\GPlay\Scraper\PlayStoreUiRequest;
use Nelexa\GPlay\Scraper\ReviewsScraper;
use Nelexa\GPlay\Scraper\SuggestScraper;
use Nelexa\GPlay\Util\LocaleHelper;
use Psr\Http\Message\ResponseInterface;
use Psr\SimpleCache\CacheInterface;

/**
 * Contains methods for extracting information from the Google Play store.
 */
class GPlayApps
{
    /** @var string default request locale */
    public const DEFAULT_LOCALE = 'en_US';

    /** @var string default request country */
    public const DEFAULT_COUNTRY = 'us';

    /** @var string Google Play base url */
    public const GOOGLE_PLAY_URL = 'https://play.google.com';

    /** @var string Google Play apps url */
    public const GOOGLE_PLAY_APPS_URL = self::GOOGLE_PLAY_URL . '/store/apps';

    /** @var int Maximum number of search results (Google limit). */
    public const MAX_SEARCH_RESULTS = 250;

    /** @var int Limit for all available results. */
    public const UNLIMIT = -1;

    /** @internal */
    public const REQ_PARAM_LOCALE = 'hl';

    /** @internal */
    public const REQ_PARAM_COUNTRY = 'gl';

    /** @internal */
    public const REQ_PARAM_ID = 'id';

    /** @var int Limit of parallel HTTP requests */
    protected $concurrency = 4;

    /** @var string Locale (language) for HTTP requests to Google Play */
    protected $locale;

    /** @var string Country for HTTP requests to Google Play */
    protected $country;

    /**
     * Creates an object to retrieve data about Android applications from the Google Play store.
     *
     * @param string $locale Locale (language) for HTTP requests to Google Play
     *     or {@see \Nelexa\GPlay\GPlayApps::DEFAULT_LOCALE}.
     * @param string $country Country for HTTP requests to Google Play
     *     or {@see \Nelexa\GPlay\GPlayApps::DEFAULT_COUNTRY}.
     *
     * @see \Nelexa\GPlay\GPlayApps::DEFAULT_LOCALE Default locale
     * @see \Nelexa\GPlay\GPlayApps::DEFAULT_COUNTRY Default country
     */
    public function __construct(
        string $locale = self::DEFAULT_LOCALE,
        string $country = self::DEFAULT_COUNTRY
    ) {
        $this
            ->setLocale($locale)
            ->setCountry($country);
    }

    /**
     * Sets caching for HTTP requests.
     *
     * @param CacheInterface|null $cache PSR-16 Simple Cache instance.
     * @param \DateInterval|int|null $cacheTtl TTL cached data.
     *
     * @return GPlayApps Returns an object of its own class to support the call chain.
     */
    public function setCache(?CacheInterface $cache, $cacheTtl = null): GPlayApps
    {
        $this->getHttpClient()
            ->setCache($cache)
            ->setCacheTtl($cacheTtl);
        return $this;
    }

    /**
     * Returns an instance of HTTP client.
     *
     * @return HttpClient Http Client.
     */
    protected function getHttpClient(): HttpClient
    {
        static $httpClient;
        if ($httpClient === null) {
            $httpClient = new HttpClient();
        }
        return $httpClient;
    }

    /**
     * Sets the limit of concurrent HTTP requests.
     *
     * @param int $concurrency Maximum number of concurrent HTTP requests.
     *
     * @return GPlayApps Returns an object of its own class to support the call chain.
     */
    public function setConcurrency(int $concurrency): GPlayApps
    {
        $this->concurrency = max(1, $concurrency);
        return $this;
    }

    /**
     * Sets proxy for outgoing HTTP requests.
     *
     * @param string|null $proxy Proxy url, ex. socks5://127.0.0.1:9050 or https://116.90.233.2:47348
     *
     * @return GPlayApps Returns an object of its own class to support the call chain.
     *
     * @see https://curl.haxx.se/libcurl/c/CURLOPT_PROXY.html Description of proxy URL formats in CURL.
     */
    public function setProxy(?string $proxy): GPlayApps
    {
        $this->getHttpClient()->setProxy($proxy);
        return $this;
    }

    /**
     * Returns detailed information about the Android application from the Google Play store.
     *
     * For information, you must specify the application ID (android package name).
     * The application ID can be viewed in the Google Play store:
     * `https://play.google.com/store/apps/details?id=XXXXXX` , where
     * XXXXXX is the application id.
     *
     * Or it can be found in the APK file.
     * ```shell
     * aapt dump file.apk | grep package | awk '{print $2}' | sed s/name=//g | sed s/\'//g
     * ```
     *
     * @param string|AppId $appId Application ID (Android package name) as
     *     a string or {@see \Nelexa\GPlay\Model\AppId} object.
     *
     * @return AppDetail Detailed information about the Android application or exception.
     *
     * @throws GooglePlayException If the application is not exists or other HTTP error.
     */
    public function getApp($appId): AppDetail
    {
        return $this->getApps([$appId])[0];
    }

    /**
     * Returns detailed information about many android packages.
     * HTTP requests are executed in parallel.
     *
     * @param string[]|AppId[] $appIds Array of application identifiers.
     *
     * @return AppDetail[] An array of detailed information for each application.
     *     The keys of the returned array matches to the passed array.
     *
     * @throws GooglePlayException If the application is not exists or other HTTP error.
     *
     * @see GPlayApps::setConcurrency() To set the limit of parallel requests
     */
    public function getApps(array $appIds): array
    {
        if (empty($appIds)) {
            return [];
        }
        $urls = $this->getUrlListFromAppIds($appIds);
        try {
            return $this->getHttpClient()->requestAsyncPool(
                'GET',
                $urls,
                [
                    HttpClient::OPTION_HANDLER_RESPONSE => new AppDetailScraper(),
                ],
                $this->concurrency
            );
        } catch (GuzzleException $e) {
            throw new GooglePlayException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Returns an array of URLs for application identifiers.
     *
     * @param string[]|AppId[] $appIds Array of application identifiers.
     *
     * @return string[] Array of URL.
     *
     * @throws \InvalidArgumentException If application ID is empty.
     */
    protected function getUrlListFromAppIds(array $appIds): array
    {
        $urls = [];
        foreach ($appIds as $key => $appId) {
            $urls[$key] = $this->castToAppId($appId)->getFullUrl();
        }
        return $urls;
    }

    /**
     * Casts the application identifier to the {@see \Nelexa\GPlay\Model\AppId} type.
     *
     * @param string|AppId $appId Application ID.
     *
     * @return AppId Application identifier with an \Nelexa\GPlay\Model\AppId type.
     *
     * @throws \InvalidArgumentException If the application identifier is null or an invalid parameter is passed.
     */
    protected function castToAppId($appId): AppId
    {
        if ($appId === null) {
            throw new \InvalidArgumentException('Application ID is null');
        }
        if (is_string($appId)) {
            return new AppId($appId, $this->locale, $this->country);
        }
        if ($appId instanceof AppId) {
            return $appId;
        }
        throw new \InvalidArgumentException(sprintf(
            'The expected type for the $appId parameter is a string or %s.',
            AppId::class
        ));
    }

    /**
     * Returns detailed information about an application from the Google Play store
     * for an array of locales.
     * HTTP requests are executed in parallel.
     *
     * @param string|AppId $appId Application ID (Android package name) as
     *     a string or {@see \Nelexa\GPlay\Model\AppId} object.
     * @param string[] $locales Array of locales for which to load information.
     *
     * @return AppDetail[] Array of application detailed application by locale.
     *     The array key is the locale.
     *
     * @throws GooglePlayException If the application is not exists or other HTTP error.
     *
     * @see GPlayApps::setConcurrency() To set the limit of parallel requests.
     */
    public function getAppInLocales($appId, array $locales): array
    {
        $appId = $this->castToAppId($appId);
        $requests = [];
        foreach ($locales as $locale) {
            $requests[$locale] = new AppId($appId->getId(), $locale, $appId->getCountry());
        }
        return $this->getApps($requests);
    }

    /**
     * Returns detailed information about the application in all
     * available locales.
     *
     * Information is returned only for the description loaded by the developer.
     * All locales with automated translation from Google Translate will be ignored.
     * HTTP requests are executed in parallel.
     *
     * @param string|AppId $appId Application ID (Android package name) as
     *     a string or {@see \Nelexa\GPlay\Model\AppId} object.
     *
     * @return AppDetail[] An array with detailed information about the application
     *     on all available locales. The array key is the locale.
     *
     * @throws GooglePlayException If the application is not exists or other HTTP error.
     *
     * @see \Nelexa\GPlay\GPlayApps::setConcurrency() To set the limit of parallel requests.
     */
    public function getAppInAvailableLocales($appId): array
    {
        $list = $this->getAppInLocales($appId, LocaleHelper::SUPPORTED_LOCALES);

        $preferredLocale = self::DEFAULT_LOCALE;
        foreach ($list as $app) {
            if ($app->isAutoTranslatedDescription()) {
                $preferredLocale = $app->getTranslatedFromLocale();
                break;
            }
        }

        /**
         * @var AppDetail[] $list
         */
        $list = array_filter($list, static function (AppDetail $app) {
            return !$app->isAutoTranslatedDescription();
        });

        $preferredApp = $list[$preferredLocale];
        $list = array_filter($list, static function (AppDetail $app, string $locale) use ($preferredApp, $list) {
            // deletes locales in which there is no translation added, but automatic translation by Google Translate is used.
            if ($preferredApp->getLocale() === $locale || !$preferredApp->equals($app)) {
                if (($pos = strpos($locale, '_')) !== false) {
                    $rootLang = substr($locale, 0, $pos);
                    $rootLangLocale = LocaleHelper::getNormalizeLocale($rootLang);
                    if (
                        $rootLangLocale !== $locale &&
                        isset($list[$rootLangLocale]) &&
                        $list[$rootLangLocale]->equals($app)
                    ) {
                        // delete duplicate data,
                        // for example, delete en_CA, en_IN, en_GB, en_ZA, if there is en_US and they are equals.
                        return false;
                    }
                }
                return true;
            }
            return false;
        }, ARRAY_FILTER_USE_BOTH);

        // sorting array keys; the first key is the preferred locale
        uksort(
            $list,
            static function (
                /** @noinspection PhpUnusedParameterInspection */
                string $a,
                string $b
            ) use ($preferredLocale) {
                return $b === $preferredLocale ? 1 : 0;
            }
        );

        return $list;
    }

    /**
     * Checks if the specified application exists in the Google Play Store.
     *
     * @param string|AppId $appId Application ID (Android package name) as
     *     a string or {@see \Nelexa\GPlay\Model\AppId} object.
     *
     * @return bool Returns `true` if the application exists, or `false` if not.
     */
    public function existsApp($appId): bool
    {
        $appId = $this->castToAppId($appId);

        try {
            return (bool)$this->getHttpClient()->request(
                'HEAD',
                $appId->getFullUrl(),
                [
                    RequestOptions::HTTP_ERRORS => false,
                    HttpClient::OPTION_HANDLER_RESPONSE => new ExistsAppScraper(),
                ]
            );
        } catch (GuzzleException $e) {
            return false;
        }
    }

    /**
     * Checks if the specified applications exist in the Google Play store.
     * HTTP requests are executed in parallel.
     *
     * @param string[]|AppId[] $appIds Array of application identifiers.
     *     The keys of the returned array correspond to the transferred array.
     *
     * @return bool[] An array of information about the existence of each
     *     application in the store Google Play. The keys of the returned
     *     array matches to the passed array.
     *
     * @throws GooglePlayException If an HTTP error other than 404 is received.
     *
     * @see GPlayApps::setConcurrency() To set the limit of parallel requests.
     */
    public function existsApps(array $appIds): array
    {
        if (empty($appIds)) {
            return [];
        }
        $urls = $this->getUrlListFromAppIds($appIds);
        try {
            return $this->getHttpClient()->requestAsyncPool(
                'HEAD',
                $urls,
                [
                    RequestOptions::HTTP_ERRORS => false,
                    HttpClient::OPTION_HANDLER_RESPONSE => new ExistsAppScraper(),
                ],
                $this->concurrency
            );
        } catch (GuzzleException $e) {
            throw new GooglePlayException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Returns reviews of the Android app in the Google Play Store.
     * Getting a lot of reviews can take a lot of time.
     *
     * @param string|AppId $appId Application ID (Android package name) as
     *     a string or {@see \Nelexa\GPlay\Model\AppId} object.
     * @param int $limit Maximum number of reviews. To extract all
     *     reviews, use {@see \Nelexa\GPlay\GPlayApps::UNLIMIT}.
     * @param SortEnum|null $sort Sort reviews of the application.
     *     If null, then sort by the newest reviews.
     *
     * @return Review[] App reviews.
     *
     * @throws GooglePlayException if the application is not exists or other HTTP error.
     *
     * @see SortEnum::NEWEST() Contains all valid values ​​for the "sort" parameter.
     * @see \Nelexa\GPlay\GPlayApps::UNLIMIT Limit for all results.
     */
    public function getAppReviews($appId, int $limit = 100, ?SortEnum $sort = null): array
    {
        $appId = $this->castToAppId($appId);
        $sort = $sort ?? SortEnum::NEWEST();

        $allCount = 0;
        $token = null;
        $allReviews = [];

        $cacheTtl = $sort === SortEnum::NEWEST() ?
            \DateInterval::createFromDateString('5 min') :
            \DateInterval::createFromDateString('1 hour');

        try {
            do {
                $count = $limit === self::UNLIMIT ?
                    PlayStoreUiRequest::LIMIT_REVIEW_ON_PAGE :
                    min(PlayStoreUiRequest::LIMIT_REVIEW_ON_PAGE, max($limit - $allCount, 1));

                $request = PlayStoreUiRequest::getReviewsRequest($appId, $count, $sort, $token);

                [$reviews, $token] = $this->getHttpClient()->send(
                    $request,
                    [
                        HttpClient::OPTION_CACHE_TTL => $cacheTtl,
                        HttpClient::OPTION_HANDLER_RESPONSE => new ReviewsScraper($appId),
                    ]
                );
                $allCount += count($reviews);
                $allReviews[] = $reviews;
            } while ($token !== null && ($limit === self::UNLIMIT || $allCount < $limit));
        } catch (GuzzleException $e) {
            throw new GooglePlayException($e->getMessage(), $e->getCode(), $e);
        }

        return empty($allReviews) ? $allReviews : array_merge(...$allReviews);
    }

    /**
     * Returns an array of similar applications with basic information about
     * them in the Google Play store.
     *
     * @param string|AppId $appId Application ID (Android package name) as
     *     a string or {@see \Nelexa\GPlay\Model\AppId} object.
     * @param int $limit The maximum number of similar applications. To extract all
     *     similar applications, use {@see \Nelexa\GPlay\GPlayApps::UNLIMIT}.
     *
     * @return App[] An array of applications with basic information about them.
     *
     * @throws GooglePlayException If the application is not exists or other HTTP error.
     *
     * @see GPlayApps::UNLIMIT Limit for all results.
     */
    public function getSimilarApps($appId, int $limit = 50): array
    {
        $appId = $this->castToAppId($appId);
        try {
            /**
             * @var string|null $similarAppsUrl
             */
            $similarAppsUrl = $this->getHttpClient()->request(
                'GET',
                $appId->getFullUrl(),
                [
                    HttpClient::OPTION_HANDLER_RESPONSE => new FindSimilarAppsUrlScraper($appId),
                ]
            );
            if ($similarAppsUrl === null) {
                return [];
            }
            return $this->getAppsFromClusterPage(
                $similarAppsUrl,
                $appId->getLocale(),
                $appId->getCountry(),
                $limit
            );
        } catch (GuzzleException $e) {
            throw new GooglePlayException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Returns a list of applications with basic information.
     *
     * @param string $clusterPageUrl Cluster page URL.
     * @param string $locale Locale.
     * @param string $country Country.
     * @param int $limit Maximum number of applications. To extract all
     *     applications, use {@see \Nelexa\GPlay\GPlayApps::UNLIMIT}.
     *
     * @return App[] Array of applications with basic information about them.
     *
     * @throws GooglePlayException If the application is not exists or other HTTP error.
     *
     * @see GPlayApps::UNLIMIT Limit for all results.
     */
    protected function getAppsFromClusterPage(
        string $clusterPageUrl,
        string $locale,
        string $country,
        int $limit
    ): array {
        if ($limit < self::UNLIMIT || $limit === 0) {
            throw new \InvalidArgumentException(sprintf('Invalid limit: %d', $limit));
        }
        try {
            [$apps, $token] = $this->getHttpClient()->request(
                'GET',
                $clusterPageUrl,
                [
                    HttpClient::OPTION_HANDLER_RESPONSE => new ClusterAppsScraper(),
                ]
            );

            $allCount = count($apps);
            $allApps = [$apps];

            while ($token !== null && ($limit === self::UNLIMIT || $allCount < $limit)) {
                $count = $limit === self::UNLIMIT ?
                    PlayStoreUiRequest::LIMIT_APPS_ON_PAGE :
                    min(PlayStoreUiRequest::LIMIT_APPS_ON_PAGE, max($limit - $allCount, 1));

                $request = PlayStoreUiRequest::getAppsRequest($locale, $country, $count, $token);

                [$apps, $token] = $this->getHttpClient()->send(
                    $request,
                    [
                        HttpClient::OPTION_HANDLER_RESPONSE => new PlayStoreUiAppsScraper(),
                    ]
                );
                $allCount += count($apps);
                $allApps[] = $apps;
            }
        } catch (GuzzleException $e) {
            throw new GooglePlayException($e->getMessage(), $e->getCode(), $e);
        }
        if (empty($allApps)) {
            return $allApps;
        }
        $allApps = array_merge(...$allApps);
        if ($limit !== self::UNLIMIT) {
            $allApps = array_slice($allApps, 0, $limit);
        }
        return $allApps;
    }

    /**
     * Returns a list of permissions for the application.
     *
     * @param string|AppId $appId Application ID (Android package name) as
     *     a string or {@see \Nelexa\GPlay\Model\AppId} object.
     *
     * @return Permission[] Array of permissions for the application.
     *
     * @throws GooglePlayException If the application is not exists or other HTTP error.
     */
    public function getPermissions($appId): array
    {
        $appId = $this->castToAppId($appId);

        $url = self::GOOGLE_PLAY_URL . '/store/xhr/getdoc?authuser=0';
        try {
            return $this->getHttpClient()->request(
                'POST',
                $url,
                [
                    RequestOptions::FORM_PARAMS => [
                        'ids' => $appId->getId(),
                        self::REQ_PARAM_LOCALE => $appId->getLocale(),
                        'xhr' => 1,
                    ],
                    HttpClient::OPTION_HANDLER_RESPONSE => new PermissionScraper(),
                ]
            );
        } catch (GuzzleException $e) {
            throw new GooglePlayException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Returns an array of application categories from the Google Play store.
     *
     * @return Category[] Array of application categories.
     *
     * @throws GooglePlayException If HTTP error is received.
     */
    public function getCategories(): array
    {
        $url = self::GOOGLE_PLAY_APPS_URL;
        try {
            return $this->getHttpClient()->request(
                'GET',
                $url,
                [
                    RequestOptions::QUERY => [
                        self::REQ_PARAM_LOCALE => $this->locale,
                    ],
                    HttpClient::OPTION_HANDLER_RESPONSE => new CategoriesScraper(),
                ]
            );
        } catch (GuzzleException $e) {
            throw new GooglePlayException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Returns an array of application categories from the Google Play store for the locale array.
     * HTTP requests are executed in parallel.
     *
     * @param string[] $locales Array of locales.
     *
     * @return Category[][] Array of application categories by locale.
     *
     * @throws GooglePlayException If HTTP error is received.
     *
     * @see GPlayApps::setConcurrency() To set the limit of parallel requests.
     */
    public function getCategoriesInLocales(array $locales): array
    {
        if (empty($locales)) {
            return [];
        }
        $locales = LocaleHelper::getNormalizeLocales($locales);

        $urls = [];
        $url = self::GOOGLE_PLAY_APPS_URL;
        foreach ($locales as $locale) {
            $urls[$locale] = $url . '?' . http_build_query([
                    self::REQ_PARAM_LOCALE => $locale,
                ]);
        }

        try {
            return $this->getHttpClient()->requestAsyncPool(
                'GET',
                $urls,
                [
                    HttpClient::OPTION_HANDLER_RESPONSE => new CategoriesScraper(),
                ],
                $this->concurrency
            );
        } catch (GuzzleException $e) {
            throw new GooglePlayException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Returns an array of categories from the Google Play store for all available locales.
     *
     * @return Category[][] Array of application categories by locale.
     *
     * @throws GooglePlayException If HTTP error is received.
     *
     * @see GPlayApps::setConcurrency() To set the limit of parallel requests.
     */
    public function getCategoriesInAvailableLocales(): array
    {
        return $this->getCategoriesInLocales(LocaleHelper::SUPPORTED_LOCALES);
    }

    /**
     * Returns information about the developer: name, icon, cover, description and website address.
     *
     * @param string|Developer|App $developerId Developer id as
     *     string, {@see \Nelexa\GPlay\Model\Developer} or {@see \Nelexa\GPlay\Model\App} object.
     *
     * @return Developer Information about the application developer.
     *
     * @throws GooglePlayException If HTTP error is received.
     *
     * @see GPlayApps::getDeveloperInfoInLocales() Returns information about the developer for
     *     the locale array.
     */
    public function getDeveloperInfo($developerId): Developer
    {
        $developerId = $this->castToDeveloperId($developerId);
        if (!is_numeric($developerId)) {
            throw new GooglePlayException(sprintf(
                'Developer "%s" does not have a personalized page on Google Play.',
                $developerId
            ));
        }

        $url = self::GOOGLE_PLAY_APPS_URL . '/dev';
        try {
            return $this->getHttpClient()->request(
                'GET',
                $url,
                [
                    RequestOptions::QUERY => [
                        self::REQ_PARAM_ID => $developerId,
                        self::REQ_PARAM_LOCALE => $this->locale,
                    ],
                    HttpClient::OPTION_HANDLER_RESPONSE => new DeveloperInfoScraper(),
                ]
            );
        } catch (GuzzleException $e) {
            throw new GooglePlayException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param string|int|Developer|App|AppDetail $developerId
     * @return string
     */
    private function castToDeveloperId($developerId): string
    {
        if ($developerId instanceof App) {
            return $developerId->getDeveloper()->getId();
        }
        if ($developerId instanceof Developer) {
            return $developerId->getId();
        }
        if (is_int($developerId)) {
            return (string)$developerId;
        }
        return $developerId;
    }

    /**
     * Returns information about the developer for the locale array.
     *
     * @param string|Developer|App $developerId Developer id as
     *     string, {@see \Nelexa\GPlay\Model\Developer} or {@see \Nelexa\GPlay\Model\App} object.
     *
     * @param string[] $locales Array of locales
     *
     * @return Developer[] An array with information about the application developer
     *     for each requested locale.
     *
     * @throws GooglePlayException If HTTP error is received.
     *
     * @see GPlayApps::setConcurrency() To set the limit of parallel requests.
     * @see GPlayApps::getDeveloperInfo() Returns information about the developer: name,
     *     icon, cover, description and website address.
     */
    public function getDeveloperInfoInLocales($developerId, array $locales = []): array
    {
        if (empty($locales)) {
            return [];
        }
        $locales = LocaleHelper::getNormalizeLocales($locales);

        $id = $this->castToDeveloperId($developerId);
        if (!is_numeric($id)) {
            throw new GooglePlayException(sprintf(
                'Developer "%s" does not have a personalized page on Google Play.',
                $id
            ));
        }

        $urls = [];
        $url = self::GOOGLE_PLAY_APPS_URL . '/dev';
        foreach ($locales as $locale) {
            $urls[$locale] = $url . '?' . http_build_query([
                    self::REQ_PARAM_ID => $id,
                    self::REQ_PARAM_LOCALE => $locale,
                ]);
        }

        try {
            return $this->getHttpClient()->requestAsyncPool(
                'GET',
                $urls,
                [
                    HttpClient::OPTION_HANDLER_RESPONSE => new DeveloperInfoScraper(),
                ],
                $this->concurrency
            );
        } catch (GuzzleException $e) {
            throw new GooglePlayException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Returns an array of developer apps with basic information about them
     *     from the Google Play store.
     *
     * @param string|Developer|App $developerId Developer id as
     *     string, {@see \Nelexa\GPlay\Model\Developer} or {@see \Nelexa\GPlay\Model\App} object.
     *
     * @return App[] Array of applications with basic information about them.
     *
     * @throws GooglePlayException If HTTP error is received.
     */
    public function getDeveloperApps($developerId): array
    {
        $developerId = $this->castToDeveloperId($developerId);

        $query = [
            self::REQ_PARAM_ID => $developerId,
            self::REQ_PARAM_LOCALE => $this->locale,
            self::REQ_PARAM_COUNTRY => $this->country,
        ];

        if (is_numeric($developerId)) {
            $developerUrl = self::GOOGLE_PLAY_APPS_URL . '/dev?' . http_build_query($query);
            try {
                /**
                 * @var string|null $developerUrl
                 */
                $developerUrl = $this->getHttpClient()->request(
                    'GET',
                    $developerUrl,
                    [
                        HttpClient::OPTION_HANDLER_RESPONSE => new FindDevAppsUrlScraper(),
                    ]
                );
                if ($developerUrl === null) {
                    return [];
                }
                $developerUrl .= '&' . self::REQ_PARAM_LOCALE . '=' . urlencode($this->locale) .
                    '&' . self::REQ_PARAM_COUNTRY . '=' . urlencode($this->country);
            } catch (GuzzleException $e) {
                throw new GooglePlayException($e->getMessage(), $e->getCode(), $e);
            }
        } else {
            $developerUrl = self::GOOGLE_PLAY_APPS_URL . '/developer?' . http_build_query($query);
        }

        return $this->getAppsFromClusterPage(
            $developerUrl,
            $this->locale,
            $this->country,
            self::UNLIMIT
        );
    }

    /**
     * Returns the Google Play search suggests.
     *
     * @param string $query Search query.
     *
     * @return string[] Array containing search suggestions.
     *
     * @throws GooglePlayException If HTTP error is received.
     */
    public function getSearchSuggestions(string $query): array
    {
        $query = trim($query);
        if ($query === '') {
            return [];
        }

        $url = 'https://market.android.com/suggest/SuggRequest';
        try {
            return $this->getHttpClient()->request(
                'GET',
                $url,
                [
                    RequestOptions::QUERY => [
                        'json' => 1,
                        'c' => 3,
                        'query' => $query,
                        self::REQ_PARAM_LOCALE => $this->locale,
                        self::REQ_PARAM_COUNTRY => $this->country,
                    ],
                    HttpClient:: OPTION_HANDLER_RESPONSE => new SuggestScraper(),
                ]
            );
        } catch (GuzzleException $e) {
            throw new GooglePlayException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Returns a list of applications from the Google Play store for a search query.
     *
     * @param string $query Search query.
     * @param int $limit The limit on the number of search results.
     * @param PriceEnum|null $price Price category or `null`.
     *
     * @return App[] Array of applications with basic information about them.
     *
     * @throws GooglePlayException If HTTP error is received.
     *
     * @see PriceEnum Contains all valid values ​​for the "price" parameter.
     * @see GPlayApps::UNLIMIT Limit for all available results.
     * @see GPlayApps::MAX_SEARCH_RESULTS Maximum number of search results (Google limit).
     */
    public function search(
        string $query,
        int $limit = 50,
        ?PriceEnum $price = null
    ): array {
        $query = trim($query);
        if (empty($query)) {
            throw new \InvalidArgumentException('Search query missing');
        }
        $price = $price ?? PriceEnum::ALL();

        $params = [
            'c' => 'apps',
            'q' => $query,
            'hl' => $this->locale,
            'gl' => $this->country,
            'price' => $price->value(),
        ];
        $clusterPageUrl = self::GOOGLE_PLAY_URL . '/store/search?' . http_build_query($params);

        return $this->getAppsFromClusterPage($clusterPageUrl, $this->locale, $this->country, $limit);
    }

    /**
     * Returns a list of applications with basic information from the category and
     * collection of the Google Play store.
     *
     * @param string|Category|CategoryEnum|null $category Application category as
     *     string, {@see \Nelexa\GPlay\Model\Category}, {@see \Nelexa\GPlay\Enum\CategoryEnum}
     *     or `null`.
     * @param CollectionEnum|string $collection Application collection.
     * @param int $limit The limit on the number of results.
     * @param AgeEnum|null $age Age restrictions or `null`.
     *
     * @return App[] Array of applications with basic information about them.
     *
     * @throws GooglePlayException If HTTP error is received.
     *
     * @see CategoryEnum Contains all valid application category values.
     * @see CollectionEnum Contains all valid application collection values.
     * @see AgeEnum Contains all valid values ​​for the age parameter.
     * @see GPlayApps::getCategories() Returns an array of application categories from the Google Play store.
     */
    public function getAppsByCategory(
        $category,
        $collection,
        int $limit = 60,
        ?AgeEnum $age = null
    ): array {
        $maxOffset = 500;
        $limitOnPage = 60;
        $maxResults = $maxOffset + $limitOnPage;

        $limit = $limit === self::UNLIMIT ? $maxResults : min($maxResults, max(1, $limit));
        $collection = (string)$collection;

        $url = self::GOOGLE_PLAY_APPS_URL . '';
        if ($category !== null) {
            $url .= '/category/' . $this->castToCategoryId($category);
        }
        $url .= '/collection/' . $collection;

        $offset = 0;

        $queryParams = [
            self::REQ_PARAM_LOCALE => $this->locale,
            self::REQ_PARAM_COUNTRY => $this->country,
        ];
        if ($age !== null) {
            $queryParams['age'] = $age->value();
        }

        $results = [];
        $countResults = 0;
        $slice = 0;
        try {
            do {
                if ($offset > $maxOffset) {
                    $slice = $offset - $maxOffset;
                    $offset = $maxOffset;
                }
                $queryParams['num'] = min($limit - $offset + $slice, $limitOnPage);

                $result = $this->getHttpClient()->request(
                    'POST',
                    $url,
                    [
                        RequestOptions::QUERY => $queryParams,
                        RequestOptions::FORM_PARAMS => [
                            'start' => $offset,
                        ],
                        HttpClient::OPTION_HANDLER_RESPONSE => new CategoryAppsScraper(),
                    ]
                );
                if ($slice > 0) {
                    $result = array_slice($result, $slice);
                }
                $countResult = count($result);
                $countResults += $countResult;
                $results[] = $result;
                $offset += $countResult;
            } while ($countResult === $limitOnPage && $countResults < $limit);
        } catch (GuzzleException $e) {
            throw new GooglePlayException($e->getMessage(), $e->getCode(), $e);
        }
        $results = array_merge(...$results);
        $results = array_slice($results, 0, $limit);
        return $results;
    }

    /**
     * @param Category|CategoryEnum|string $category
     * @return string
     */
    private function castToCategoryId($category): string
    {
        if ($category instanceof CategoryEnum) {
            return $category->value();
        }
        if ($category instanceof Category) {
            return $category->getId();
        }
        return (string)$category;
    }

    /**
     * Asynchronously saves images from googleusercontent.com and similar URLs to disk.
     *
     * Before use, you can set the parameters of the width-height of images.
     *
     * @param GoogleImage[] $images Array of {@see \Nelexa\GPlay\Model\GoogleImage} objects.
     * @param callable $destPathCallback The function to which the {@see \Nelexa\GPlay\Model\GoogleImage}
     *     object is passed and you must return the full output. path to save this file. File
     *     extension can be omitted. It will be automatically installed.
     * @param bool $overwrite Overwrite files if exists.
     *
     * @return ImageInfo[] Returns an array with information about saved images.
     *
     * @see GoogleImage Contains a link to the image, allows you to customize its size and download it.
     * @see ImageInfo Contains information about the image.
     */
    public function saveGoogleImages(
        array $images,
        callable $destPathCallback,
        bool $overwrite = false
    ): array {
        $mapping = [];
        foreach ($images as $image) {
            if (!$image instanceof GoogleImage) {
                throw new \InvalidArgumentException('An array of ' . GoogleImage::class . ' objects is expected.');
            }
            $destPath = $destPathCallback($image);
            $mapping[$destPath] = $image->getUrl();
        }

        $httpClient = $this->getHttpClient();
        $promises = (static function () use ($mapping, $overwrite, $httpClient) {
            foreach ($mapping as $destPath => $url) {
                if (!$overwrite && is_file($destPath)) {
                    yield $destPath => new FulfilledPromise($url);
                } else {
                    $dir = dirname($destPath);
                    if (!is_dir($dir) && !mkdir($dir, 0755, true) && !is_dir($dir)) {
                        throw new \RuntimeException(sprintf('Directory "%s" was not created', $dir));
                    }
                    yield $destPath => $httpClient
                        ->requestAsync('GET', $url, [
                            RequestOptions::COOKIES => null,
                            RequestOptions::SINK => $destPath,
                            RequestOptions::HTTP_ERRORS => true,
                        ])
                        ->then(static function (
                            /** @noinspection PhpUnusedParameterInspection */
                            ResponseInterface $response
                        ) use ($url) {
                            return $url;
                        });
                }
            }
        })();

        /**
         * @var ImageInfo[] $imageInfoList
         */
        $imageInfoList = [];
        (new EachPromise($promises, [
            'concurrency' => $this->concurrency,
            'fulfilled' => static function (string $url, string $destPath) use (&$imageInfoList) {
                $imageInfoList[] = new ImageInfo($url, $destPath);
            },
            'rejected' => static function (\Throwable $reason, string $key) use ($mapping) {
                $exceptionUrl = $mapping[$key];
                foreach ($mapping as $destPath => $url) {
                    if (is_file($destPath)) {
                        unlink($destPath);
                    }
                }
                throw (new GooglePlayException($reason->getMessage(), $reason->getCode(), $reason))->setUrl($exceptionUrl);
            },
        ]))->promise()->wait();

        return $imageInfoList;
    }

    /**
     * Returns the locale (language) of the requests.
     *
     * @return string Locale (language) for HTTP requests to Google Play.
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * Sets the locale (language) of requests.
     *
     * @param string $locale Locale (language) for HTTP requests to Google Play.
     *
     * @return GPlayApps Returns an object of its own class to support the call chain.
     */
    public function setLocale(string $locale): GPlayApps
    {
        $this->locale = LocaleHelper::getNormalizeLocale($locale);
        return $this;
    }

    /**
     * Returns the country of the requests.
     *
     * @return string Country for HTTP requests to Google Play.
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * Sets the country of requests.
     *
     * @param string $country Country for HTTP requests to Google Play.
     *
     * @return GPlayApps Returns an object of its own class to support the call chain.
     */
    public function setCountry(string $country): GPlayApps
    {
        $this->country = !empty($country) ? $country : self::DEFAULT_COUNTRY;
        return $this;
    }

    /**
     * Sets the number of seconds to wait when trying to connect to the server.
     *
     * @param float $connectTimeout Connection timeout in seconds, for example 3.14. Use 0 to wait indefinitely.
     *
     * @return GPlayApps Returns an object of its own class to support the call chain.
     */
    public function setConnectTimeout(float $connectTimeout): GPlayApps
    {
        $this->getHttpClient()->setConnectTimeout($connectTimeout);
        return $this;
    }

    /**
     * Sets the timeout of the request in second.
     *
     * @param float $timeout Waiting timeout in seconds, for example 3.14. Use 0 to wait indefinitely.
     *
     * @return GPlayApps Returns an object of its own class to support the call chain.
     */
    public function setTimeout(float $timeout): GPlayApps
    {
        $this->getHttpClient()->setTimeout($timeout);
        return $this;
    }
}
