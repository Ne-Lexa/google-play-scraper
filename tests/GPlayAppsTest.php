<?php

declare(strict_types=1);

/*
 * Copyright (c) Ne-Lexa
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/Ne-Lexa/google-play-scraper
 */

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
use Nelexa\GPlay\Model\ClusterPage;
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
    public function testConstruct(
        ?string $defaultLocale,
        ?string $defaultCountry,
        string $actualLocale,
        string $actualCountry
    ): void {
        $gplay = new GPlayApps($defaultLocale, $defaultCountry);
        self::assertSame($actualLocale, $gplay->getDefaultLocale());
        self::assertSame($actualCountry, $gplay->getDefaultCountry());
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
        self::assertSame(GPlayApps::DEFAULT_LOCALE, $gplay->getDefaultLocale());
        self::assertSame(GPlayApps::DEFAULT_COUNTRY, $gplay->getDefaultCountry());
    }

    /**
     * @throws GooglePlayException
     */
    public function testGetAppInfo(): void
    {
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

        self::assertArrayHasKey('ru_RU', $apps);
        self::assertArrayHasKey('uk', $apps);
        self::assertArrayHasKey('tr_TR', $apps);
        self::assertArrayHasKey('en_US', $apps);
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
            'zh_TW',
            'cn'
        );
        $reviews = $this->gplay->getReviews(
            $appId,
            $limit = 555,
            SortEnum::NEWEST()
        );
        self::assertCount($limit, $reviews);
        self::assertContainsOnlyInstancesOf(Review::class, $reviews);
    }

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
        $this->expectExceptionMessage(
            'Developer "Meta Platforms, Inc." does not have a personalized page on Google Play.'
        );

        $app = $this->gplay->getAppInfo(new AppId('com.facebook.katana'));
        $this->gplay->getDeveloperInfo($app);
    }

    /**
     * @throws GooglePlayException
     */
    public function testDeveloperInfoIncorrectArgument3(): void
    {
        $this->expectException(GooglePlayException::class);
        $this->expectExceptionMessage(
            'Developer "Meta Platforms, Inc." does not have a personalized page on Google Play.'
        );

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
        $suggest = $this->gplay->setDefaultLocale('en')->getSearchSuggestions(
            'sfdgdsfsafsd"saafdffsdga"safs fdgra affgfdgfds'
        );
        self::assertEmpty($suggest);
    }

    /**
     * @throws \Nelexa\GPlay\Exception\GooglePlayException
     */
    public function testSearch(): void
    {
        $this->gplay->setCache(null);
        $results = $this->gplay
            ->setDefaultCountry('us')
            ->search('gta', GPlayApps::UNLIMIT, PriceEnum::PAID())
        ;
        self::assertGreaterThan(51, $results);
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
     *
     * @throws \Nelexa\GPlay\Exception\GooglePlayException
     */
    public function testGetCategoryApps(?CategoryEnum $category): void
    {
        $apps = $this->gplay->getListApps($category);
        self::assertNotEmpty($apps);
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
     * @dataProvider provideCategoryApps
     *
     * @param CategoryEnum|null $category
     *
     * @throws \Nelexa\GPlay\Exception\GooglePlayException
     */
    public function testGetSellingFreeApps(?CategoryEnum $category): void
    {
        $this->gplay->setCache($this->getCacheInterface());
        $apps = $this->gplay->getTopSellingFreeApps($category);

        self::assertNotEmpty($apps);
        self::assertContainsOnlyInstancesOf(App::class, $apps);
    }

    /**
     * @dataProvider provideCategoryApps
     *
     * @param CategoryEnum|null $category
     *
     * @throws \Nelexa\GPlay\Exception\GooglePlayException
     */
    public function testGetSellingPaidApps(?CategoryEnum $category): void
    {
        $this->gplay->setCache($this->getCacheInterface());
        $apps = $this->gplay->getTopSellingPaidApps($category);

        self::assertNotEmpty($apps);
        self::assertContainsOnlyInstancesOf(App::class, $apps);
    }

    /**
     * @dataProvider provideCategoryApps
     *
     * @param CategoryEnum|null $category
     *
     * @throws \Nelexa\GPlay\Exception\GooglePlayException
     */
    public function testGetSellingGrossingApps(?CategoryEnum $category): void
    {
        $this->gplay->setCache($this->getCacheInterface());
        $apps = $this->gplay->getTopGrossingApps($category);
        self::assertNotEmpty($apps);
        self::assertContainsOnlyInstancesOf(App::class, $apps);
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
     * @dataProvider provideGetClusterApps
     *
     * @param string $clusterPage
     *
     * @throws \Nelexa\GPlay\Exception\GooglePlayException
     */
    public function testGetClusterApps(string $clusterPage): void
    {
        $count = 0;
        foreach ($this->gplay->getClusterApps($clusterPage) as $clusterApp) {
            self::assertInstanceOf(App::class, $clusterApp);
            ++$count;
        }

        self::assertGreaterThan(0, $count);
    }

    public function provideGetClusterApps(): iterable
    {
        yield 'premium apps' => ['https://play.google.com/store/apps/collection/cluster?clp=ogoKCA0qAggBUgIIAQ%3D%3D:S:ANO1ljJJQho&gsr=Cg2iCgoIDSoCCAFSAggB:S:ANO1ljJDbNY&hl=en'];
    }

    /**
     * @param string|Category|CategoryEnum|null $category
     * @param AgeEnum|null                      $age
     *
     * @throws \Nelexa\GPlay\Exception\GooglePlayException
     *
     * @dataProvider provideGetClusterPages
     */
    public function testGetClusterPages($category, ?AgeEnum $age): void
    {
        $clusterPagesGenerator = $this->gplay
            ->setDefaultLocale('en_US')
            ->setDefaultCountry('us')
            ->getClusterPages($category, $age)
        ;

        foreach ($clusterPagesGenerator as $clusterPage) {
            self::assertInstanceOf(ClusterPage::class, $clusterPage);
            self::assertNotEmpty($clusterPage->getTitle());
            self::assertNotEmpty($clusterPage->getUrl());
        }
    }

    public function provideGetClusterPages(): iterable
    {
        yield 'Index' => [null, null, null];

        yield 'Top Game Card' => ['GAME_CARD', null, 'top'];

        yield 'Art & Design category' => [CategoryEnum::ART_AND_DESIGN(), null, null];
    }
}
