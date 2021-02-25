<?php

declare(strict_types=1);

/**
 * @author   Ne-Lexa
 * @license  MIT
 *
 * @see      https://github.com/Ne-Lexa/google-play-scraper
 */

namespace Nelexa\GPlay;

use GuzzleHttp\Promise\EachPromise;
use GuzzleHttp\Promise\FulfilledPromise;
use GuzzleHttp\RequestOptions;
use Nelexa\HttpClient\HttpClient;
use Nelexa\HttpClient\Options;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Psr\SimpleCache\CacheInterface;
use function GuzzleHttp\Psr7\build_query;
use function GuzzleHttp\Psr7\parse_query;

/**
 * Contains methods for extracting information about Android applications from the Google Play store.
 */
class GPlayApps
{
    /** @var string Default request locale. */
    public const DEFAULT_LOCALE = 'en_US';

    /** @var string Default request country. */
    public const DEFAULT_COUNTRY = 'us';

    /** @var string Google Play base url. */
    public const GOOGLE_PLAY_URL = 'https://play.google.com';

    /** @var string Google Play apps url. */
    public const GOOGLE_PLAY_APPS_URL = self::GOOGLE_PLAY_URL . '/store/apps';

    /** @var int Unlimit results. */
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
    protected $defaultLocale;

    /** @var string Country for HTTP requests to Google Play */
    protected $defaultCountry;

    /**
     * Creates an object to retrieve data about Android applications from the Google Play store.
     *
     * @param string $locale  locale (language) for HTTP requests to Google Play
     *                        or {@see GPlayApps::DEFAULT_LOCALE}
     * @param string $country country for HTTP requests to Google Play
     *                        or {@see GPlayApps::DEFAULT_COUNTRY}
     *
     * @see GPlayApps::DEFAULT_LOCALE Default request locale.
     * @see GPlayApps::DEFAULT_COUNTRY Default request country.
     */
    public function __construct(
        string $locale = self::DEFAULT_LOCALE,
        string $country = self::DEFAULT_COUNTRY
    ) {
        $this
            ->setDefaultLocale($locale)
            ->setDefaultCountry($country)
        ;
    }

    /**
     * Sets caching for HTTP requests.
     *
     * @param cacheInterface|null    $cache    PSR-16 Simple Cache instance
     * @param \DateInterval|int|null $cacheTtl TTL cached data
     *
     * @return GPlayApps returns the current class instance to allow method chaining
     */
    public function setCache(?CacheInterface $cache, $cacheTtl = null): self
    {
        $this->getHttpClient()->setCache($cache);
        $this->setCacheTtl($cacheTtl);

        return $this;
    }

    /**
     * Sets cache ttl.
     *
     * @param \DateInterval|int|null $cacheTtl TTL cached data
     *
     * @return GPlayApps returns the current class instance to allow method chaining
     */
    public function setCacheTtl($cacheTtl): self
    {
        $cacheTtl = $cacheTtl ?? \DateInterval::createFromDateString('5 min');
        $this->getHttpClient()->setCacheTtl($cacheTtl);

        return $this;
    }

    /**
     * Returns an instance of HTTP client.
     *
     * @return HttpClient http client
     */
    protected function getHttpClient(): HttpClient
    {
        static $httpClient;

        if ($httpClient === null) {
            $httpClient = new HttpClient(
                [
                    Options::TIMEOUT => 10.0,
                    Options::HEADERS => [
                        'User-Agent' => 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:72.0) Gecko/20100101 Firefox/72.0',
                    ],
                ]
            );
        }

        return $httpClient;
    }

    /**
     * Sets the limit of concurrent HTTP requests.
     *
     * @param int $concurrency maximum number of concurrent HTTP requests
     *
     * @return GPlayApps returns the current class instance to allow method chaining
     */
    public function setConcurrency(int $concurrency): self
    {
        $this->concurrency = max(1, $concurrency);

        return $this;
    }

    /**
     * Sets proxy for outgoing HTTP requests.
     *
     * @param string|null $proxy Proxy url, ex. socks5://127.0.0.1:9050 or https://116.90.233.2:47348
     *
     * @return GPlayApps returns the current class instance to allow method chaining
     *
     * @see https://curl.haxx.se/libcurl/c/CURLOPT_PROXY.html Description of proxy URL formats in CURL.
     */
    public function setProxy(?string $proxy): self
    {
        $this->getHttpClient()->setProxy($proxy);

        return $this;
    }

    /**
     * Returns the full detail of an application.
     *
     * For information, you must specify the application ID (android package name).
     * The application ID can be viewed in the Google Play store:
     * `https://play.google.com/store/apps/details?id=XXXXXX` , where
     * XXXXXX is the application id.
     *
     * Or it can be found in the APK file.
     * ```shell
     * aapt dump badging file.apk | grep package | awk '{print $2}' | sed s/name=//g | sed s/\'//g
     * ```
     *
     * @param string|Model\AppId $appId google play app id (Android package name)
     *
     * @throws Exception\GooglePlayException if the application is not exists or other HTTP error
     *
     * @return Model\AppInfo full detail of an application or exception
     *
     * @api
     */
    public function getAppInfo($appId): Model\AppInfo
    {
        return $this->getAppsInfo([$appId])[0];
    }

    /**
     * Returns the full detail of multiple applications.
     *
     * The keys of the returned array matches to the passed array.
     * HTTP requests are executed in parallel.
     *
     * @param string[]|Model\AppId[] $appIds array of application ids
     *
     * @throws Exception\GooglePlayException if the application is not exists or other HTTP error
     *
     * @return Model\AppInfo[] an array of detailed information for each application
     *
     * @see GPlayApps::setConcurrency() Sets the limit of concurrent HTTP requests.
     *
     * @api
     */
    public function getAppsInfo(array $appIds): array
    {
        if (empty($appIds)) {
            return [];
        }
        $urls = $this->createUrlListFromAppIds($appIds);

        try {
            return $this->getHttpClient()->requestAsyncPool(
                'GET',
                $urls,
                [
                    Options::HANDLER_RESPONSE => new Scraper\AppInfoScraper(),
                ],
                $this->concurrency
            );
        } catch (\Throwable $e) {
            throw new Exception\GooglePlayException($e->getMessage(), 1, $e);
        }
    }

    /**
     * Returns an array of URLs for application ids.
     *
     * @param string[]|Model\AppId[] $appIds array of application ids
     *
     * @return string[] an array of URL
     */
    final protected function createUrlListFromAppIds(array $appIds): array
    {
        $urls = [];

        foreach ($appIds as $key => $appId) {
            $urls[$key] = Util\Caster::castToAppId($appId, $this->defaultLocale, $this->defaultCountry)->getFullUrl();
        }

        return $urls;
    }

    /**
     * Returns the full details of an application in multiple languages.
     *
     * HTTP requests are executed in parallel.
     *
     * @param string|Model\AppId $appId   google Play app ID (Android package name)
     * @param string[]           $locales array of locales
     *
     * @throws Exception\GooglePlayException if the application is not exists or other HTTP error
     *
     * @return Model\AppInfo[] An array of detailed information for each locale.
     *                         The array key is the locale.
     *
     * @see GPlayApps::setConcurrency() Sets the limit of concurrent HTTP requests.
     *
     * @api
     */
    public function getAppInfoForLocales($appId, array $locales): array
    {
        $appId = Util\Caster::castToAppId($appId, $this->defaultLocale, $this->defaultCountry);
        $requests = [];

        foreach ($locales as $locale) {
            $requests[$locale] = new Model\AppId($appId->getId(), $locale, $appId->getCountry());
        }

        return $this->getAppsInfo($requests);
    }

    /**
     * Returns detailed application information for all available locales.
     *
     * Information is returned only for the description loaded by the developer.
     * All locales with automated translation from Google Translate will be ignored.
     * HTTP requests are executed in parallel.
     *
     * @param string|Model\AppId $appId application ID (Android package name) as
     *                                  a string or {@see Model\AppId} object
     *
     * @throws Exception\GooglePlayException if the application is not exists or other HTTP error
     *
     * @return Model\AppInfo[] An array with detailed information about the application
     *                         on all available locales. The array key is the locale.
     *
     * @see GPlayApps::setConcurrency() Sets the limit of concurrent HTTP requests.
     *
     * @api
     */
    public function getAppInfoForAvailableLocales($appId): array
    {
        $list = $this->getAppInfoForLocales($appId, Util\LocaleHelper::SUPPORTED_LOCALES);

        $preferredLocale = self::DEFAULT_LOCALE;

        foreach ($list as $app) {
            if ($app->isAutoTranslatedDescription()) {
                $preferredLocale = (string) $app->getTranslatedFromLocale();
                break;
            }
        }

        /**
         * @var Model\AppInfo[] $list
         */
        $list = array_filter(
            $list,
            static function (Model\AppInfo $app) {
                return !$app->isAutoTranslatedDescription();
            }
        );

        if (!isset($list[$preferredLocale])) {
            throw new \RuntimeException('No key ' . $preferredLocale);
        }
        $preferredApp = $list[$preferredLocale];
        $list = array_filter(
            $list,
            static function (Model\AppInfo $app, string $locale) use ($preferredApp, $list) {
                // deletes locales in which there is no translation added, but automatic translation by Google Translate is used.
                if ($preferredApp->getLocale() === $locale || !$preferredApp->equals($app)) {
                    if (($pos = strpos($locale, '_')) !== false) {
                        $rootLang = substr($locale, 0, $pos);
                        $rootLangLocale = Util\LocaleHelper::getNormalizeLocale($rootLang);

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
            },
            \ARRAY_FILTER_USE_BOTH
        );

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
     * Checks if the specified application exists in the Google Play store.
     *
     * @param string|Model\AppId $appId application ID (Android package name) as
     *                                  a string or {@see Model\AppId} object
     *
     * @return bool returns `true` if the application exists, or `false` if not
     *
     * @api
     */
    public function existsApp($appId): bool
    {
        $appId = Util\Caster::castToAppId($appId, $this->defaultLocale, $this->defaultCountry);

        try {
            return (bool) $this->getHttpClient()->request(
                'HEAD',
                $appId->getFullUrl(),
                [
                    RequestOptions::HTTP_ERRORS => false,
                    Options::HANDLER_RESPONSE => new Scraper\ExistsAppScraper(),
                ]
            );
        } catch (\Throwable $e) {
            return false;
        }
    }

    /**
     * Checks if the specified applications exist in the Google Play store.
     * HTTP requests are executed in parallel.
     *
     * @param string[]|Model\AppId[] $appIds Array of application identifiers.
     *                                       The keys of the returned array correspond to the transferred array.
     *
     * @throws Exception\GooglePlayException if an HTTP error other than 404 is received
     *
     * @return bool[] An array of information about the existence of each
     *                application in the store Google Play. The keys of the returned
     *                array matches to the passed array.
     *
     * @see GPlayApps::setConcurrency() Sets the limit of concurrent HTTP requests.
     *
     * @api
     */
    public function existsApps(array $appIds): array
    {
        if (empty($appIds)) {
            return [];
        }
        $urls = $this->createUrlListFromAppIds($appIds);

        try {
            return $this->getHttpClient()->requestAsyncPool(
                'HEAD',
                $urls,
                [
                    RequestOptions::HTTP_ERRORS => false,
                    Options::HANDLER_RESPONSE => new Scraper\ExistsAppScraper(),
                ],
                $this->concurrency
            );
        } catch (\Throwable $e) {
            throw new Exception\GooglePlayException($e->getMessage(), 1, $e);
        }
    }

    /**
     * Returns reviews of the Android app in the Google Play store.
     *
     * Getting a lot of reviews can take a lot of time.
     *
     * @param string|Model\AppId $appId application ID (Android package name) as
     *                                  a string or {@see Model\AppId} object
     * @param int                $limit Maximum number of reviews. To extract all
     *                                  reviews, use {@see GPlayApps::UNLIMIT}.
     * @param Enum\SortEnum|null $sort  Sort reviews of the application.
     *                                  If null, then sort by the newest reviews.
     *
     * @throws Exception\GooglePlayException if the application is not exists or other HTTP error
     *
     * @return Model\Review[] app reviews
     *
     * @see Enum\SortEnum Contains all valid values for the "sort" parameter.
     * @see GPlayApps::UNLIMIT Limit for all available results.
     *
     * @api
     */
    public function getReviews($appId, int $limit = 100, ?Enum\SortEnum $sort = null): array
    {
        $appId = Util\Caster::castToAppId($appId, $this->defaultLocale, $this->defaultCountry);
        $sort = $sort ?? Enum\SortEnum::NEWEST();

        $allCount = 0;
        $token = null;
        $allReviews = [];

        $cacheTtl = $sort === Enum\SortEnum::NEWEST() ?
            \DateInterval::createFromDateString('1 min') :
            \DateInterval::createFromDateString('1 hour');

        try {
            do {
                $count = $limit === self::UNLIMIT ?
                    Scraper\PlayStoreUiRequest::LIMIT_REVIEW_ON_PAGE :
                    min(Scraper\PlayStoreUiRequest::LIMIT_REVIEW_ON_PAGE, max($limit - $allCount, 1));

                $request = Scraper\PlayStoreUiRequest::getReviewsRequest($appId, $count, $sort, $token);

                [$reviews, $token] = $this->getHttpClient()->send(
                    $request,
                    [
                        Options::CACHE_TTL => $cacheTtl,
                        Options::HANDLER_RESPONSE => new Scraper\ReviewsScraper($appId),
                    ]
                );
                $allCount += \count($reviews);
                $allReviews[] = $reviews;
            } while ($token !== null && ($limit === self::UNLIMIT || $allCount < $limit));
        } catch (\Throwable $e) {
            throw new Exception\GooglePlayException($e->getMessage(), 1, $e);
        }

        return empty($allReviews) ? $allReviews : array_merge(...$allReviews);
    }

    /**
     * Returns review of the Android app in the Google Play store by review id.
     *
     * @param string|Model\AppId $appId    application ID (Android package name) as
     *                                     a string or {@see Model\AppId} object
     * @param string             $reviewId review id
     *
     * @throws Exception\GooglePlayException if the application is not exists or other HTTP error
     *
     * @return Model\Review app review
     */
    public function getReviewById($appId, string $reviewId): Model\Review
    {
        $appId = Util\Caster::castToAppId($appId, $this->defaultLocale, $this->defaultCountry);

        try {
            /** @var Model\Review $review */
            $review = $this->getHttpClient()->request(
                'GET',
                self::GOOGLE_PLAY_APPS_URL . '/details',
                [
                    RequestOptions::QUERY => [
                        self::REQ_PARAM_ID => $appId->getId(),
                        self::REQ_PARAM_LOCALE => $appId->getLocale(),
                        self::REQ_PARAM_COUNTRY => $appId->getCountry(),
                        'reviewId' => $reviewId,
                    ],
                    Options::HANDLER_RESPONSE => new Scraper\AppSpecificReviewScraper($appId),
                ]
            );
        } catch (\Throwable $e) {
            throw new Exception\GooglePlayException($e->getMessage(), 1, $e);
        }

        return $review;
    }

    /**
     * Returns a list of permissions for the application.
     *
     * @param string|Model\AppId $appId application ID (Android package name) as
     *                                  a string or {@see Model\AppId} object
     *
     * @throws Exception\GooglePlayException if the application is not exists or other HTTP error
     *
     * @return Model\Permission[] an array of permissions for the application
     *
     * @api
     */
    public function getPermissions($appId): array
    {
        $appId = Util\Caster::castToAppId($appId, $this->defaultLocale, $this->defaultCountry);

        try {
            $request = Scraper\PlayStoreUiRequest::getPermissionsRequest($appId);

            /** @var Model\Permission[] $permissions */
            $permissions = $this->getHttpClient()->send(
                $request,
                [
                    Options::HANDLER_RESPONSE => new Scraper\PermissionScraper(),
                ]
            );
        } catch (\Throwable $e) {
            throw new Exception\GooglePlayException($e->getMessage(), 1, $e);
        }

        return $permissions;
    }

    /**
     * Returns an array of application categories from the Google Play store.
     *
     * @throws Exception\GooglePlayException if HTTP error is received
     *
     * @return Model\Category[] array of application categories
     *
     * @api
     */
    public function getCategories(): array
    {
        $url = self::GOOGLE_PLAY_APPS_URL;

        try {
            /** @var Model\Category[] $categories */
            $categories = $this->getHttpClient()->request(
                'GET',
                $url,
                [
                    RequestOptions::QUERY => [
                        self::REQ_PARAM_LOCALE => $this->defaultLocale,
                    ],
                    Options::HANDLER_RESPONSE => new Scraper\CategoriesScraper(),
                ]
            );
        } catch (\Throwable $e) {
            throw new Exception\GooglePlayException($e->getMessage(), 1, $e);
        }

        return $categories;
    }

    /**
     * Returns an array of application categories from the Google Play store for the specified locales.
     *
     * HTTP requests are executed in parallel.
     *
     * @param string[] $locales array of locales
     *
     * @throws Exception\GooglePlayException if HTTP error is received
     *
     * @return Model\Category[][] array of application categories by locale
     *
     * @see GPlayApps::setConcurrency() Sets the limit of concurrent HTTP requests.
     *
     * @api
     */
    public function getCategoriesForLocales(array $locales): array
    {
        if (empty($locales)) {
            return [];
        }
        $locales = Util\LocaleHelper::getNormalizeLocales($locales);

        $urls = [];
        $url = self::GOOGLE_PLAY_APPS_URL;

        foreach ($locales as $locale) {
            $urls[$locale] = $url . '?' . http_build_query(
                [
                    self::REQ_PARAM_LOCALE => $locale,
                ]
            );
        }

        try {
            return $this->getHttpClient()->requestAsyncPool(
                'GET',
                $urls,
                [
                    Options::HANDLER_RESPONSE => new Scraper\CategoriesScraper(),
                ],
                $this->concurrency
            );
        } catch (\Throwable $e) {
            throw new Exception\GooglePlayException($e->getMessage(), 1, $e);
        }
    }

    /**
     * Returns an array of categories from the Google Play store for all available locales.
     *
     * @throws Exception\GooglePlayException if HTTP error is received
     *
     * @return Model\Category[][] array of application categories by locale
     *
     * @see GPlayApps::setConcurrency() Sets the limit of concurrent HTTP requests.
     *
     * @api
     */
    public function getCategoriesForAvailableLocales(): array
    {
        return $this->getCategoriesForLocales(Util\LocaleHelper::SUPPORTED_LOCALES);
    }

    /**
     * Returns information about the developer: name, icon, cover, description and website address.
     *
     * @param string|Model\Developer|Model\App $developerId developer id as
     *                                                      string, {@see Model\Developer}
     *                                                      or {@see Model\App} object
     *
     * @throws Exception\GooglePlayException if HTTP error is received
     *
     * @return Model\Developer information about the application developer
     *
     * @see GPlayApps::getDeveloperInfoForLocales() Returns information about the developer for the locale array.
     *
     * @api
     */
    public function getDeveloperInfo($developerId): Model\Developer
    {
        $developerId = Util\Caster::castToDeveloperId($developerId);

        if (!is_numeric($developerId)) {
            throw new Exception\GooglePlayException(
                sprintf(
                    'Developer "%s" does not have a personalized page on Google Play.',
                    $developerId
                )
            );
        }

        $url = self::GOOGLE_PLAY_APPS_URL . '/dev';

        try {
            /** @var Model\Developer $developer */
            $developer = $this->getHttpClient()->request(
                'GET',
                $url,
                [
                    RequestOptions::QUERY => [
                        self::REQ_PARAM_ID => $developerId,
                        self::REQ_PARAM_LOCALE => $this->defaultLocale,
                    ],
                    Options::HANDLER_RESPONSE => new Scraper\DeveloperInfoScraper(),
                ]
            );
        } catch (\Throwable $e) {
            throw new Exception\GooglePlayException($e->getMessage(), 1, $e);
        }

        return $developer;
    }

    /**
     * Returns information about the developer for the specified locales.
     *
     * @param string|Model\Developer|Model\App $developerId developer id as
     *                                                      string, {@see Model\Developer}
     *                                                      or {@see Model\App} object
     * @param string[]                         $locales     array of locales
     *
     * @throws Exception\GooglePlayException if HTTP error is received
     *
     * @return Model\Developer[] an array with information about the application developer
     *                           for each requested locale
     *
     * @see GPlayApps::setConcurrency() Sets the limit of concurrent HTTP requests.
     * @see GPlayApps::getDeveloperInfo() Returns information about the developer: name,
     *     icon, cover, description and website address.
     *
     * @api
     */
    public function getDeveloperInfoForLocales($developerId, array $locales = []): array
    {
        if (empty($locales)) {
            return [];
        }
        $locales = Util\LocaleHelper::getNormalizeLocales($locales);

        $id = Util\Caster::castToDeveloperId($developerId);

        if (!is_numeric($id)) {
            throw new Exception\GooglePlayException(
                sprintf(
                    'Developer "%s" does not have a personalized page on Google Play.',
                    $id
                )
            );
        }

        $urls = [];
        $url = self::GOOGLE_PLAY_APPS_URL . '/dev';

        foreach ($locales as $locale) {
            $urls[$locale] = $url . '?' . http_build_query(
                [
                    self::REQ_PARAM_ID => $id,
                    self::REQ_PARAM_LOCALE => $locale,
                ]
            );
        }

        try {
            return $this->getHttpClient()->requestAsyncPool(
                'GET',
                $urls,
                [
                    Options::HANDLER_RESPONSE => new Scraper\DeveloperInfoScraper(),
                ],
                $this->concurrency
            );
        } catch (\Throwable $e) {
            throw new Exception\GooglePlayException($e->getMessage(), 1, $e);
        }
    }

    /**
     * Returns an array of applications from the Google Play store by developer id.
     *
     * @param string|Model\Developer|Model\App $developerId developer id as
     *                                                      string, {@see Model\Developer}
     *                                                      or {@see Model\App} object
     *
     * @throws Exception\GooglePlayException if HTTP error is received
     *
     * @return Model\App[] an array of applications with basic information
     *
     * @api
     */
    public function getDeveloperApps($developerId): array
    {
        $developerId = Util\Caster::castToDeveloperId($developerId);

        $query = [
            self::REQ_PARAM_ID => $developerId,
            self::REQ_PARAM_LOCALE => $this->defaultLocale,
            self::REQ_PARAM_COUNTRY => $this->defaultCountry,
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
                        Options::HANDLER_RESPONSE => new Scraper\FindDevAppsUrlScraper(),
                    ]
                );

                if ($developerUrl === null) {
                    return [];
                }
                $developerUrl .= '&' . self::REQ_PARAM_LOCALE . '=' . urlencode($this->defaultLocale) .
                    '&' . self::REQ_PARAM_COUNTRY . '=' . urlencode($this->defaultCountry);
            } catch (\Throwable $e) {
                throw new Exception\GooglePlayException($e->getMessage(), 1, $e);
            }
        } else {
            $developerUrl = self::GOOGLE_PLAY_APPS_URL . '/developer?' . http_build_query($query);
        }

        return $this->fetchAppsFromClusterPage(
            $developerUrl,
            $this->defaultLocale,
            $this->defaultCountry,
            self::UNLIMIT
        );
    }

    /**
     * Returns a list of applications with basic information.
     *
     * @param string $clusterPageUrl cluster page URL
     * @param string $locale         locale
     * @param string $country        country
     * @param int    $limit          Maximum number of applications. To extract all
     *                               applications, use {@see GPlayApps::UNLIMIT}.
     *
     * @throws Exception\GooglePlayException if the application is not exists or other HTTP error
     *
     * @return Model\App[] array of applications with basic information about them
     *
     * @see GPlayApps::UNLIMIT Limit for all available results.
     */
    protected function fetchAppsFromClusterPage(
        string $clusterPageUrl,
        string $locale,
        string $country,
        int $limit
    ): array {
        if ($limit < self::UNLIMIT || $limit === 0) {
            throw new \InvalidArgumentException(sprintf('Invalid limit: %d', $limit));
        }

        $clusterPageComponents = parse_url($clusterPageUrl);
        $query = parse_query($clusterPageComponents['query'] ?? '');
        $query[self::REQ_PARAM_LOCALE] = $locale;
        $query[self::REQ_PARAM_COUNTRY] = $country;

        $clusterPageUrl = $clusterPageComponents['scheme'] . '://' .
            $clusterPageComponents['host'] .
            $clusterPageComponents['path'] .
            '?' . build_query($query);

        try {
            [$apps, $token] = $this->getHttpClient()->request(
                'GET',
                $clusterPageUrl,
                [
                    Options::HANDLER_RESPONSE => new Scraper\ClusterAppsScraper(),
                ]
            );

            $allCount = \count($apps);
            $allApps = [$apps];

            while ($token !== null && ($limit === self::UNLIMIT || $allCount < $limit)) {
                $count = $limit === self::UNLIMIT ?
                    Scraper\PlayStoreUiRequest::LIMIT_APPS_ON_PAGE :
                    min(Scraper\PlayStoreUiRequest::LIMIT_APPS_ON_PAGE, max($limit - $allCount, 1));

                $request = Scraper\PlayStoreUiRequest::getAppsRequest($locale, $country, $count, $token);

                [$apps, $token] = $this->getHttpClient()->send(
                    $request,
                    [
                        Options::HANDLER_RESPONSE => new Scraper\PlayStoreUiAppsScraper(),
                    ]
                );
                $allCount += \count($apps);
                $allApps[] = $apps;
            }
        } catch (\Throwable $e) {
            throw new Exception\GooglePlayException($e->getMessage(), 1, $e);
        }

        if (empty($allApps)) {
            return $allApps;
        }
        $allApps = array_merge(...$allApps);

        if ($limit !== self::UNLIMIT) {
            $allApps = \array_slice($allApps, 0, $limit);
        }

        return $allApps;
    }

    /**
     * Returns an array of similar applications with basic information about
     * them in the Google Play store.
     *
     * @param string|Model\AppId $appId application ID (Android package name)
     *                                  as a string or {@see Model\AppId} object
     * @param int                $limit The maximum number of similar applications.
     *                                  To extract all similar applications,
     *                                  use {@see GPlayApps::UNLIMIT}.
     *
     * @throws Exception\GooglePlayException if the application is not exists or other HTTP error
     *
     * @return Model\App[] an array of applications with basic information about them
     *
     * @see GPlayApps::UNLIMIT Limit for all available results.
     *
     * @api
     */
    public function getSimilarApps($appId, int $limit = 50): array
    {
        $appId = Util\Caster::castToAppId($appId, $this->defaultLocale, $this->defaultCountry);

        try {
            /**
             * @var string|null $similarAppsUrl
             */
            $similarAppsUrl = $this->getHttpClient()->request(
                'GET',
                $appId->getFullUrl(),
                [
                    Options::HANDLER_RESPONSE => new Scraper\FindSimilarAppsUrlScraper($appId),
                ]
            );

            if ($similarAppsUrl === null) {
                return [];
            }

            return $this->fetchAppsFromClusterPage(
                $similarAppsUrl,
                $appId->getLocale(),
                $appId->getCountry(),
                $limit
            );
        } catch (\Throwable $e) {
            throw new Exception\GooglePlayException($e->getMessage(), 1, $e);
        }
    }

    /**
     * Returns the Google Play search suggests.
     *
     * @param string $query search query
     *
     * @throws Exception\GooglePlayException if HTTP error is received
     *
     * @return string[] array containing search suggestions
     *
     * @api
     */
    public function getSearchSuggestions(string $query): array
    {
        $query = trim($query);

        if ($query === '') {
            return [];
        }

        $url = 'https://market.android.com/suggest/SuggRequest';

        try {
            /** @var string[] $suggestions */
            $suggestions = $this->getHttpClient()->request(
                'GET',
                $url,
                [
                    RequestOptions::QUERY => [
                        'json' => 1,
                        'c' => 3,
                        'query' => $query,
                        self::REQ_PARAM_LOCALE => $this->defaultLocale,
                        self::REQ_PARAM_COUNTRY => $this->defaultCountry,
                    ],
                    Options::HANDLER_RESPONSE => new Scraper\SuggestScraper(),
                ]
            );
        } catch (\Throwable $e) {
            throw new Exception\GooglePlayException($e->getMessage(), 1, $e);
        }

        return $suggestions;
    }

    /**
     * Returns a list of applications from the Google Play store for a search query.
     *
     * @param string              $query search query
     * @param int                 $limit the limit on the number of search results
     * @param Enum\PriceEnum|null $price price category or `null`
     *
     * @throws Exception\GooglePlayException if HTTP error is received
     *
     * @return Model\App[] an array of applications with basic information
     *
     * @see Enum\PriceEnum Contains all valid values for the "price" parameter.
     * @see GPlayApps::UNLIMIT Limit for all available results.
     *
     * @api
     */
    public function search(string $query, int $limit = 50, ?Enum\PriceEnum $price = null): array
    {
        $query = trim($query);

        if (empty($query)) {
            throw new \InvalidArgumentException('Search query missing');
        }
        $price = $price ?? Enum\PriceEnum::ALL();

        $params = [
            'c' => 'apps',
            'q' => $query,
            self::REQ_PARAM_LOCALE => $this->defaultLocale,
            self::REQ_PARAM_COUNTRY => $this->defaultCountry,
            'price' => $price->value(),
        ];
        $clusterPageUrl = self::GOOGLE_PLAY_URL . '/store/search?' . http_build_query($params);

        return $this->fetchAppsFromClusterPage(
            $clusterPageUrl,
            $this->defaultLocale,
            $this->defaultCountry,
            $limit
        );
    }

    /**
     * Returns an array of applications from the Google Play store for the specified category.
     *
     * @param string|Model\Category|Enum\CategoryEnum|null $category application category as
     *                                                               string, {@see Model\Category},
     *                                                               {@see Enum\CategoryEnum} or
     *                                                               `null` for all categories
     * @param Enum\AgeEnum|null                            $age      age limit or null for no limit
     * @param int                                          $limit    limit on the number of results
     *                                                               or {@see GPlayApps::UNLIMIT}
     *                                                               for no limit
     *
     * @return Model\App[] an array of applications with basic information
     *
     * @see GPlayApps::UNLIMIT Limit for all available results.
     *
     * @api
     */
    public function getListApps($category = null, ?Enum\AgeEnum $age = null, int $limit = self::UNLIMIT): array
    {
        return $this->fetchAppsFromClusterPages($category, $age, null, $limit);
    }

    /**
     * Returns an array of **top apps** from the Google Play store for the specified category.
     *
     * @param string|Model\Category|Enum\CategoryEnum|null $category application category as
     *                                                               string, {@see Model\Category},
     *                                                               {@see Enum\CategoryEnum} or
     *                                                               `null` for all categories
     * @param Enum\AgeEnum|null                            $age      age limit or null for no limit
     * @param int                                          $limit    limit on the number of results
     *                                                               or {@see GPlayApps::UNLIMIT}
     *                                                               for no limit
     *
     * @return Model\App[] an array of applications with basic information
     *
     * @see GPlayApps::UNLIMIT Limit for all available results.
     *
     * @api
     */
    public function getTopApps($category = null, ?Enum\AgeEnum $age = null, int $limit = self::UNLIMIT): array
    {
        return $this->fetchAppsFromClusterPages($category, $age, 'top', $limit);
    }

    /**
     * Returns an array of **new apps** from the Google Play store for the specified category.
     *
     * @param string|Model\Category|Enum\CategoryEnum|null $category application category as
     *                                                               string, {@see Model\Category},
     *                                                               {@see Enum\CategoryEnum} or
     *                                                               `null` for all categories
     * @param Enum\AgeEnum|null                            $age      age limit or null for no limit
     * @param int                                          $limit    limit on the number of results
     *                                                               or {@see GPlayApps::UNLIMIT}
     *                                                               for no limit
     *
     * @return Model\App[] an array of applications with basic information
     *
     * @see GPlayApps::UNLIMIT Limit for all available results.
     *
     * @api
     */
    public function getNewApps($category = null, ?Enum\AgeEnum $age = null, int $limit = self::UNLIMIT): array
    {
        return $this->fetchAppsFromClusterPages($category, $age, 'new', $limit);
    }

    /**
     * @param string|Model\Category|Enum\CategoryEnum|null $category
     * @param Enum\AgeEnum|null                            $age
     * @param string|null                                  $path
     * @param int                                          $limit
     *
     * @return Model\App[]
     */
    protected function fetchAppsFromClusterPages($category, ?Enum\AgeEnum $age, ?string $path, int $limit): array
    {
        if ($limit === 0 || $limit < self::UNLIMIT) {
            throw new \InvalidArgumentException('Negative limit');
        }

        $queryParams = [
            self::REQ_PARAM_LOCALE => $this->defaultLocale,
            self::REQ_PARAM_COUNTRY => $this->defaultCountry,
        ];

        if ($age !== null) {
            $queryParams['age'] = $age->value();
        }

        $url = self::GOOGLE_PLAY_APPS_URL;

        if ($path !== null) {
            $url .= '/' . $path;
        }

        if ($category !== null) {
            $url .= '/category/' . Util\Caster::castToCategoryId($category);
        }
        $url .= '?' . http_build_query($queryParams);

        /**
         * @var array $categoryClusterPages = [[
         *            "name" => "Top Free Games",
         *            "url" => "https://play.google.com/store/apps/store/apps/collection/cluster?clp=......"
         *            ]]
         */
        $categoryClusterPages = $this->getHttpClient()->request(
            'GET',
            $url,
            [
                Options::HANDLER_RESPONSE => new Scraper\ClusterPagesFromListAppsScraper(),
            ]
        );

        if (empty($categoryClusterPages)) {
            return [];
        }

        $iterator = new \ArrayIterator($categoryClusterPages);
        $results = [];

        do {
            $clusterPage = $iterator->current();
            $clusterUrl = $clusterPage['url'];

            try {
                $apps = $this->fetchAppsFromClusterPage($clusterUrl, $this->defaultLocale, $this->defaultCountry, self::UNLIMIT);

                foreach ($apps as $app) {
                    if (!isset($results[$app->getId()])) {
                        $results[$app->getId()] = $app;
                    }
                }
            } catch (\Throwable $e) {
                // ignore exception
            }

            if ($limit !== self::UNLIMIT && \count($results) >= $limit) {
                $results = \array_slice($results, 0, $limit);
                break;
            }

            $iterator->next();
        } while ($iterator->valid());

        return $results;
    }

    /**
     * Asynchronously saves images from googleusercontent.com and similar URLs to disk.
     *
     * Before use, you can set the parameters of the width-height of images.
     *
     * Example:
     * ```php
     * $gplay->saveGoogleImages(
     *     $images,
     *     static function (\Nelexa\GPlay\Model\GoogleImage $image): string {
     *         $hash = $image->getHashUrl($hashAlgo = 'md5', $parts = 2, $partLength = 2);
     *         return 'path/to/screenshots/' . $hash . '.{ext}';
     *     },
     *     $overwrite = false
     * );
     * ```
     *
     * @param Model\GoogleImage[] $images           array of {@see Model\GoogleImage} objects
     * @param callable            $destPathCallback The function to which the
     *                                              {@see Model\GoogleImage} object is
     *                                              passed and you must return the full
     *                                              output. path to save this file.
     * @param bool                $overwrite        overwrite files if exists
     *
     * @return Model\ImageInfo[] returns an array with information about saved images
     *
     * @see Model\GoogleImage Contains a link to the image, allows you to customize its size and download it.
     * @see Model\ImageInfo Contains information about the image.
     *
     * @api
     */
    public function saveGoogleImages(
        array $images,
        callable $destPathCallback,
        bool $overwrite = false
    ): array {
        /** @var array<string, StreamInterface> $mapping */
        $mapping = [];

        foreach ($images as $image) {
            if (!$image instanceof Model\GoogleImage) {
                throw new \InvalidArgumentException(
                    'An array of ' . Model\GoogleImage::class . ' objects is expected.'
                );
            }
            $destPath = $destPathCallback($image);
            $url = $image->getUrl();
            $mapping[$url] = new Util\LazyStream($destPath, 'w+b');
        }

        $httpClient = $this->getHttpClient();
        $promises = (static function () use ($mapping, $overwrite, $httpClient) {
            foreach ($mapping as $url => $stream) {
                $destPath = $stream->getFilename();
                $dynamicPath = strpos($destPath, '{url}') !== false;

                if (!$overwrite && !$dynamicPath && is_file($destPath)) {
                    yield $url => new FulfilledPromise($url);
                } else {
                    yield $url => $httpClient
                        ->requestAsync(
                            'GET',
                            $url,
                            [
                                RequestOptions::COOKIES => null,
                                RequestOptions::SINK => $stream,
                                RequestOptions::HTTP_ERRORS => true,
                                RequestOptions::ON_HEADERS => static function (ResponseInterface $response) use (
                                    $url,
                                    $stream
                                ): void {
                                    Model\GoogleImage::onHeaders($response, $url, $stream);
                                },
                            ]
                        )
                        ->then(
                            static function (
                                /** @noinspection PhpUnusedParameterInspection */
                                ResponseInterface $response
                            ) use ($url) {
                                return $url;
                            }
                        )
                    ;
                }
            }
        })();

        /**
         * @var Model\ImageInfo[] $imageInfoList
         */
        $imageInfoList = [];
        (new EachPromise(
            $promises,
            [
                'concurrency' => $this->concurrency,
                'fulfilled' => static function (string $url) use (&$imageInfoList, $mapping): void {
                    $imageInfoList[] = new Model\ImageInfo($url, $mapping[$url]->getFilename());
                },
                'rejected' => static function (\Throwable $reason, string $exceptionUrl) use ($mapping): void {
                    foreach ($mapping as $destPath => $url) {
                        if (is_file($destPath)) {
                            unlink($destPath);
                        }
                    }

                    throw (new Exception\GooglePlayException(
                        $reason->getMessage(),
                        $reason->getCode(),
                        $reason
                    ))->setUrl(
                        $exceptionUrl
                    );
                },
            ]
        ))->promise()->wait();

        return $imageInfoList;
    }

    /**
     * Returns the locale (language) of the requests.
     *
     * @return string locale (language) for HTTP requests to Google Play
     */
    public function getDefaultLocale(): string
    {
        return $this->defaultLocale;
    }

    /**
     * Sets the locale (language) of requests.
     *
     * @param string $defaultLocale locale (language) for HTTP requests to Google Play
     *
     * @return GPlayApps returns the current class instance to allow method chaining
     */
    public function setDefaultLocale(string $defaultLocale): self
    {
        $this->defaultLocale = Util\LocaleHelper::getNormalizeLocale($defaultLocale);

        return $this;
    }

    /**
     * Returns the country of the requests.
     *
     * @return string country for HTTP requests to Google Play
     */
    public function getDefaultCountry(): string
    {
        return $this->defaultCountry;
    }

    /**
     * Sets the country of requests.
     *
     * @param string $defaultCountry country for HTTP requests to Google Play
     *
     * @return GPlayApps returns the current class instance to allow method chaining
     */
    public function setDefaultCountry(string $defaultCountry): self
    {
        $this->defaultCountry = !empty($defaultCountry) ?
            $defaultCountry :
            self::DEFAULT_COUNTRY;

        return $this;
    }

    /**
     * Sets the number of seconds to wait when trying to connect to the server.
     *
     * @param float $connectTimeout Connection timeout in seconds, for example 3.14. Use 0 to wait indefinitely.
     *
     * @return GPlayApps returns the current class instance to allow method chaining
     */
    public function setConnectTimeout(float $connectTimeout): self
    {
        $this->getHttpClient()->setConnectTimeout($connectTimeout);

        return $this;
    }

    /**
     * Sets the timeout of the request in second.
     *
     * @param float $timeout Waiting timeout in seconds, for example 3.14. Use 0 to wait indefinitely.
     *
     * @return GPlayApps returns the current class instance to allow method chaining
     */
    public function setTimeout(float $timeout): self
    {
        $this->getHttpClient()->setTimeout($timeout);

        return $this;
    }
}
