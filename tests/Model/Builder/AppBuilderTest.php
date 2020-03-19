<?php

declare(strict_types=1);

namespace Nelexa\GPlay\Tests\Model\Builder;

use Nelexa\GPlay\Model\App;
use Nelexa\GPlay\Model\AppInfo;
use Nelexa\GPlay\Model\Category;
use Nelexa\GPlay\Model\Developer;
use Nelexa\GPlay\Model\GoogleImage;
use Nelexa\GPlay\Model\HistogramRating;
use Nelexa\GPlay\Model\ReplyReview;
use Nelexa\GPlay\Model\Review;
use Nelexa\GPlay\Model\Video;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @small
 */
final class AppBuilderTest extends TestCase
{
    /**
     * @dataProvider provideAppBuilderData
     *
     * @param array $data
     */
    public function testAppBuilder(array $data): void
    {
        $builder = App::newBuilder();

        try {
            $builder->build();
            self::fail('Application ID is null or empty');
        } catch (\InvalidArgumentException $e) {
            self::assertStringContainsString('Application ID cannot be null or empty', $e->getMessage());
        }

        $builder->setId($data['appId']);

        try {
            $builder->build();
            self::fail('Locale is null or empty');
        } catch (\InvalidArgumentException $e) {
            self::assertStringContainsString('Locale cannot be null or empty', $e->getMessage());
        }

        $builder->setLocale($data['locale']);

        try {
            $builder->build();
            self::fail('Country is null or empty');
        } catch (\InvalidArgumentException $e) {
            self::assertStringContainsString('Country cannot be null or empty', $e->getMessage());
        }

        $builder->setCountry($data['country']);

        try {
            $builder->build();
            self::fail('Application name is null or empty');
        } catch (\InvalidArgumentException $e) {
            self::assertStringContainsString('application name cannot be null or empty', $e->getMessage());
        }

        $builder->setName($data['appName']);

        try {
            $builder->build();
            self::fail('Developer is null');
        } catch (\InvalidArgumentException $e) {
            self::assertStringContainsString('developer cannot be null', $e->getMessage());
        }

        $developer = new Developer(
            $devBuilder = Developer::newBuilder()
                ->setId($data['developerId'])
                ->setUrl($data['developerUrl'])
                ->setName($data['developerName'])
        );

        $builder->setDeveloper($developer);

        try {
            $builder->build();
            self::fail('Application icon is null');
        } catch (\InvalidArgumentException $e) {
            self::assertStringContainsString('Application icon cannot be null', $e->getMessage());
        }

        $icon = new GoogleImage($data['iconUrl']);
        $builder->setIcon($icon);

        $app = $builder->build();

        self::assertSame($app->getId(), $data['appId']);
        self::assertSame($app->getUrl(), $data['appUrl']);
        self::assertSame($app->getLocale(), $data['locale']);
        self::assertSame($app->getName(), $data['appName']);

        self::assertSame($app->getIcon(), $icon);
        self::assertSame($app->getIcon()->getUrl(), $data['iconUrl']);

        self::assertSame($app->getDeveloper(), $developer);
        self::assertSame($app->getDeveloper()->getId(), $data['developerId']);
        self::assertSame($app->getDeveloper()->getUrl(), $data['developerUrl']);
        self::assertSame($app->getDeveloper()->getName(), $data['developerName']);

        self::assertNull($app->getSummary());
        self::assertSame($app->getScore(), 0.0);
        self::assertNull($app->getPriceText());
        self::assertTrue($app->isFree());

        $builder
            ->setSummary($data['summary'])
            ->setScore($data['score'])
            ->setPriceText($data['priceText'])
        ;

        $appPaid = $builder->build();
        self::assertNotEquals($app, $appPaid);

        self::assertSame($appPaid->getSummary(), $data['summary']);
        self::assertSame($appPaid->getScore(), $data['score']);
        self::assertSame($appPaid->getPriceText(), $data['priceText']);
        self::assertFalse($appPaid->isFree());

        // AppInfo
        try {
            $builder->buildDetailInfo();
            self::fail('Application description is null or empty');
        } catch (\InvalidArgumentException $e) {
            self::assertStringContainsString('Application description cannot be null or empty', $e->getMessage());
        }

        $builder->setDescription($data['description']);

        try {
            $builder->buildDetailInfo();
            self::fail('Screenshots are empty');
        } catch (\InvalidArgumentException $e) {
            self::assertStringContainsString('Screenshots', $e->getMessage());
        }

        foreach ($data['screenshots'] as $screenshot) {
            $builder->addScreenshot($screenshot);
        }

        self::assertSame($builder->getScreenshots(), $data['screenshots']);
        $builder->setScreenshots([]);
        self::assertEmpty($builder->getScreenshots());
        $builder->setScreenshots($data['screenshots']);
        self::assertSame($builder->getScreenshots(), $data['screenshots']);

        $category = new Category($data['categoryId'], $data['categoryName']);
        $builder->setCategory($category);

        $appInfo = $builder->buildDetailInfo();
        self::assertNull($appInfo->getDeveloper()->getDescription());
        self::assertSame($appInfo->getId(), $data['appId']);
        self::assertSame($appInfo->getLocale(), $data['locale']);
        self::assertSame($appInfo->getDescription(), $data['description']);
        self::assertSame($appInfo->getScreenshots(), $data['screenshots']);
        self::assertSame($appInfo->getCategory(), $category);
        self::assertSame($appInfo->getCategory()->getId(), $data['categoryId']);
        self::assertSame($appInfo->getCategory()->getName(), $data['categoryName']);
        self::assertFalse($appInfo->getCategory()->isFamilyCategory());

        self::assertNull($appInfo->getTranslatedFromLocale());
        self::assertNull($appInfo->getCover());
        self::assertNull($appInfo->getPrivacyPoliceUrl());
        self::assertNull($appInfo->getCategoryFamily());
        self::assertNull($appInfo->getVideo());
        self::assertNull($appInfo->getRecentChanges());
        self::assertFalse($appInfo->isEditorsChoice());
        self::assertSame($appInfo->getInstalls(), 0);
        self::assertSame($appInfo->getNumberVoters(), 0);
        self::assertEquals(
            $appInfo->getHistogramRating(),
            new HistogramRating(0, 0, 0, 0, 0)
        );
        self::assertSame($appInfo->getPrice(), 0.0);
        self::assertSame($appInfo->getCurrency(), 'USD');
        self::assertNull($appInfo->getOffersIAPCost());
        self::assertFalse($appInfo->isContainsIAP());
        self::assertFalse($appInfo->isContainsAds());
        self::assertNull($appInfo->getSize());
        self::assertNull($appInfo->getAppVersion());
        self::assertNull($appInfo->getAndroidVersion());
        self::assertNull($appInfo->getMinAndroidVersion());
        self::assertNull($appInfo->getContentRating());
        self::assertNull($appInfo->getReleased());
        self::assertNull($appInfo->getUpdated());
        self::assertSame($appInfo->getNumberReviews(), 0);
        self::assertIsArray($appInfo->getReviews());
        self::assertEmpty($appInfo->getReviews());

        $categoryFamily = new Category($data['categoryFamilyId'], $data['categoryFamilyName']);
        $video = new Video($data['videoThumbUrl'], $data['videoUrl']);

        $developer = new Developer(
            $devBuilder
                ->setEmail($data['developerEmail'])
                ->setAddress($data['developerAddress'])
                ->setWebsite($data['developerSite'])
        );

        $builder
            ->setDeveloper($developer)
            ->setTranslatedFromLocale($data['translatedFromLocale'])
            ->setCover($data['cover'])
            ->setPrivacyPoliceUrl($data['privacyPoliceUrl'])
            ->setCategoryFamily($categoryFamily)
            ->setVideo($video)
            ->setRecentChanges($data['recentChanges'])
            ->setEditorsChoice($data['editorChoice'])
            ->setInstalls($data['installs'])
            ->setNumberVoters($data['numberVoters'])
            ->setHistogramRating($data['histogramRating'])
            ->setPrice($data['price'])
            ->setCurrency($data['currency'])
            ->setPriceText($data['priceTextEur'])
            ->setOffersIAPCost($data['offersIAPCost'])
            ->setContainsAds($data['containsAds'])
            ->setSize($data['size'])
            ->setAppVersion($data['appVersion'])
            ->setAndroidVersion($data['androidVersion'])
            ->setMinAndroidVersion($data['minAndroidVersion'])
            ->setContentRating($data['contentRating'])
            ->setReleased($data['released'])
            ->setUpdated($data['updated'])
            ->setNumberReviews($data['numberReviews'])
            ->setReviews($data['reviews'])
        ;

        $appInfo = $builder->buildDetailInfo();

        self::assertSame($appInfo->getDeveloper(), $developer);
        self::assertSame($appInfo->getDeveloper()->getEmail(), $data['developerEmail']);
        self::assertSame($appInfo->getDeveloper()->getAddress(), $data['developerAddress']);
        self::assertSame($appInfo->getDeveloper()->getWebsite(), $data['developerSite']);
        self::assertNull($appInfo->getDeveloper()->getDescription());
        self::assertNull($appInfo->getDeveloper()->getCover());
        self::assertNull($appInfo->getDeveloper()->getIcon());

        self::assertSame($appInfo->getTranslatedFromLocale(), $data['translatedFromLocale']);
        self::assertSame($appInfo->getCover(), $data['cover']);
        self::assertSame($appInfo->getPrivacyPoliceUrl(), $data['privacyPoliceUrl']);
        self::assertSame($appInfo->getCategoryFamily(), $categoryFamily);
        self::assertSame($appInfo->getCategoryFamily()->getId(), $data['categoryFamilyId']);
        self::assertSame($appInfo->getCategoryFamily()->getName(), $data['categoryFamilyName']);
        self::assertTrue($appInfo->getCategoryFamily()->isFamilyCategory());
        self::assertSame($appInfo->getVideo(), $video);
        self::assertSame($appInfo->getVideo()->getImageUrl(), $data['videoThumbUrl']);
        self::assertSame($appInfo->getVideo()->getVideoUrl(), $data['videoUrl']);
        self::assertSame($appInfo->getVideo()->getYoutubeId(), $data['youtubeId']);
        self::assertSame($appInfo->getRecentChanges(), $data['recentChanges']);
        self::assertSame($appInfo->isEditorsChoice(), $data['editorChoice']);
        self::assertSame($appInfo->getInstalls(), $data['installs']);
        self::assertSame($appInfo->getNumberVoters(), $data['numberVoters']);
        self::assertSame($appInfo->getHistogramRating(), $data['histogramRating']);
        self::assertSame($appInfo->getPrice(), $data['price']);
        self::assertSame($appInfo->getCurrency(), $data['currency']);
        self::assertSame($appInfo->getPriceText(), $data['priceTextEur']);
        self::assertSame($appInfo->getOffersIAPCost(), $data['offersIAPCost']);
        self::assertTrue($appInfo->isContainsIAP());
        self::assertTrue($appInfo->isContainsAds());
        self::assertSame($appInfo->getSize(), $data['size']);
        self::assertSame($appInfo->getAppVersion(), $data['appVersion']);
        self::assertSame($appInfo->getAndroidVersion(), $data['androidVersion']);
        self::assertSame($appInfo->getMinAndroidVersion(), $data['minAndroidVersion']);
        self::assertSame($appInfo->getContentRating(), $data['contentRating']);
        self::assertSame($appInfo->getReleased(), $data['released']);
        self::assertSame($appInfo->getUpdated(), $data['updated']);
        self::assertSame($appInfo->getNumberReviews(), $data['numberReviews']);
        self::assertSame($appInfo->getReviews(), $data['reviews']);
    }

    /**
     * @throws \Exception
     *
     * @return array
     */
    public function provideAppBuilderData(): array
    {
        return [
            [
                [
                    'appId' => 'com.test',
                    'locale' => 'en_US',
                    'country' => 'us',
                    'appUrl' => 'https://play.google.com/store/apps/details?id=com.test',
                    'appName' => 'Test',
                    'iconUrl' => 'https://lh3.googleusercontent.com/DKoidc0T3T1KvYC2stChcX9zwmjKj1pgmg3hXzGBDQXM8RG_7JjgiuS0CLOh8DUa7as=s180',
                    'developerId' => '11111111111',
                    'developerUrl' => 'https://play.google.com/store/apps/dev?id=11111111111',
                    'developerName' => 'Test Developer',
                    'developerEmail' => 'test@example.com',
                    'developerSite' => 'https://example.com',
                    'developerAddress' => 'Test Address',
                    'summary' => 'tested application',
                    'score' => 4.235324,
                    'priceText' => '$0.99',
                    'description' => 'Description du test',
                    'screenshots' => [
                        new GoogleImage(
                            'https://lh3.ggpht.com/ueLFEoDXfL5ng9SeWLqstSw4GLAXyLgDSym5JKykOHpv_s0sm2HHHI_d2dAC_ugDyw=w720-h310'
                        ),
                        new GoogleImage(
                            'https://lh3.ggpht.com/bhb0uFArLTzGg515ayV_eOYNlgtmDkwQjhTmQIfK1r_U0nS7fOp2Xfz6dpLGQCUcPOHt=w720-h310'
                        ),
                        new GoogleImage(
                            'https://lh3.ggpht.com/pHNFX1g4E3QTnytKFOry-8rbaOMR9P8nT4IiuBZVYMHjfJLOYFsKSGvvTr_92SXafzU=w720-h310'
                        ),
                    ],
                    'categoryId' => 'EVENTS',
                    'categoryName' => 'Events',
                    'released' => new \DateTimeImmutable(
                        '-33 months',
                        new \DateTimeZone('UTC')
                    ),
                    'translatedFromLocale' => 'fr_FR',
                    'cover' => new GoogleImage(
                        'https://lh3.googleusercontent.com/_X0MDs89e-vT-xHIfPWnx3ws1brEhC8v1cx3cuwubc9EYDIav3h2ickpUJJfWm1UBqg'
                    ),
                    'privacyPoliceUrl' => 'https://www.example.com/privacy.html',
                    'categoryFamilyId' => 'FAMILY_CREATE',
                    'categoryFamilyName' => 'Creativity',
                    'youtubeId' => 'Rz00UQ3dQyE',
                    'videoThumbUrl' => 'https://i.ytimg.com/vi/Rz00UQ3dQyE/hqdefault.jpg',
                    'videoUrl' => 'https://www.youtube.com/embed/Rz00UQ3dQyE?ps=play&vq=large&rel=0&autohide=1&showinfo=0',
                    'recentChanges' => 'Bug fixes',
                    'editorChoice' => true,
                    'installs' => 37539148,
                    'numberVoters' => 543269,
                    'histogramRating' => new HistogramRating(
                        285734,
                        170923,
                        47321,
                        13503,
                        25788
                    ),
                    'price' => 0.99,
                    'currency' => 'EUR',
                    'priceTextEur' => '€0.99',
                    'offersIAPCost' => '€1.89 per item',
                    'containsAds' => true,
                    'size' => '7.4M',
                    'appVersion' => '1.0.2',
                    'androidVersion' => '4.1 and up',
                    'minAndroidVersion' => '4.1',
                    'contentRating' => 'PEGI 3',
                    'updated' => new \DateTimeImmutable(
                        '-3 days 30 min',
                        new \DateTimeZone('UTC')
                    ),
                    'numberReviews' => 15266,
                    'reviews' => [
                        new Review(
                            'gp:XXXXXXXXXXX',
                            'https://play.google.com/store/apps/details?id=com.test&hl=en_US&reviewId=gp:XXXXXXXXXXX',
                            'Google User',
                            'The best app!',
                            new GoogleImage(
                                'https://lh5.googleusercontent.com/-hGyaot6je8A/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rcSBa3olHGF7huPpQN97OQA01cmTQ/w200/avatar.jpg'
                            ),
                            new \DateTimeImmutable('2019-04-27 00:00:00.000000'),
                            4,
                            1,
                            new ReplyReview(
                                new \DateTimeImmutable('2019-04-28 00:00:00.000000'),
                                'Thanks!'
                            )
                        ),
                        new Review(
                            'gp:YYYYYYYYYYYYY',
                            'https://play.google.com/store/apps/details?id=com.test&hl=en_US&reviewId=gp:YYYYYYYYYYYYY',
                            'Google User',
                            'This app requires way too many permissions. The app requires access to your app history, web browsing history, and every other permission available just to make a phone call.',
                            new GoogleImage(
                                'https://lh4.googleusercontent.com/-l2Ebb1iCsto/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rd_fPyE4q23MdG95wvDs4_XJ27z6g/'
                            ),
                            new \DateTimeImmutable('2019-04-25 04:32:01.000000'),
                            2,
                            1514
                        ),
                    ],
                ],
            ],
        ];
    }

    public function testAppInfoEquals(): void
    {
        $builder = AppInfo::newBuilder()
            ->setId('com.test')
            ->setName('test')
            ->setLocale('en_US')
            ->setCountry('us')
            ->setDeveloper(
                new Developer(
                    Developer::newBuilder()
                        ->setId('010101101010')
                        ->setName('developer test')
                        ->setUrl('https://example.com/')
                )
            )
            ->setIcon(
                new GoogleImage(
                    'https://lh3.googleusercontent.com/DKoidc0T3T1KvYC2stChcX9zwmjKj1pgmg3hXzGBDQXM8RG_7JjgiuS0CLOh8DUa7as=s180'
                )
            )
            ->setDescription('test description')
            ->addScreenshot(
                new GoogleImage(
                    'https://lh3.googleusercontent.com/1Ec6E-6nPcTn6OYzH9_P8sKupUsfJhbUd8M-iEOkzimaMr9CALI-KUpT2UyxHQUOPSY=w720-h310'
                )
            )
            ->setCategory(
                new Category(
                    'TEST',
                    'Test Category'
                )
            )
        ;

        $builder2 = clone $builder;

        $appInfo = $builder->buildDetailInfo();
        $appInfo2 = new AppInfo($builder2);
        self::assertEquals($appInfo2, $appInfo);
        self::assertTrue($appInfo->equals($appInfo2));

        $builder2->setIcon(
            new GoogleImage(
                'https://lh3.googleusercontent.com/v0e5DxXFtAlnNzdxgpEd6tcS5r6sKxd1oswufLlQFuqOmMjGAukJXrUN5RtHabg69A=s180'
            )
        );
        $appInfo2 = new AppInfo($builder2);
        self::assertNotEquals($appInfo2, $appInfo);
        self::assertFalse($appInfo->equals($appInfo2));
    }
}
