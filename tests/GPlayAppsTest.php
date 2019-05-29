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
use Nelexa\GPlay\Model\Category;
use Nelexa\GPlay\Model\Developer;
use Nelexa\GPlay\Model\Permission;
use Nelexa\GPlay\Model\Review;
use Nelexa\GPlay\Request\RequestApp;
use Nelexa\GPlay\Util\LocaleHelper;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Cache\Simple\ArrayCache;

class GPlayAppsTest extends TestCase
{
    /**
     * @var GPlayApps
     */
    private $gplay;

    protected function setUp()
    {
        $gplay = new GPlayApps();
        $cache = new ArrayCache();
        $gplay->setCache($cache);
        $this->gplay = $gplay;
    }

    /**
     * @dataProvider provideConstruct
     * @param string|null $defaultLocale
     * @param string|null $defaultCountry
     * @param string $actualLocale
     * @param string $actualCountry
     */
    public function testConstruct($defaultLocale, $defaultCountry, $actualLocale, $actualCountry): void
    {
        $gplay = new GPlayApps($defaultLocale, $defaultCountry);
        $this->assertSame($gplay->getDefaultLocale(), $actualLocale);
        $this->assertSame($gplay->getDefaultCountry(), $actualCountry);
    }

    /**
     * @return array
     */
    public function provideConstruct(): array
    {
        return [
            [null, null, GPlayApps::DEFAULT_LOCALE, GPlayApps::DEFAULT_COUNTRY],
            ['ru', null, 'ru_RU', GPlayApps::DEFAULT_COUNTRY],
            ['ru_RU', 'ru', 'ru_RU', 'ru'],
        ];
    }

    /**
     * @throws GooglePlayException
     */
    public function testGetApp(): void
    {
        $appId = 'com.google.android.googlequicksearchbox';
        $locale = 'es';
        $country = 'ca';

        $app = $this->gplay->getApp(new RequestApp(
            $appId,
            $locale,
            $country
        ));

        $this->assertEquals($app->getId(), $appId);
        $this->assertEquals($app->getLocale(), LocaleHelper::getNormalizeLocale($locale));

        $app2 = $this->gplay->getApp($appId);
        $this->assertEquals($app2->getId(), $appId);
        $this->assertEquals($app2->getLocale(), GPlayApps::DEFAULT_LOCALE);
        $this->assertNotEquals($app2, $app);

        $this->gplay
            ->setDefaultLocale($locale)
            ->setDefaultCountry($country);
        $app3 = $this->gplay->getApp($appId);
        $this->assertEquals($app3->getId(), $appId);
        $this->assertEquals($app3->getLocale(), LocaleHelper::getNormalizeLocale($locale));
        $this->assertEquals($app3, $app);
    }

    /**
     * @throws GooglePlayException
     */
    public function testNotFoundApp(): void
    {
        $this->expectException(GooglePlayException::class);
        $this->expectExceptionMessage('404 Not Found');

        $this->gplay->getApp(new RequestApp('com.example'));
    }

    /**
     * @throws GooglePlayException
     */
    public function testGetAppWithEmptyAppId(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('$id is empty');

        $this->gplay->getApp(new RequestApp(''));
    }

    /**
     * @throws GooglePlayException
     */
    public function testGetAppWithNull(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('$requestApp is null');

        $this->gplay->getApp(null);
    }

    /**
     * @throws GooglePlayException
     */
    public function testGetApps(): void
    {
        /**
         * @var RequestApp[] $requests
         */
        $requests = [
            'com.google.android.googlequicksearchbox' => new RequestApp('com.vkontakte.android'),
            'com.android.chrome' => new RequestApp('com.android.chrome'),
        ];

        $apps = $this->gplay->getApps($requests);

        $this->assertCount(count($requests), $apps);
        $this->assertContainsOnlyInstancesOf(AppDetail::class, $apps);

        foreach ($requests as $key => $request) {
            $this->assertArrayHasKey($key, $apps);
            $this->assertEquals($apps[$key]->getId(), $request->getId());
        }
    }

    /**
     * @throws GooglePlayException
     */
    public function testGetApps2(): void
    {
        /**
         * @var RequestApp[] $requests
         */
        $requests = [
            /* 0 => */
            'com.google.android.googlequicksearchbox',
            /* 1 => */
            'com.android.chrome',
        ];

        $apps = $this->gplay->getApps($requests);

        $this->assertCount(count($requests), $apps);
        $this->assertContainsOnlyInstancesOf(AppDetail::class, $apps);

        foreach ($requests as $key => $appId) {
            $this->assertIsInt($key);
            $this->assertArrayHasKey($key, $apps);
            $this->assertEquals($apps[$key]->getId(), $appId);
        }
    }


    /**
     * @throws GooglePlayException
     */
    public function testGetAppsWithEmptyListIds(): void
    {
        $appDetails = $this->gplay->getApps([]);
        $this->assertIsArray($appDetails);
        $this->assertEmpty($appDetails);
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
        $id = new RequestApp($appId, 'en', 'ru');
        $locales = ['en', 'es', 'fr', 'ru', 'kk', 'uk', 'ar', 'zh-TW', 'zt-CN'];
        $apps = $this->gplay->getAppInLocales($id, $locales);
        $this->assertContainsOnlyInstancesOf(AppDetail::class, $apps);

        $this->assertCount(count($locales), $apps);

        foreach ($locales as $locale) {
            $this->assertArrayHasKey($locale, $apps);
            $this->assertSame($apps[$locale]->getId(), $appId);
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
        $this->assertContainsOnlyInstancesOf(AppDetail::class, $apps);

        $this->assertTrue(count(LocaleHelper::SUPPORTED_LOCALES) > count($apps));

        $this->assertArrayHasKey('ru_RU', $apps);
        $this->assertArrayHasKey('uk', $apps);
        $this->assertArrayHasKey('tr_TR', $apps);
        $this->assertArrayHasKey('en_US', $apps);

        $this->assertArrayNotHasKey('th', $apps);
        $this->assertArrayNotHasKey('fr_FR', $apps);
        $this->assertArrayNotHasKey('fil', $apps);
    }

    /**
     * @throws GooglePlayException
     */
    public function testGetAppInAvailableLocalesWithEmptyAppId(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('$id is empty');

        $this->gplay->getAppInAvailableLocales('');
    }

    /**
     * @dataProvider providePackageExists
     *
     * @param string $appId
     * @param bool $exists
     */
    public function testExistsApp(string $appId, bool $exists): void
    {
        $this->assertEquals($this->gplay->existsApp($appId), $exists);
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
            $this->assertEquals($result, $resultsProvider[$appId]);
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
            new RequestApp(
                'com.google.android.webview',
                $locale = 'zh_TW',
                $country = 'cn'
            ),
            $limit = 555,
            SortEnum::NEWEST()
        );
        $this->assertCount($limit, $reviews);
        $this->assertContainsOnlyInstancesOf(Review::class, $reviews);
    }

    /**
     * @throws GooglePlayException
     */
    public function testGetCategories(): void
    {
        $categories = $this->gplay->getCategories('ru');

        $this->assertNotEmpty($categories);
        $this->assertContainsOnlyInstancesOf(Category::class, $categories);
    }

    /**
     * @throws GooglePlayException
     */
    public function testGetCategoriesInLocales(): void
    {
        $categoriesInLocales = $this->gplay->getCategoriesInLocales(['ru', 'en', 'es', 'be', 'fil', 'zh-TW']);

        $this->assertNotEmpty($categoriesInLocales);
        foreach ($categoriesInLocales as $categories) {
            $this->assertContainsOnlyInstancesOf(Category::class, $categories);
        }
    }

    /**
     * @throws GooglePlayException
     */
    public function testGetCategoriesInAvailableLocales(): void
    {
        $this->gplay->setConcurrency(10);

        $categoriesInAvailableLocales = $this->gplay->getCategoriesInAvailableLocales();

        $this->assertNotEmpty($categoriesInAvailableLocales);
        foreach ($categoriesInAvailableLocales as $categories) {
            $this->assertContainsOnlyInstancesOf(Category::class, $categories);
        }
    }

    /**
     * @throws GooglePlayException
     */
    public function testDeveloperInfo(): void
    {
        $devInfo = $this->gplay->getDeveloperInfo(7935948260069539271, 'ru_RU');

        $this->assertNotEmpty($devInfo->getId());
        $this->assertNotEmpty($devInfo->getUrl());
        $this->assertNotEmpty($devInfo->getName());
        $this->assertNotEmpty($devInfo->getDescription());
        $this->assertNotEmpty($devInfo->getWebsite());
        $this->assertNotNull($devInfo->getIcon());
        $this->assertNotNull($devInfo->getHeaderImage());
        $this->assertNull($devInfo->getEmail());
        $this->assertNull($devInfo->getAddress());
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

        $app = $this->gplay->getApp(new RequestApp('com.facebook.katana'));
        $this->gplay->getDeveloperInfo($app);
    }

    /**
     * @throws GooglePlayException
     */
    public function testDeveloperInfoIncorrectArgument3(): void
    {
        $this->expectException(GooglePlayException::class);
        $this->expectExceptionMessage('Developer "Facebook" does not have a personalized page on Google Play.');

        $app = $this->gplay->getApp(new RequestApp('com.facebook.katana'));
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

        $this->assertNotEmpty($devInfo);
        $this->assertContainsOnlyInstancesOf(Developer::class, $devInfo);
    }

    /**
     * @throws GooglePlayException
     */
    public function testDevInfoInAvailableLocales(): void
    {
        $developer = $this->gplay->getDeveloperInfoInAvailableLocales(5627378377477294831);

        $this->assertNotEmpty($developer);
        $this->assertContainsOnlyInstancesOf(Developer::class, $developer);
    }

    /**
     * @throws GooglePlayException
     */
    public function testSuggest(): void
    {
        $suggest = $this->gplay->getSuggest('Maps', 'ar');
        $this->assertNotEmpty($suggest);
    }

    /**
     * @throws GooglePlayException
     */
    public function testSearch(): void
    {
        $limit = 222;
        $results = $this->gplay->search('News', $limit, PriceEnum::ALL());
        $this->assertNotEmpty($results);
        $this->assertCount($limit, $results);

        $this->assertContainsOnlyInstancesOf(App::class, $results);
    }

    /**
     * @throws GooglePlayException
     */
    public function testSimilarApps(): void
    {
        $limit = 125;
        $similarApps = $this->gplay->getSimilarApps('com.google.android.apps.docs.editors.docs', $limit);
        $this->assertNotEmpty($similarApps);
        $this->assertCount($limit, $similarApps);
        $this->assertContainsOnlyInstancesOf(App::class, $similarApps);
    }

    /**
     * @throws GooglePlayException
     */
    public function testAppsByCategory(): void
    {
        $apps = $this->gplay->getAppsByCategory(CategoryEnum::GAME(), CollectionEnum::TOP_FREE(), 140, AgeEnum::FIVE_UNDER(), 'ru', 'ru');
        $this->assertNotEmpty($apps);
        $this->assertCount(140, $apps);
        $this->assertContainsOnlyInstancesOf(App::class, $apps);
    }

    /**
     * @throws GooglePlayException
     */
    public function testPermission(): void
    {
        $permissions = $this->gplay->getPermissions('com.google.android.apps.docs.editors.docs');
        $this->assertNotEmpty($permissions);
        $this->assertContainsOnlyInstancesOf(Permission::class, $permissions);
    }

    /**
     * @throws GooglePlayException
     */
    public function testDeveloperApps(): void
    {
        $developerAppsById = $this->gplay->getDeveloperApps('5700313618786177705', 'ru_RU', 'by');
        $developerAppsByName = $this->gplay->getDeveloperApps('Google LLC', 'ru_RU', 'by');

        $this->assertNotEmpty($developerAppsById);
        $this->assertNotEmpty($developerAppsByName);

        $this->assertContainsOnly(App::class, $developerAppsById);
        $this->assertContainsOnly(App::class, $developerAppsByName);
    }

    /**
     * @throws GooglePlayException
     * @group proxy
     */
    public function testUseProxy(): void
    {
        $torProxy = 'socks5://127.0.0.1:9050';

        if (!$this->isSocks5Proxy($torProxy)) {
            $this->markTestSkipped('Tor is not available');
            return;
        }

        $appId = 'com.google.android.googlequicksearchbox';
        $appDetail = $this->gplay
            ->setProxy($torProxy)
            ->setTimeout(20.0)
            ->setConnectTimeout(20.0)
            ->setCache(null)
            ->getApp($appId);

        $this->assertSame($appDetail->getId(), $appId);
    }

    /**
     * @param string $proxy
     * @return bool
     */
    private function isSocks5Proxy(string $proxy): bool
    {
        $urlComponents = parse_url($proxy);
        if ($urlComponents === false || empty($urlComponents['host']) || empty($urlComponents['port'])) {
            return false;
        }
        if ($socket = @fsockopen($urlComponents['host'], $urlComponents['port'])) {
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
}
