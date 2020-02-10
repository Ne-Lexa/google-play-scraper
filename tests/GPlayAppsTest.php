<?php

declare(strict_types=1);

namespace Nelexa\GPlay\Tests;

use Nelexa\GPlay\Enum\AgeEnum;
use Nelexa\GPlay\Enum\CategoryEnum;
use Nelexa\GPlay\Enum\CollectionEnum;
use Nelexa\GPlay\Enum\PriceEnum;
use Nelexa\GPlay\Enum\SortEnum;
use Nelexa\GPlay\Exception\GooglePlayException;
use Nelexa\GPlay\GPlayApps;
use Nelexa\GPlay\Model\App;
use Nelexa\GPlay\Model\AppDetail;
use Nelexa\GPlay\Model\AppId;
use Nelexa\GPlay\Model\Category;
use Nelexa\GPlay\Model\Developer;
use Nelexa\GPlay\Model\Permission;
use Nelexa\GPlay\Model\Review;
use Nelexa\GPlay\Util\LocaleHelper;
use PHPUnit\Framework\TestCase;
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

    /**
     * @noinspection PhpComposerExtensionStubsInspection
     */
    protected function setUp(): void
    {
        $cacheNamespace = 'nelexa.gplay.v1';

        if (class_exists(\Redis::class)) {
            $redis = new \Redis();

            if ($redis->connect('127.0.0.1')) {
                $psr6Cache = new RedisAdapter($redis, $cacheNamespace);
            }
        }

        if (!isset($psr6Cache)) {
            $psr6Cache = new FilesystemAdapter($cacheNamespace);
        }
        $psr16Cache = new Psr16Cache($psr6Cache);

        $gplay = new GPlayApps();
        $gplay->setCache($psr16Cache);
        $this->gplay = $gplay;
    }

    /**
     * @dataProvider provideConstruct
     *
     * @param string|null $defaultLocale
     * @param string|null $defaultCountry
     * @param string      $actualLocale
     * @param string      $actualCountry
     */
    public function testConstruct($defaultLocale, $defaultCountry, $actualLocale, $actualCountry): void
    {
        $gplay = new GPlayApps($defaultLocale, $defaultCountry);
        self::assertSame($gplay->getLocale(), $actualLocale);
        self::assertSame($gplay->getCountry(), $actualCountry);
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
        self::assertSame($gplay->getLocale(), GPlayApps::DEFAULT_LOCALE);
        self::assertSame($gplay->getCountry(), GPlayApps::DEFAULT_COUNTRY);
    }

    /**
     * @throws GooglePlayException
     */
    public function testGetApp(): void
    {
        $appId = 'com.google.android.googlequicksearchbox';
        $locale = 'es';
        $country = 'ca';

        $app = $this->gplay->getApp(
            new AppId(
                $appId,
                $locale,
                $country
            )
        );

        self::assertEquals($app->getId(), $appId);
        self::assertEquals($app->getLocale(), LocaleHelper::getNormalizeLocale($locale));

        $app2 = $this->gplay->getApp($appId);
        self::assertEquals($app2->getId(), $appId);
        self::assertEquals($app2->getLocale(), GPlayApps::DEFAULT_LOCALE);
        self::assertNotEquals($app2, $app);

        $this->gplay
            ->setLocale($locale)
            ->setCountry($country)
        ;
        $app3 = $this->gplay->getApp($appId);
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

        $this->gplay->getApp(new AppId('com.example'));
    }

    /**
     * @dataProvider provideInvalidAppId
     *
     * @param mixed  $appId
     * @param string $exceptionMessage
     *
     * @throws GooglePlayException
     */
    public function testGetAppInvalidAppId($appId, string $exceptionMessage): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage($exceptionMessage);

        $this->gplay->getApp($appId);
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
    public function testGetApps(): void
    {
        /**
         * @var AppId[] $requests
         */
        $requests = [
            'com.google.android.googlequicksearchbox' => new AppId('com.vkontakte.android'),
            'com.android.chrome' => new AppId('com.android.chrome'),
        ];

        $apps = $this->gplay->getApps($requests);

        self::assertCount(\count($requests), $apps);
        self::assertContainsOnlyInstancesOf(AppDetail::class, $apps);

        foreach ($requests as $key => $request) {
            self::assertArrayHasKey($key, $apps);
            self::assertEquals($apps[$key]->getId(), $request->getId());
        }
    }

    /**
     * @throws GooglePlayException
     */
    public function testGetApps2(): void
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

        $apps = $this->gplay->getApps($requests);

        self::assertCount(\count($requests), $apps);
        self::assertContainsOnlyInstancesOf(AppDetail::class, $apps);

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
        $appDetails = $this->gplay->getApps([]);
        self::assertIsArray($appDetails);
        self::assertEmpty($appDetails);
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
        $this->gplay->getApps($ids);
    }

    /**
     * @throws GooglePlayException
     */
    public function testGetAppInLocales(): void
    {
        $this->gplay->setConcurrency(6);

        $appId = 'com.google.android.calculator';
        $id = new AppId($appId, 'en', 'ru');
        $locales = ['en', 'es', 'fr', 'ru', 'kk', 'uk', 'ar', 'zh-TW', 'zt-CN'];
        $apps = $this->gplay->getAppInLocales($id, $locales);
        self::assertContainsOnlyInstancesOf(AppDetail::class, $apps);

        self::assertCount(\count($locales), $apps);

        foreach ($locales as $locale) {
            self::assertArrayHasKey($locale, $apps);
            self::assertSame($apps[$locale]->getId(), $appId);
        }
    }

    /**
     * @throws GooglePlayException
     */
    public function testGetAppInAvailableLocales(): void
    {
        $this->gplay->setConcurrency(10);

        $id = 'ru.yandex.metro';
        $apps = $this->gplay->getAppInAvailableLocales($id);
        self::assertContainsOnlyInstancesOf(AppDetail::class, $apps);

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
    public function testGetAppInAvailableLocalesWithEmptyAppId(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Application ID cannot be empty');

        $this->gplay->getAppInAvailableLocales('');
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
    public function testGetAppReviews(): void
    {
        $reviews = $this->gplay->getAppReviews(
            new AppId(
                'com.google.android.webview',
                $locale = 'zh_TW',
                $country = 'cn'
            ),
            $limit = 555,
            SortEnum::NEWEST()
        );
        self::assertCount($limit, $reviews);
        self::assertContainsOnlyInstancesOf(Review::class, $reviews);
    }

    /**
     * @throws GooglePlayException
     */
    public function testGetCategories(): void
    {
        $this->gplay->setLocale('ru');
        $categories = $this->gplay->getCategories();

        self::assertNotEmpty($categories);
        self::assertContainsOnlyInstancesOf(Category::class, $categories);
    }

    /**
     * @throws GooglePlayException
     */
    public function testGetCategoriesInLocales(): void
    {
        $categoriesInLocales = $this->gplay->getCategoriesInLocales(['ru', 'en', 'es', 'be', 'fil', 'zh-TW']);

        self::assertNotEmpty($categoriesInLocales);

        foreach ($categoriesInLocales as $categories) {
            self::assertContainsOnlyInstancesOf(Category::class, $categories);
        }
    }

    /**
     * @throws GooglePlayException
     */
    public function testGetCategoriesInAvailableLocales(): void
    {
        $this->gplay->setConcurrency(10);

        $categoriesInAvailableLocales = $this->gplay->getCategoriesInAvailableLocales();

        self::assertNotEmpty($categoriesInAvailableLocales);

        foreach ($categoriesInAvailableLocales as $categories) {
            self::assertContainsOnlyInstancesOf(Category::class, $categories);
        }
    }

    /**
     * @throws GooglePlayException
     */
    public function testDeveloperInfo(): void
    {
        $this->gplay->setLocale('ru_RU');
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
        $this->expectExceptionMessage('Developer "Facebook" does not have a personalized page on Google Play.');

        $app = $this->gplay->getApp(new AppId('com.facebook.katana'));
        $this->gplay->getDeveloperInfo($app);
    }

    /**
     * @throws GooglePlayException
     */
    public function testDeveloperInfoIncorrectArgument3(): void
    {
        $this->expectException(GooglePlayException::class);
        $this->expectExceptionMessage('Developer "Facebook" does not have a personalized page on Google Play.');

        $app = $this->gplay->getApp(new AppId('com.facebook.katana'));
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
    public function testDevInfoInLocales(): void
    {
        $devInfo = $this->gplay->getDeveloperInfoInLocales(5627378377477294831, ['ru_RU', 'uk', 'en', 'fr', 'be']);

        self::assertNotEmpty($devInfo);
        self::assertContainsOnlyInstancesOf(Developer::class, $devInfo);
    }

    /**
     * @throws GooglePlayException
     */
    public function testSuggest(): void
    {
        $suggest = $this->gplay->setLocale('ar')->getSearchSuggestions('Maps');
        self::assertNotEmpty($suggest);
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
        self::assertCount($limit, $similarApps);
        self::assertContainsOnlyInstancesOf(App::class, $similarApps);
    }

    /**
     * @throws GooglePlayException
     */
    public function testAppsByCategory(): void
    {
        $apps = $this->gplay->getAppsByCategory(
            CategoryEnum::GAME(),
            CollectionEnum::TRENDING(),
            140,
            AgeEnum::FIVE_UNDER()
        );
        self::assertNotEmpty($apps);
        self::assertCount(140, $apps);
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
            ->setLocale('ru_RU')
            ->setCountry('be')
        ;

        $developerAppsById = $this->gplay->getDeveloperApps('5700313618786177705');
        $developerAppsByName = $this->gplay->getDeveloperApps('Google LLC');

        self::assertNotEmpty($developerAppsById);
        self::assertNotEmpty($developerAppsByName);

        self::assertContainsOnly(App::class, $developerAppsById);
        self::assertContainsOnly(App::class, $developerAppsByName);
    }

    /**
     * @throws GooglePlayException
     * @group proxy
     */
    public function testUseProxy(): void
    {
        $torProxy = 'socks5://127.0.0.1:9050';

        if (!$this->isSocks5Proxy($torProxy)) {
            self::markTestSkipped('Tor is not available');

            return;
        }

        $appId = 'com.google.android.googlequicksearchbox';
        $appDetail = $this->gplay
            ->setProxy($torProxy)
            ->setTimeout(20.0)
            ->setConnectTimeout(20.0)
            ->setCache(null)
            ->getApp($appId)
        ;

        self::assertSame($appDetail->getId(), $appId);
    }

    /**
     * @param string $proxy
     *
     * @return bool
     */
    private function isSocks5Proxy(string $proxy): bool
    {
        $urlComponents = parse_url($proxy);

        if ($urlComponents === false || empty($urlComponents['host']) || empty($urlComponents['port'])) {
            return false;
        }
        $socket = fsockopen($urlComponents['host'], $urlComponents['port']);

        if ($socket !== false) {
            try {
                fwrite($socket, pack('C3', 0x05, 0x01, 0x00));
                $buffer = fread($socket, 2);
                $response = unpack('Cversion/Cmethod', $buffer);

                if ($response['version'] === 0x05 && $response['method'] === 0x00) {
                    return true;
                }
            } finally {
                fclose($socket);
            }
        }

        return false;
    }

    public function testClone(): void
    {
        $this->gplay->setLocale('ko_KR')->setCountry('ko');

        self::assertEquals($this->gplay->getLocale(), 'ko_KR');
        self::assertEquals($this->gplay->getCountry(), 'ko');

        $anotherGplay = clone $this->gplay;

        self::assertNotSame($anotherGplay, $this->gplay);

        self::assertEquals($anotherGplay->getLocale(), 'ko_KR');
        self::assertEquals($anotherGplay->getCountry(), 'ko');

        $anotherGplay->setLocale('es_ES')->setCountry('es');
        self::assertEquals($anotherGplay->getLocale(), 'es_ES');
        self::assertEquals($anotherGplay->getCountry(), 'es');

        self::assertEquals($this->gplay->getLocale(), 'ko_KR');
        self::assertEquals($this->gplay->getCountry(), 'ko');
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
    public function testReleaseDateInAllLocales(string $actualReleaseDate, string $packageName): void
    {
        $appDetails = $this->gplay->getAppInAvailableLocales($packageName);

        foreach ($appDetails as $appDetail) {
            $released = $appDetail->getReleased();
            $errorMessage = 'Error equals released date in ' . $appDetail->getLocale() . ' locale';
            self::assertSame(
                $released->format('Y.m.d'),
                $actualReleaseDate,
                $errorMessage
            );
        }
    }

    /**
     * @return \Generator|null
     */
    public function provideReleaseApps(): ?\Generator
    {
        yield ['2016.01.11', 'com.skgames.trafficrider'];
        yield ['2019.02.28', 'com.budgestudios.googleplay.MyLittlePonyPocketPonies'];
        yield ['2011.03.06', 'sp.app.bubblePop'];
        yield ['2014.04.30', 'com.google.android.apps.docs.editors.docs'];
        yield ['2010.05.24', 'com.adobe.reader'];
        yield ['2015.06.17', 'com.disney.thoughtbubbles_goo'];
        yield ['2011.07.19', 'com.viber.voip'];
        yield ['2010.08.12', 'com.google.android.googlequicksearchbox'];
        yield ['2012.09.26', 'com.rovio.BadPiggiesHD'];
        yield ['2014.10.22', 'com.gamehouse.slingo'];
        yield ['2010.11.01', 'com.maxmpz.audioplayer'];
        yield ['2014.12.22', 'ru.cian.main'];
    }
}
