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
use Symfony\Component\Cache\Psr16Cache;

class GPlayAppsTest extends TestCase
{
    /**
     * @var GPlayApps
     */
    private $gplay;

    protected function setUp()
    {
        $psr6Cache = new FilesystemAdapter();
        $psr16Cache = new Psr16Cache($psr6Cache);

        $gplay = new GPlayApps();
        $gplay->setCache($psr16Cache);
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
        $this->assertSame($gplay->getLocale(), $actualLocale);
        $this->assertSame($gplay->getCountry(), $actualCountry);
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
        $this->assertSame($gplay->getLocale(), GPlayApps::DEFAULT_LOCALE);
        $this->assertSame($gplay->getCountry(), GPlayApps::DEFAULT_COUNTRY);
    }

    /**
     * @throws GooglePlayException
     */
    public function testGetApp(): void
    {
        $appId = 'com.google.android.googlequicksearchbox';
        $locale = 'es';
        $country = 'ca';

        $app = $this->gplay->getApp(new AppId(
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
            ->setLocale($locale)
            ->setCountry($country);
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

        $this->gplay->getApp(new AppId('com.example'));
    }

    /**
     * @dataProvider provideInvalidAppId
     * @param mixed $appId
     * @param string $exceptionMessage
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
         * @var AppId[] $requests
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
        $id = new AppId($appId, 'en', 'ru');
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
        $this->expectExceptionMessage('Application ID cannot be empty');

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
            new AppId(
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
        $this->gplay->setLocale('ru');
        $categories = $this->gplay->getCategories();

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
        $this->gplay->setLocale('ru_RU');
        $devInfo = $this->gplay->getDeveloperInfo(7935948260069539271);

        $this->assertNotEmpty($devInfo->getId());
        $this->assertNotEmpty($devInfo->getUrl());
        $this->assertNotEmpty($devInfo->getName());
        $this->assertNotEmpty($devInfo->getDescription());
        $this->assertNotEmpty($devInfo->getWebsite());
        $this->assertNotNull($devInfo->getIcon());
        $this->assertNotNull($devInfo->getCover());
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

        $this->assertNotEmpty($devInfo);
        $this->assertContainsOnlyInstancesOf(Developer::class, $devInfo);
    }

    /**
     * @throws GooglePlayException
     */
    public function testSuggest(): void
    {
        $suggest = $this->gplay->setLocale('ar')->getSearchSuggestions('Maps');
        $this->assertNotEmpty($suggest);
    }

    /**
     * @throws GooglePlayException
     */
    public function testSearch(): void
    {
        $results = $this->gplay->search('News', GPlayApps::UNLIMIT, PriceEnum::ALL());
        $this->assertNotEmpty($results);
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
        $apps = $this->gplay->getAppsByCategory(CategoryEnum::GAME(), CollectionEnum::TRENDING(), 140, AgeEnum::FIVE_UNDER());
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
        $this->gplay
            ->setLocale('ru_RU')
            ->setCountry('be');

        $developerAppsById = $this->gplay->getDeveloperApps('5700313618786177705');
        $developerAppsByName = $this->gplay->getDeveloperApps('Google LLC');

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

    public function testClone(): void
    {
        $this->gplay->setLocale('ko_KR')->setCountry('ko');

        $this->assertEquals($this->gplay->getLocale(), 'ko_KR');
        $this->assertEquals($this->gplay->getCountry(), 'ko');

        $anotherGplay = clone $this->gplay;

        $this->assertNotSame($anotherGplay, $this->gplay);

        $this->assertEquals($anotherGplay->getLocale(), 'ko_KR');
        $this->assertEquals($anotherGplay->getCountry(), 'ko');

        $anotherGplay->setLocale('es_ES')->setCountry('es');
        $this->assertEquals($anotherGplay->getLocale(), 'es_ES');
        $this->assertEquals($anotherGplay->getCountry(), 'es');

        $this->assertEquals($this->gplay->getLocale(), 'ko_KR');
        $this->assertEquals($this->gplay->getCountry(), 'ko');
    }
}
