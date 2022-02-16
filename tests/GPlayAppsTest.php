<?php

declare(strict_types=1);

namespace Nelexa\GPlay\Tests;

use Nelexa\GPlay\Enum\AgeEnum;
use Nelexa\GPlay\Enum\CategoryEnum;
use Nelexa\GPlay\Enum\PriceEnum;
use Nelexa\GPlay\Enum\SortEnum;
use Nelexa\GPlay\Exception\GooglePlayException;
use Nelexa\GPlay\GPlayApps;
use Nelexa\GPlay\Model\App;
use Nelexa\GPlay\Model\AppId;
use Nelexa\GPlay\Model\AppInfo;
use Nelexa\GPlay\Model\Category;
use Nelexa\GPlay\Model\Developer;
use Nelexa\GPlay\Model\Permission;
use Nelexa\GPlay\Model\Review;
use Nelexa\GPlay\Util\LocaleHelper;
use PHPUnit\Framework\TestCase;
use Psr\SimpleCache\CacheInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Component\Cache\Psr16Cache;

/**
 * @internal
 *
 * @small
 */
final class GPlayAppsTest extends TestCase
{
    /** @var GPlayApps */
    private $gplay;

    protected function setUp(): void
    {
        $this->gplay = new GPlayApps();
    }

    /**
     * @return CacheInterface
     *
     * @noinspection PhpComposerExtensionStubsInspection
     */
    private function getCacheInterface(): CacheInterface
    {
        $cacheNamespace = 'gplay.scraper.v1';

        if (class_exists(\Redis::class)) {
            $psr6Cache = new RedisAdapter(RedisAdapter::createConnection('redis://localhost'), $cacheNamespace);
        }

        if (!isset($psr6Cache)) {
            $psr6Cache = new FilesystemAdapter($cacheNamespace);
        }

        return new Psr16Cache($psr6Cache);
    }

    /**
     * @dataProvider provideConstruct
     *
     * @param string|null $defaultLocale
     * @param string|null $defaultCountry
     * @param string      $actualLocale
     * @param string      $actualCountry
     */
    public function testConstruct(?string $defaultLocale, ?string $defaultCountry, string $actualLocale, string $actualCountry): void
    {
        $gplay = new GPlayApps($defaultLocale, $defaultCountry);
        self::assertSame($gplay->getDefaultLocale(), $actualLocale);
        self::assertSame($gplay->getDefaultCountry(), $actualCountry);
    }

    /**
     * @return array
     */
    public function provideConstruct(): array
    {
        return [
            ['', '', GPlayApps::DEFAULT_LOCALE, GPlayApps::DEFAULT_COUNTRY],
            ['ru', '', 'ru_RU', GPlayApps::DEFAULT_COUNTRY],
            ['ru_RU', 'ru', 'ru_RU', 'ru'],
        ];
    }

    public function testDefaultConstruct(): void
    {
        $gplay = new GPlayApps();
        self::assertSame($gplay->getDefaultLocale(), GPlayApps::DEFAULT_LOCALE);
        self::assertSame($gplay->getDefaultCountry(), GPlayApps::DEFAULT_COUNTRY);
    }

    /**
     * @throws GooglePlayException
     */
    public function testGetAppInfo(): void
    {
        $this->gplay->setCache($this->getCacheInterface());

        $appId = 'com.google.android.googlequicksearchbox';
        $locale = 'es';
        $country = 'ca';

        $app = $this->gplay->getAppInfo(
            new AppId(
                $appId,
                $locale,
                $country
            )
        );

        self::assertEquals($app->getId(), $appId);
        self::assertEquals($app->getLocale(), LocaleHelper::getNormalizeLocale($locale));

        $app2 = $this->gplay->getAppInfo($appId);
        self::assertEquals($app2->getId(), $appId);
        self::assertEquals(GPlayApps::DEFAULT_LOCALE, $app2->getLocale());
        self::assertNotEquals($app2, $app);

        $this->gplay
            ->setDefaultLocale($locale)
            ->setDefaultCountry($country)
        ;
        $app3 = $this->gplay->getAppInfo($appId);
        self::assertEquals($app3->getId(), $appId);
        self::assertEquals($app3->getLocale(), LocaleHelper::getNormalizeLocale($locale));
        self::assertEquals($app3, $app);
    }

    /**
     * @throws GooglePlayException
     */
    public function testNotFoundApp(): void
    {
        $this->expectException(GooglePlayException::class);
        $this->expectExceptionMessage('404 Not Found');

        $this->gplay->getAppInfo(new AppId('com.example'));
    }

    /**
     * @dataProvider provideInvalidAppId
     *
     * @param mixed  $appId
     * @param string $exceptionMessage
     *
     * @throws GooglePlayException
     */
    public function testGetAppInfoInvalidAppId($appId, string $exceptionMessage): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage($exceptionMessage);

        $this->gplay->getAppInfo($appId);
    }

    /**
     * @return array
     */
    public function provideInvalidAppId(): array
    {
        return [
            ['', 'Application ID cannot be empty'],
            [null, 'Application ID is null'],
        ];
    }

    public function testEmptyAppId(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Application ID cannot be empty');

        new AppId('');
    }

    /**
     * @throws GooglePlayException
     */
    public function testGetAppsInfo(): void
    {
        $requests = [
            'com.google.android.googlequicksearchbox' => new AppId('com.vkontakte.android'),
            'com.android.chrome' => new AppId('com.android.chrome'),
        ];

        $apps = $this->gplay->getAppsInfo($requests);

        self::assertCount(\count($requests), $apps);
        self::assertContainsOnlyInstancesOf(AppInfo::class, $apps);

        foreach ($requests as $key => $request) {
            self::assertArrayHasKey($key, $apps);
            self::assertEquals($apps[$key]->getId(), $request->getId());
        }
    }

    /**
     * @throws GooglePlayException
     */
    public function testGetAppsInfo2(): void
    {
        /**
         * @var AppId[] $requests
         */
        $requests = [
            // 0 =>
            'com.google.android.googlequicksearchbox',
            // 1 =>
            'com.android.chrome',
        ];

        $apps = $this->gplay->getAppsInfo($requests);

        self::assertCount(\count($requests), $apps);
        self::assertContainsOnlyInstancesOf(AppInfo::class, $apps);

        foreach ($requests as $key => $appId) {
            self::assertIsInt($key);
            self::assertArrayHasKey($key, $apps);
            self::assertEquals($apps[$key]->getId(), $appId);
        }
    }

    /**
     * @throws GooglePlayException
     */
    public function testGetAppsWithEmptyListIds(): void
    {
        $apps = $this->gplay->getAppsInfo([]);
        self::assertIsArray($apps);
        self::assertEmpty($apps);
    }

    /**
     * @throws GooglePlayException
     */
    public function testGetAppsWithAppNotFound(): void
    {
        $this->expectException(GooglePlayException::class);
        $this->expectExceptionMessage('404 Not Found');

        $this->gplay->setConcurrency(1);
        $ids = [
            'com.google.android.webview',
            'com.google.android.apps.authenticator2',
            'com.example',
            'com.android.chrome',
        ];
        $this->gplay->getAppsInfo($ids);
    }

    /**
     * @throws GooglePlayException
     */
    public function testGetAppInfoForLocales(): void
    {
        $this->gplay->setConcurrency(6);

        $appId = 'com.google.android.calculator';
        $id = new AppId($appId, 'en', 'ru');
        $locales = ['en', 'es', 'fr', 'ru', 'kk', 'uk', 'ar', 'zh-TW', 'zt-CN'];
        $apps = $this->gplay->getAppInfoForLocales($id, $locales);
        self::assertContainsOnlyInstancesOf(AppInfo::class, $apps);

        self::assertCount(\count($locales), $apps);

        foreach ($locales as $locale) {
            self::assertArrayHasKey($locale, $apps);
            self::assertSame($apps[$locale]->getId(), $appId);
        }
    }

    /**
     * @throws GooglePlayException
     */
    public function testGetAppInfoForAvailableLocales(): void
    {
        $this->gplay->setConcurrency(10);

        $id = 'ru.yandex.metro';
        $apps = $this->gplay->getAppInfoForAvailableLocales($id);
        self::assertContainsOnlyInstancesOf(AppInfo::class, $apps);

        self::assertTrue(\count(LocaleHelper::SUPPORTED_LOCALES) > \count($apps));

        self::assertArrayHasKey('ru_RU', $apps);
        self::assertArrayHasKey('uk', $apps);
        self::assertArrayHasKey('tr_TR', $apps);
        self::assertArrayHasKey('en_US', $apps);

        self::assertArrayNotHasKey('th', $apps);
        self::assertArrayNotHasKey('fr_FR', $apps);
        self::assertArrayNotHasKey('fil', $apps);
    }

    /**
     * @throws GooglePlayException
     */
    public function testGetAppInfoForAvailableLocalesWithEmptyAppId(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Application ID cannot be empty');

        $this->gplay->getAppInfoForAvailableLocales('');
    }

    /**
     * @dataProvider providePackageExists
     *
     * @param string $appId
     * @param bool   $exists
     */
    public function testExistsApp(string $appId, bool $exists): void
    {
        self::assertEquals($this->gplay->existsApp($appId), $exists);
    }

    /**
     * @return array
     */
    public function providePackageExists(): array
    {
        return [
            ['com.google.android.gm', true],
            ['com.google.android.googlequicksearchbox', true],
            ['dc.bloo_free', false],
            ['com.test', false],
            ['mobi.mgeek.AppToSD', false],
        ];
    }

    /**
     * @throws GooglePlayException
     */
    public function testExistsApps(): void
    {
        $resultsProvider = [];
        $requests = [];

        foreach ($this->providePackageExists() as $provider) {
            [$appId, $actualResult] = $provider;
            $resultsProvider[$appId] = $actualResult;
            $requests[$appId] = $appId;
        }

        $existsApps = $this->gplay->existsApps($requests);

        foreach ($existsApps as $appId => $result) {
            self::assertEquals($result, $resultsProvider[$appId]);
        }
    }

    /**
     * @return array
     */
    public function providePackageExistsAsync(): array
    {
        $data = [];

        foreach ($this->providePackageExists() as $provider) {
            $data[][$provider[0]] = $provider[1];
        }

        return $data;
    }

    /**
     * @throws GooglePlayException
     */
    public function testGetReviews(): void
    {
        $appId = new AppId(
            'com.google.android.webview',
            $locale = 'zh_TW',
            $country = 'cn'
        );
        $reviews = $this->gplay->getReviews(
            $appId,
            $limit = 555,
            SortEnum::NEWEST()
        );
        self::assertCount($limit, $reviews);
        self::assertContainsOnlyInstancesOf(Review::class, $reviews);

        $firstActualReview = $reviews[0];
        $expectedReview = $this->gplay->getReviewById($appId, $firstActualReview->getId());
        self::assertEquals($expectedReview, $firstActualReview);
    }

    /**
     * @throws GooglePlayException
     */
    public function testGetCategories(): void
    {
        $this->gplay->setDefaultLocale('ru');
        $categories = $this->gplay->getCategories();

        self::assertNotEmpty($categories);
        self::assertContainsOnlyInstancesOf(Category::class, $categories);
    }

    /**
     * @throws GooglePlayException
     */
    public function testGetCategoriesForLocales(): void
    {
        $categoriesForLocales = $this->gplay->getCategoriesForLocales(['ru', 'en', 'es', 'be', 'fil', 'zh-TW']);

        self::assertNotEmpty($categoriesForLocales);

        foreach ($categoriesForLocales as $categories) {
            self::assertContainsOnlyInstancesOf(Category::class, $categories);
        }
    }

    /**
     * @throws GooglePlayException
     */
    public function testGetCategoriesForAvailableLocales(): void
    {
        $this->gplay->setConcurrency(10);

        $categoriesForAvailableLocales = $this->gplay->getCategoriesForAvailableLocales();

        self::assertNotEmpty($categoriesForAvailableLocales);

        foreach ($categoriesForAvailableLocales as $categories) {
            self::assertContainsOnlyInstancesOf(Category::class, $categories);
        }
    }

    /**
     * @throws GooglePlayException
     */
    public function testDeveloperInfo(): void
    {
        $this->gplay->setDefaultLocale('ru_RU');
        $devInfo = $this->gplay->getDeveloperInfo(7935948260069539271);

        self::assertNotEmpty($devInfo->getId());
        self::assertNotEmpty($devInfo->getUrl());
        self::assertNotEmpty($devInfo->getName());
        self::assertNotEmpty($devInfo->getDescription());
        self::assertNotEmpty($devInfo->getWebsite());
        self::assertNotNull($devInfo->getIcon());
        self::assertNotNull($devInfo->getCover());
        self::assertNull($devInfo->getEmail());
        self::assertNull($devInfo->getAddress());
    }

    /**
     * @throws GooglePlayException
     */
    public function testDeveloperInfoIncorrectArgument(): void
    {
        $this->expectException(GooglePlayException::class);
        $this->expectExceptionMessage('Developer "Facebook" does not have a personalized page on Google Play.');

        $this->gplay->getDeveloperInfo('Facebook');
    }

    /**
     * @throws GooglePlayException
     */
    public function testDeveloperInfoIncorrectArgument2(): void
    {
        $this->expectException(GooglePlayException::class);
        $this->expectExceptionMessage('Developer "Meta Platforms, Inc." does not have a personalized page on Google Play.');

        $app = $this->gplay->getAppInfo(new AppId('com.facebook.katana'));
        $this->gplay->getDeveloperInfo($app);
    }

    /**
     * @throws GooglePlayException
     */
    public function testDeveloperInfoIncorrectArgument3(): void
    {
        $this->expectException(GooglePlayException::class);
        $this->expectExceptionMessage('Developer "Meta Platforms, Inc." does not have a personalized page on Google Play.');

        $app = $this->gplay->getAppInfo(new AppId('com.facebook.katana'));
        $this->gplay->getDeveloperInfo($app->getDeveloper());
    }

    /**
     * @throws GooglePlayException
     */
    public function testDeveloperInfoNotFound(): void
    {
        $this->expectException(GooglePlayException::class);
        $this->expectExceptionMessage('404 Not Found');

        $this->gplay->getDeveloperInfo('353464543535');
    }

    /**
     * @throws GooglePlayException
     */
    public function testDevInfoForLocales(): void
    {
        $devInfo = $this->gplay->getDeveloperInfoForLocales(5627378377477294831, ['ru_RU', 'uk', 'en', 'fr', 'be']);

        self::assertNotEmpty($devInfo);
        self::assertContainsOnlyInstancesOf(Developer::class, $devInfo);
    }

    /**
     * @throws GooglePlayException
     */
    public function testSuggest(): void
    {
        $suggest = $this->gplay->setDefaultLocale('ar')->getSearchSuggestions('Maps');
        self::assertNotEmpty($suggest);
    }

    /**
     * @throws GooglePlayException
     */
    public function testSuggestEmpty(): void
    {
        $suggest = $this->gplay->setDefaultLocale('en')->getSearchSuggestions('sfdgdsfsafsd"saafdffsdga"safs fdgra affgfdgfds');
        self::assertEmpty($suggest);
    }

    /**
     * @throws GooglePlayException
     */
    public function testSearch(): void
    {
        $results = $this->gplay->search('News', GPlayApps::UNLIMIT, PriceEnum::ALL());
        self::assertNotEmpty($results);
        self::assertContainsOnlyInstancesOf(App::class, $results);
    }

    /**
     * @throws GooglePlayException
     */
    public function testSimilarApps(): void
    {
        $limit = 125;
        $similarApps = $this->gplay->getSimilarApps('com.google.android.apps.docs.editors.docs', $limit);
        self::assertNotEmpty($similarApps);
        self::assertLessThanOrEqual($limit, \count($similarApps));
        self::assertContainsOnlyInstancesOf(App::class, $similarApps);
    }

    /**
     * @dataProvider provideNullCategory
     * @dataProvider provideCategoryApps
     *
     * @param CategoryEnum|null $category
     */
    public function testGetCategoryApps(?CategoryEnum $category): void
    {
        $this->gplay->setCache($this->getCacheInterface());
        $apps = $this->gplay->getListApps($category);

        self::assertNotEmpty($apps);
        self::assertContainsOnlyInstancesOf(App::class, $apps);
    }

    /**
     * @return \Generator
     */
    public function provideCategoryApps(): ?\Generator
    {
        $categories = [
            CategoryEnum::GAME_ARCADE(),
            CategoryEnum::GAME_PUZZLE(),
            CategoryEnum::PHOTOGRAPHY(),
            CategoryEnum::MAPS_AND_NAVIGATION(),
        ];

        foreach ($categories as $category) {
            yield $category->value() => [$category];
        }
    }

    /**
     * @dataProvider provideNullCategory
     * @dataProvider provideCategoryApps
     *
     * @param CategoryEnum|null $category
     */
    public function testGetNewApps(?CategoryEnum $category): void
    {
        $this->gplay->setCache($this->getCacheInterface());
        $apps = $this->gplay->getNewApps($category);

        self::assertContainsOnlyInstancesOf(App::class, $apps);
    }

    /**
     * @return \Generator|null
     */
    public function provideNullCategory(): ?\Generator
    {
        yield 'No category' => [null];
    }

    /**
     * @dataProvider provideNullCategory
     * @dataProvider provideCategoryApps
     *
     * @param CategoryEnum|null $category
     */
    public function testGetTopApps(?CategoryEnum $category): void
    {
        $this->gplay->setCache($this->getCacheInterface());
        $apps = $this->gplay->getTopApps($category);

        self::assertNotEmpty($apps);
        self::assertContainsOnlyInstancesOf(App::class, $apps);
    }

    public function testGetListAppLimit(): void
    {
        $limit = 100;

        $this->gplay->setCache($this->getCacheInterface());
        $apps = $this->gplay->getTopApps(null, AgeEnum::FIVE_UNDER(), $limit);

        self::assertNotEmpty($apps);
        self::assertContainsOnlyInstancesOf(App::class, $apps);
        self::assertLessThanOrEqual($limit, \count($apps));
    }

    /**
     * @throws GooglePlayException
     */
    public function testPermission(): void
    {
        $permissions = $this->gplay->getPermissions('com.google.android.apps.docs.editors.docs');
        self::assertNotEmpty($permissions);
        self::assertContainsOnlyInstancesOf(Permission::class, $permissions);
    }

    /**
     * @throws GooglePlayException
     */
    public function testDeveloperApps(): void
    {
        $this->gplay
            ->setDefaultLocale('ru_RU')
            ->setDefaultCountry('be')
        ;

        $developerAppsById = $this->gplay->getDeveloperApps('5700313618786177705');
        $developerAppsByName = $this->gplay->getDeveloperApps('Google LLC');

        self::assertNotEmpty($developerAppsById);
        self::assertNotEmpty($developerAppsByName);

        self::assertContainsOnly(App::class, $developerAppsById);
        self::assertContainsOnly(App::class, $developerAppsByName);
    }

    public function testClone(): void
    {
        $this->gplay->setDefaultLocale('ko_KR')->setDefaultCountry('ko');

        self::assertEquals('ko_KR', $this->gplay->getDefaultLocale());
        self::assertEquals('ko', $this->gplay->getDefaultCountry());

        $anotherGplay = clone $this->gplay;

        self::assertNotSame($anotherGplay, $this->gplay);

        self::assertEquals('ko_KR', $anotherGplay->getDefaultLocale());
        self::assertEquals('ko', $anotherGplay->getDefaultCountry());

        $anotherGplay->setDefaultLocale('es_ES')->setDefaultCountry('es');
        self::assertEquals('es_ES', $anotherGplay->getDefaultLocale());
        self::assertEquals('es', $anotherGplay->getDefaultCountry());

        self::assertEquals('ko_KR', $this->gplay->getDefaultLocale());
        self::assertEquals('ko', $this->gplay->getDefaultCountry());
    }

    /**
     * @dataProvider provideReleaseApps
     *
     * @param string $actualReleaseDate
     * @param string $packageName
     *
     * @throws GooglePlayException
     *
     * @medium
     */
    public function testReleaseDateForAllLocales(string $actualReleaseDate, string $packageName): void
    {
        $appInfos = $this->gplay->getAppInfoForAvailableLocales($packageName);

        foreach ($appInfos as $appInfo) {
            $released = $appInfo->getReleased();
            self::assertNotNull($released, 'Null released date in ' . $appInfo->getLocale() . ' locale (' . $appInfo->getFullUrl() . ')');
            self::assertSame(
                $released->format('Y.m.d'),
                $actualReleaseDate,
                'Error equals released date in ' . $appInfo->getLocale() . ' locale (' . $appInfo->getFullUrl() . ')'
            );
        }
    }

    /**
     * @return \Generator|null
     */
    public function provideReleaseApps(): ?\Generator
    {
        yield 'jan' => ['2016.01.11', 'com.skgames.trafficrider'];
        yield 'feb' => ['2019.02.28', 'com.budgestudios.googleplay.MyLittlePonyPocketPonies'];
        yield 'mar' => ['2011.03.06', 'sp.app.bubblePop'];
        yield 'apr' => ['2014.04.30', 'com.google.android.apps.docs.editors.docs'];
        yield 'may' => ['2010.05.24', 'com.adobe.reader'];
        yield 'jun' => ['2015.06.17', 'com.disney.thoughtbubbles_goo'];
        yield 'jul' => ['2011.07.19', 'com.viber.voip'];
        yield 'aug' => ['2010.08.12', 'com.google.android.googlequicksearchbox'];
        yield 'sep' => ['2012.09.26', 'com.rovio.BadPiggiesHD'];
        yield 'oct' => ['2014.10.22', 'com.gamehouse.slingo'];
        yield 'nov' => ['2010.11.01', 'com.maxmpz.audioplayer'];
        yield 'dec' => ['2014.12.22', 'ru.cian.main'];
    }
}
