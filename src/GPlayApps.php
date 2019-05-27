<?php
declare(strict_types=1);

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
use Nelexa\GPlay\Http\ResponseHandlerInterface;
use Nelexa\GPlay\Model\App;
use Nelexa\GPlay\Model\AppDetail;
use Nelexa\GPlay\Model\Category;
use Nelexa\GPlay\Model\Developer;
use Nelexa\GPlay\Model\GoogleImage;
use Nelexa\GPlay\Model\ImageInfo;
use Nelexa\GPlay\Model\Permission;
use Nelexa\GPlay\Model\Review;
use Nelexa\GPlay\Request\RequestApp;
use Nelexa\GPlay\Scraper\AppDetailScraper;
use Nelexa\GPlay\Scraper\AppReviewScraper;
use Nelexa\GPlay\Scraper\CategoriesScraper;
use Nelexa\GPlay\Scraper\DeveloperAppsScraper;
use Nelexa\GPlay\Scraper\DeveloperPageScraper;
use Nelexa\GPlay\Scraper\ExistsAppScraper;
use Nelexa\GPlay\Scraper\ListScraper;
use Nelexa\GPlay\Scraper\PermissionScraper;
use Nelexa\GPlay\Scraper\PlayStoreUiPagesScraper;
use Nelexa\GPlay\Scraper\SimilarAppsScraper;
use Nelexa\GPlay\Util\LocaleHelper;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\SimpleCache\CacheInterface;

/**
 * PHP Scraper to extract application data from the Google Play store.
 *
 * @package Nelexa\GPlay
 * @author Ne-Lexa
 */
class GPlayApps
{
    /**
     * @const Default locale
     */
    public const DEFAULT_LOCALE = 'en_US';
    /**
     * @const Default country
     */
    public const DEFAULT_COUNTRY = 'us'; // Affected price

    public const GOOGLE_PLAY_URL = 'https://play.google.com';
    public const GOOGLE_PLAY_APPS_URL = self::GOOGLE_PLAY_URL . '/store/apps';
    public const MAX_SEARCH_RESULTS = 250;

    public const REQ_PARAM_LOCALE = 'hl';
    public const REQ_PARAM_COUNTRY = 'gl';
    public const REQ_PARAM_APP_ID = 'id';

    /**
     * @var int
     */
    private $concurrency = 4;
    /**
     * @var string
     */
    private $defaultLocale;
    /**
     * @var string
     */
    private $defaultCountry;

    /**
     * GPlayApps constructor.
     *
     * @param string $defaultLocale
     * @param string $defaultCountry
     */
    public function __construct(?string $defaultLocale = null, ?string $defaultCountry = null)
    {
        $this->setDefaultLocale($defaultLocale ?? self::DEFAULT_LOCALE);
        $this->setDefaultCountry($defaultCountry ?? self::DEFAULT_COUNTRY);
    }

    /**
     * @return string
     */
    public function getDefaultLocale(): string
    {
        return $this->defaultLocale;
    }

    /**
     * @param string $defaultLocale
     * @return GPlayApps
     */
    public function setDefaultLocale(string $defaultLocale): GPlayApps
    {
        $this->defaultLocale = LocaleHelper::getNormalizeLocale($defaultLocale);
        return $this;
    }

    /**
     * @return string
     */
    public function getDefaultCountry(): string
    {
        return $this->defaultCountry;
    }

    /**
     * @param string $defaultCountry
     * @return GPlayApps
     */
    public function setDefaultCountry(string $defaultCountry): GPlayApps
    {
        $this->defaultCountry = $defaultCountry;
        return $this;
    }


    /**
     * Sets caching for HTTP requests.
     *
     * @param CacheInterface|null $cache PSR-16 Simple Cache instance
     * @param \DateInterval|int|null $cacheTtl Optional. The TTL of cached data.
     * @return GPlayApps
     */
    public function setCache(?CacheInterface $cache, $cacheTtl = null): self
    {
        $this->getHttpClient()->setCache($cache);
        $this->getHttpClient()->setCacheTtl($cacheTtl);
        return $this;
    }

    /**
     * Returns an instance of HTTP client.
     *
     * @return HttpClient
     */
    public function getHttpClient(): HttpClient
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
     * @param int $concurrency maximum number of concurrent HTTP requests
     * @return GPlayApps
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
     * @return GPlayApps
     * @see https://curl.haxx.se/libcurl/c/CURLOPT_PROXY.html
     */
    public function setProxy(?string $proxy): GPlayApps
    {
        $this->getHttpClient()->setProxy($proxy);
        return $this;
    }

    /**
     * Returns detailed information about an Android application from
     * Google Play by its id (package name).
     *
     * @param string|RequestApp|App $requestApp Application id (package name)
     *     or object {@see RequestApp} or object {@see App}.
     * @return AppDetail Detailed information about the Android
     *     application or exception.
     * @throws GooglePlayException if the application is not exists or other HTTP error
     */
    public function getApp($requestApp): AppDetail
    {
        return $this->getApps([$requestApp])[0];
    }

    /**
     * Returns detailed information about many android packages.
     * HTTP requests are executed in parallel.
     *
     * @param string[]|RequestApp[]|App[] $requestApps array of application ids or array of {@see RequestApp} or array
     *     of {@see App}.
     * @return AppDetail[] An array of detailed information for each application.
     *     The keys of the returned array matches to the passed array.
     * @throws GooglePlayException if the application is not exists or other HTTP error
     * @see GPlayApps::setConcurrency() To set the limit of parallel requests
     */
    public function getApps(array $requestApps): array
    {
        if (empty($requestApps)) {
            return [];
        }
        $urls = $this->getRequestAppsUrlList($requestApps);
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
     * @param string[]|RequestApp[]|App[] $requestApps
     * @return array
     * @throws \InvalidArgumentException
     */
    private function getRequestAppsUrlList(array $requestApps): array
    {
        $urls = [];
        foreach ($requestApps as $key => $requestApp) {
            $requestApp = $this->castToRequestApp($requestApp);
            $urls[$key] = self::GOOGLE_PLAY_APPS_URL . '/details?' . http_build_query([
                    self::REQ_PARAM_APP_ID => $requestApp->getId(),
                    self::REQ_PARAM_LOCALE => $requestApp->getLocale(),
                    self::REQ_PARAM_COUNTRY => $requestApp->getCountry(),
                ]);
        }
        return $urls;
    }

    /**
     * @param string|RequestApp|App $requestApp
     * @return RequestApp
     */
    private function castToRequestApp($requestApp): RequestApp
    {
        if ($requestApp === null) {
            throw new \InvalidArgumentException('$requestApp is null');
        }
        if (is_string($requestApp)) {
            $requestApp = new RequestApp($requestApp, $this->defaultLocale, $this->defaultCountry);
        } elseif ($requestApp instanceof App) {
            $requestApp = new RequestApp($requestApp->getId(), $requestApp->getLocale(), $this->defaultCountry);
        } elseif (!$requestApp instanceof RequestApp) {
            throw new \InvalidArgumentException('unsupport argument type');
        }
        return $requestApp;
    }

    /**
     * Returns detailed information about the application in all
     * available locales. HTTP requests are executed in parallel.
     *
     * @param string|RequestApp|App $requestApp Application id (package name)
     *     or object {@see RequestApp} or object {@see App}.
     * @return AppDetail[] An array with detailed information about the application on all available locales. The array
     *     key is the locale.
     * @throws GooglePlayException if the application is not exists or other HTTP error
     * @see GPlayApps::setConcurrency() To set the limit of parallel requests
     */
    public function getAppInAvailableLocales($requestApp): array
    {
        $requestApp = $this->castToRequestApp($requestApp);

        $requests = [];
        foreach (LocaleHelper::SUPPORTED_LOCALES as $locale) {
            $requests[$locale] = new RequestApp($requestApp->getId(), $locale, $this->defaultCountry);
        }
        $list = $this->getApps($requests);

        $preferredLocale = null;
        foreach ($list as $app) {
            if ($app->getTranslatedFromLanguage() !== null) {
                $preferredLocale = $app->getTranslatedFromLanguage();
                break;
            }
        }
        if ($preferredLocale === null) {
            $preferredLocale = $list[self::DEFAULT_LOCALE];
        }

        $preferredApp = $list[$preferredLocale];
        foreach ($list as $locale => $app) {
            if ($preferredApp->getLocale() !== $locale && $preferredApp->equals($app)) {
                // delete data with google translate machine translation
                unset($list[$locale]);
            }
        }

        foreach ($list as $locale => $app) {
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
                    unset($list[$locale]);
                }
            }
        }

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
     * @param string|RequestApp|App $requestApp Application id (package name)
     *     or object {@see RequestApp} or object {@see App}.
     * @return bool true if the application exists on the Google Play store, and false if not.
     */
    public function existsApp($requestApp): bool
    {
        $requestApp = $this->castToRequestApp($requestApp);
        $url = self::GOOGLE_PLAY_APPS_URL . '/details';

        try {
            return (bool)$this->getHttpClient()->request('HEAD', $url, [
                RequestOptions::QUERY => [
                    self::REQ_PARAM_APP_ID => $requestApp->getId(),
                    self::REQ_PARAM_LOCALE => $requestApp->getLocale(),
                    self::REQ_PARAM_COUNTRY => $requestApp->getCountry(),
                ],
                RequestOptions::HTTP_ERRORS => false,
                HttpClient::OPTION_HANDLER_RESPONSE => new ExistsAppScraper(),
            ]);
        } catch (GuzzleException $e) {
            return false;
        }
    }

    /**
     * Checks if the specified applications exist in the Google Play store.
     * HTTP requests are executed in parallel.
     *
     * @param string[]|RequestApp[]|App[] $requestApps array of application ids or array of {@see RequestApp} or array
     *     of {@see App}.
     * @return AppDetail[] Массив подробной информации для каждого приложения.
     * Ключи возвращаемого массива соответствуют переданному массиву.
     * @return bool[] An array of information about the existence of each application in the store Google Play. The
     *     keys of the returned array matches to the passed array.
     * @throws GooglePlayException
     * @see GPlayApps::setConcurrency() To set the limit of parallel requests
     */
    public function existsApps(array $requestApps): array
    {
        if (empty($requestApps)) {
            return [];
        }
        $urls = $this->getRequestAppsUrlList($requestApps);
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
     * Returns an array with application reviews.
     *
     * @param string|RequestApp|App $requestApp Application id (package name)
     *     or object {@see RequestApp} or object {@see App}.
     * @param int $page page number, starts with 0
     * @param SortEnum|null $sort Sort reviews of the application.
     *     If null, then sort by the newest reviews.
     * @return Review[] App reviews
     * @throws GooglePlayException if the application is not exists or other HTTP error
     *
     * @see SortEnum::NEWEST()       Sort by latest reviews.
     * @see SortEnum::HELPFULNESS()  Sort by helpful reviews.
     * @see SortEnum::RATING()       Sort by rating reviews.
     */
    public function getAppReviews($requestApp, int $page = 0, ?SortEnum $sort = null): array
    {
        $requestApp = $this->castToRequestApp($requestApp);
        $sort = $sort ?? SortEnum::NEWEST();
        $page = max(0, $page);

        $url = self::GOOGLE_PLAY_URL . '/store/getreviews';
        $formParams = [
            self::REQ_PARAM_APP_ID => $requestApp->getId(),
            self::REQ_PARAM_LOCALE => $requestApp->getLocale(),
            'pageNum' => $page,
            'reviewSortOrder' => $sort->value(),
            'reviewType' => 0,
            'xhr' => 1,
        ];

        try {
            return $this->getHttpClient()->request(
                'POST',
                $url,
                [
                    RequestOptions::FORM_PARAMS => $formParams,
                    HttpClient::OPTION_CACHE_TTL => \DateInterval::createFromDateString(SortEnum::NEWEST() ? '2 min' : '1 hour'),
                    HttpClient::OPTION_HANDLER_RESPONSE => new AppReviewScraper(),
                ]
            );
        } catch (GuzzleException $e) {
            throw new GooglePlayException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Get a list of all app reviews. The maximum number of reviews available
     * for extraction is about 4480 reviews. This can take a long time.
     *
     * @param string|RequestApp|App $requestApp Application id (package name)
     *     or object {@see RequestApp} or object {@see App}.
     * @param SortEnum|null $sort Sort reviews of the application.
     *     If null, then sort by the newest reviews.
     * @param int|null $limit limit reviews
     * @return Review[]
     *
     * @see SortEnum::NEWEST()       Sort by latest reviews.
     * @see SortEnum::HELPFULNESS()  Sort by helpful reviews.
     * @see SortEnum::RATING()       Sort by rating reviews.
     */
    public function getAppAllReviews(
        $requestApp,
        ?SortEnum $sort = null,
        ?int $limit = null
    ): array
    {
        $page = 0;
        $reviewsGroup = [];
        $count = 0;
        try {
            do {
                $reviews = $this->getAppReviews($requestApp, $page, $sort);
                $countOnPage = count($reviews);
                $count += $countOnPage;
                $reviewsGroup[] = $reviews;
                $page++;
            } while (
                $countOnPage === /*google play limit on page*/ 40 &&
                $page < /*google play limit pages*/ 112 &&
                ($limit === null || $count < $limit)
            );
        } catch (\Throwable $e) {
            @trigger_error($e->getMessage(), E_USER_WARNING);
        }
        $reviews = array_merge(...$reviewsGroup);
        if ($limit !== null) {
            $reviews = array_slice($reviews, 0, $limit);
        }
        return $reviews;
    }

    /**
     * Returns a list of similar applications in the Google Play store.
     *
     * @param string|RequestApp|App $requestApp Application id (package name)
     *     or object {@see RequestApp} or object {@see App}.
     * @param int $limit limit of similar applications
     * @return App[] array of applications with basic information
     * @throws GooglePlayException if the application is not exists or other HTTP error
     */
    public function getSimilarApps($requestApp, int $limit = 50): array
    {
        $requestApp = $this->castToRequestApp($requestApp);
        $limit = max(1, min($limit, self::MAX_SEARCH_RESULTS));
        $params = [
            self::REQ_PARAM_APP_ID => $requestApp->getId(),
            self::REQ_PARAM_LOCALE => $requestApp->getLocale(),
            self::REQ_PARAM_COUNTRY => $requestApp->getCountry(),
        ];
        $url = self::GOOGLE_PLAY_APPS_URL . '/details?' . http_build_query($params);
        $httpClient = $this->getHttpClient();
        try {
            return $httpClient->request(
                'GET',
                $url,
                [
                    HttpClient::OPTION_HANDLER_RESPONSE => new SimilarAppsScraper(
                        $httpClient,
                        $limit,
                        $requestApp->getLocale(),
                        $requestApp->getCountry()
                    ),
                ]
            );
        } catch (GuzzleException $e) {
            throw new GooglePlayException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Returns a list of permissions for the application.
     *
     * @param string|RequestApp|App $requestApp Application id (package name)
     *     or object {@see RequestApp} or object {@see App}.
     * @return Permission[] list of permissions for the application
     * @throws GooglePlayException
     */
    public function getPermissions($requestApp): array
    {
        $requestApp = $this->castToRequestApp($requestApp);

        $url = self::GOOGLE_PLAY_URL . '/store/xhr/getdoc?authuser=0';
        try {
            return $this->getHttpClient()->request(
                'POST',
                $url,
                [
                    RequestOptions::FORM_PARAMS => [
                        'ids' => $requestApp->getId(),
                        self::REQ_PARAM_LOCALE => $requestApp->getLocale(),
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
     * Returns a list of application categories from the Google Play store.
     *
     * @param string|null $locale site locale or default locale used
     * @return Category[] list of application categories
     * @throws GooglePlayException caused by HTTP error
     */
    public function getCategories(?string $locale = null): array
    {
        $locale = LocaleHelper::getNormalizeLocale($locale ?? $this->defaultLocale);

        $url = self::GOOGLE_PLAY_APPS_URL;
        try {
            return $this->getHttpClient()->request(
                'GET',
                $url,
                [
                    RequestOptions::QUERY => [
                        self::REQ_PARAM_LOCALE => $locale,
                    ],
                    HttpClient::OPTION_HANDLER_RESPONSE => new CategoriesScraper(),
                ]
            );
        } catch (GuzzleException $e) {
            throw new GooglePlayException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Returns a list of application categories from the Google Play store for the locale array.
     * HTTP requests are executed in parallel.
     *
     * @param string[] $locales array of locales
     * @return Category[][] list of application categories by locale
     * @throws GooglePlayException caused by HTTP error
     * @see GPlayApps::setConcurrency() To set the limit of parallel requests
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
     * Returns a list of categories from the Google Play store for all available locales.
     *
     * @return Category[][] list of application categories by locale
     * @throws GooglePlayException caused by HTTP error
     * @see GPlayApps::setConcurrency() To set the limit of parallel requests
     */
    public function getCategoriesInAvailableLocales(): array
    {
        return $this->getCategoriesInLocales(LocaleHelper::SUPPORTED_LOCALES);
    }

    /**
     * Returns information about the developer: name, icon, cover, description and website address.
     *
     * @param string|int|Developer|App|AppDetail $developerId developer identifier or object containing it
     * @param string|null $locale site locale or default locale used
     * @return Developer information about the developer
     * @throws GooglePlayException caused by HTTP error
     */
    public function getDeveloperInfo($developerId, ?string $locale = null): Developer
    {
        $developerId = $this->caseToDeveloperId($developerId);
        if (!is_numeric($developerId)) {
            throw new GooglePlayException(sprintf('Developer "%s" does not have a personalized page on Google Play.', $developerId));
        }

        $locale = LocaleHelper::getNormalizeLocale($locale ?? $this->defaultLocale);
        $url = self::GOOGLE_PLAY_APPS_URL . '/dev';
        try {
            return $this->getHttpClient()->request(
                'GET',
                $url,
                [
                    RequestOptions::QUERY => [
                        self::REQ_PARAM_APP_ID => $developerId,
                        self::REQ_PARAM_LOCALE => $locale,
                    ],
                    HttpClient::OPTION_HANDLER_RESPONSE => new DeveloperPageScraper(),
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
    private function caseToDeveloperId($developerId): string
    {
        if (is_string($developerId)) {
            return $developerId;
        }
        if (is_int($developerId)) {
            return (string)$developerId;
        }
        if ($developerId instanceof App) {
            return $developerId->getDeveloper()->getId();
        }
        if ($developerId instanceof Developer) {
            return $developerId->getId();
        }
        throw new \InvalidArgumentException('The $developerId argument must contain the developer id or the application/developer object.');
    }

    /**
     * Returns information about the developer for the locale array.
     *
     * @param string|int|Developer|App|AppDetail $developerId developer identifier or object containing it
     * @param string[] $locales array of locales
     * @return Developer[] list of developer by locale
     * @throws GooglePlayException caused by HTTP error
     * @see GPlayApps::setConcurrency() To set the limit of parallel requests
     */
    public function getDeveloperInfoInLocales($developerId, array $locales = []): array
    {
        if (empty($locales)) {
            return [];
        }
        $locales = LocaleHelper::getNormalizeLocales($locales);

        $id = $this->caseToDeveloperId($developerId);
        if (!is_numeric($id)) {
            throw new GooglePlayException(sprintf('Developer "%s" does not have a personalized page on Google Play.', $id));
        }

        $urls = [];
        $url = self::GOOGLE_PLAY_APPS_URL . '/dev';
        foreach ($locales as $locale) {
            $urls[$locale] = $url . '?' . http_build_query([
                    self::REQ_PARAM_APP_ID => $id,
                    self::REQ_PARAM_LOCALE => $locale,
                ]);
        }

        try {
            return $this->getHttpClient()->requestAsyncPool(
                'GET',
                $urls,
                [
                    HttpClient::OPTION_HANDLER_RESPONSE => new DeveloperPageScraper(),
                ],
                $this->concurrency
            );
        } catch (GuzzleException $e) {
            throw new GooglePlayException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Returns information about the developer for all available locales.
     *
     * @param string|int|Developer|App|AppDetail $developerId developer identifier or object containing it
     * @return Developer[] list of developer by locale
     * @throws GooglePlayException caused by HTTP error
     * @see GPlayApps::setConcurrency() To set the limit of parallel requests
     */
    public function getDeveloperInfoInAvailableLocales(int $developerId): array
    {
        $list = $this->getDeveloperInfoInLocales($developerId, LocaleHelper::SUPPORTED_LOCALES);

        $preferredLocale = self::DEFAULT_LOCALE;

        $preferredInfo = $list[$preferredLocale];
        $list = array_filter($list, static function (Developer $info, string $locale) use ($preferredInfo, $preferredLocale) {
            return $locale === $preferredLocale || $preferredInfo->equals($info);
        }, ARRAY_FILTER_USE_BOTH);

        foreach ($list as $locale => $info) {
            if (($pos = strpos($locale, '_')) !== false) {
                $rootLang = substr($locale, 0, $pos);
                $rootLangLocale = LocaleHelper::getNormalizeLocale($rootLang);
                if (
                    $rootLangLocale !== $locale &&
                    isset($list[$rootLangLocale]) &&
                    $list[$rootLangLocale]->equals($info)
                ) {
                    // delete duplicate data,
                    // for example, delete en_CA, en_IN, en_GB, en_ZA, if there is en_US and they are equals.
                    unset($list[$locale]);
                }
            }
        }

        return $list;
    }

    /**
     * Returns a list of developer applications in the Google Play store.
     *
     * @param string|int|Developer|App|AppDetail $developerId developer identifier or object containing it
     * @param string|null $locale locale or default locale used
     * @param string|null $country country or default country used
     * @return App[] array of applications with basic information
     * @throws GooglePlayException caused by HTTP error
     */
    public function getDeveloperApps(
        $developerId,
        ?string $locale = null,
        ?string $country = null
    ): array
    {
        $locale = LocaleHelper::getNormalizeLocale($locale ?? $this->defaultLocale);
        $country = $country ?? $this->defaultCountry;
        $developerId = $this->caseToDeveloperId($developerId);

        $httpClient = $this->getHttpClient();
        $query = [
            self::REQ_PARAM_APP_ID => $developerId,
            self::REQ_PARAM_LOCALE => $locale,
            self::REQ_PARAM_COUNTRY => $country,
        ];

        try {
            if (is_numeric($developerId)) {
                $url = self::GOOGLE_PLAY_APPS_URL . '/dev';
                return $httpClient->request(
                    'GET',
                    $url,
                    [
                        RequestOptions::QUERY => $query,
                        HttpClient::OPTION_HANDLER_RESPONSE => new DeveloperAppsScraper(
                            $httpClient,
                            500,
                            $locale,
                            $country
                        ),
                    ]
                );
            }

            $url = self::GOOGLE_PLAY_APPS_URL . '/developer';
            return $httpClient->request(
                'GET',
                $url,
                [
                    RequestOptions::QUERY => $query,
                    HttpClient::OPTION_HANDLER_RESPONSE => new PlayStoreUiPagesScraper(
                        $httpClient,
                        500,
                        $locale,
                        $country
                    ),
                ]
            );
        } catch (GuzzleException $e) {
            throw new GooglePlayException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Returns the Google Play search suggests.
     *
     * @param string $query search query
     * @param string|null $locale locale or default locale used
     * @param string|null $country country or default country used
     * @return string[] array with search suggest
     * @throws GooglePlayException caused by HTTP error
     */
    public function getSuggest(
        string $query,
        ?string $locale = null,
        ?string $country = null
    ): array
    {
        $query = trim($query);
        if ($query === '') {
            return [];
        }
        $locale = LocaleHelper::getNormalizeLocale($locale ?? $this->defaultLocale);
        $country = $country ?? $this->defaultCountry;

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
                        self::REQ_PARAM_LOCALE => $locale,
                        self::REQ_PARAM_COUNTRY => $country,
                    ],
                    HttpClient:: OPTION_HANDLER_RESPONSE => new class implements ResponseHandlerInterface
                    {
                        /**
                         * @param RequestInterface $request
                         * @param ResponseInterface $response
                         * @return mixed
                         */
                        public function __invoke(RequestInterface $request, ResponseInterface $response)
                        {
                            $json = \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
                            return array_map(static function (array $v) {
                                return $v['s'];
                            }, $json);
                        }
                    },
                ]
            );
        } catch (GuzzleException $e) {
            throw new GooglePlayException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Returns a list of applications from the Google Play store for a search query.
     *
     * @param string $query search query
     * @param int $limit limit
     * @param PriceEnum|null $price free, paid or both applications
     * @param string|null $locale locale or default locale used
     * @param string|null $country country or default country used
     * @return App[] array of applications with basic information
     * @throws GooglePlayException caused by HTTP error
     *
     * @see PriceEnum::ALL()
     * @see PriceEnum::FREE()
     * @see PriceEnum::PAID()
     */
    public function search(
        string $query,
        int $limit = 50,
        ?PriceEnum $price = null,
        ?string $locale = null,
        ?string $country = null
    ): array
    {
        $query = trim($query);
        if (empty($query)) {
            throw new \InvalidArgumentException('Search query missing');
        }
        if ($limit < 1) {
            throw new \InvalidArgumentException('Invalid count');
        }
        $locale = LocaleHelper::getNormalizeLocale($locale ?? $this->defaultLocale);
        $country = $country ?? $this->defaultCountry;
        $price = $price ?? PriceEnum::ALL();
        $limit = min($limit, self::MAX_SEARCH_RESULTS);

        $params = [
            'c' => 'apps',
            'q' => $query,
            'hl' => $locale,
            'gl' => $country,
            'price' => $price->value(),
        ];
        $url = self::GOOGLE_PLAY_URL . '/store/search?' . http_build_query($params);

        $httpClient = $this->getHttpClient();
        try {
            return $httpClient->request(
                'GET',
                $url,
                [
                    HttpClient::OPTION_HANDLER_RESPONSE => new PlayStoreUiPagesScraper($httpClient, $limit, $locale, $country),
                ]
            );
        } catch (GuzzleException $e) {
            throw new GooglePlayException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Gets a list of apps from the Google Play store for category and collection.
     *
     * @param CategoryEnum|null $category application category or null
     * @param CollectionEnum $collection коллекция приложения
     * @param int $limit application limit
     * @param AgeEnum|null $age
     * @param string|null $locale locale or default locale used
     * @param string|null $country country or default country used
     * @return App[] array of applications with basic information
     * @throws GooglePlayException caused by HTTP error
     *
     * @see CategoryEnum
     *
     * @see CollectionEnum::TOP_FREE()  Top Free
     * @see CollectionEnum::TOP_PAID()  Top Paid
     * @see CollectionEnum::NEW_FREE()  Top New Free
     * @see CollectionEnum::NEW_PAID()  Top New Paid
     * @see CollectionEnum::GROSSING()  Top Grossing
     * @see CollectionEnum::TRENDING()  Trending Apps
     *
     * @see AgeEnum::FIVE_UNDER()       Ages 5 and under
     * @see AgeEnum::SIX_EIGHT()        Ages 6-8
     * @see AgeEnum::NINE_UP()          Ages 9 & Up
     */
    public function getAppsByCategory(
        ?CategoryEnum $category,
        CollectionEnum $collection,
        int $limit = 60,
        ?AgeEnum $age = null,
        ?string $locale = null,
        ?string $country = null
    ): array
    {
        $limit = min(560, max(1, $limit));
        $locale = LocaleHelper::getNormalizeLocale($locale ?? $this->defaultLocale);
        $country = $country ?? $this->defaultCountry;

        $url = self::GOOGLE_PLAY_APPS_URL . '';
        if ($category !== null) {
            $url .= '/category/' . $category->value();
        }
        $url .= '/collection/' . $collection->value();

        $offset = 0;

        $queryParams = [
            self::REQ_PARAM_LOCALE => $locale,
            self::REQ_PARAM_COUNTRY => $country,
        ];
        if ($age !== null) {
            $queryParams['age'] = $age->value();
        }

        $results = [];
        $countResults = 0;
        $slice = 0;
        try {
            do {
                if ($offset > 500) {
                    $slice = $offset - 500;
                    $offset = 500;
                }
                $queryParams['num'] = min($limit - $offset + $slice, 60);

                $result = $this->getHttpClient()->request(
                    'POST',
                    $url,
                    [
                        RequestOptions::QUERY => $queryParams,
                        RequestOptions::FORM_PARAMS => [
                            'start' => $offset,
                        ],
                        HttpClient::OPTION_HANDLER_RESPONSE => new ListScraper(),
                    ]
                );
                if ($slice > 0) {
                    $result = array_slice($result, $slice);
                }
                $countResult = count($result);
                $countResults += $countResult;
                $results[] = $result;
                $offset += $countResult;
            } while ($countResult === 60 && $countResults < $limit);
        } catch (GuzzleException $e) {
            throw new GooglePlayException($e->getMessage(), $e->getCode(), $e);
        }
        $results = array_merge(...$results);
        $results = array_slice($results, 0, $limit);
        return $results;
    }

    /**
     * Asynchronously saves images from googleusercontent.com and similar URLs to disk.
     * Before use, you can set the parameters of the width-height of images.
     *
     * @param GoogleImage[] $images
     * @param callable $destPathFn The function to which the GoogleImage object is passed and you must return
     *     the full output. path to save this file. File extension can be omitted.
     *     It will be automatically installed.
     * @param bool $overwrite Overwrite files
     * @return ImageInfo[]
     */
    public function saveGoogleImages(
        array $images,
        callable $destPathFn,
        bool $overwrite = false
    ): array
    {
        $mapping = [];
        foreach ($images as $image) {
            if (!$image instanceof GoogleImage) {
                throw new \InvalidArgumentException('An array of ' . GoogleImage::class . ' objects is expected.');
            }
            $destPath = $destPathFn($image);
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
                        @unlink($destPath);
                    }
                }
                throw (new GooglePlayException($reason->getMessage(), $reason->getCode(), $reason))->setUrl($exceptionUrl);
            },
        ]))->promise()->wait();

        return $imageInfoList;
    }
}
