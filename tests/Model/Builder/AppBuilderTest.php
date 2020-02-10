<?php

declare(strict_types=1);

namespace Nelexa\GPlay\Tests\Model\Builder;

use Nelexa\GPlay\Model\App;
use Nelexa\GPlay\Model\AppDetail;
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
            new App($builder);
            self::fail('Application ID is null or empty');
        } catch (\InvalidArgumentException $e) {
            self::assertStringContainsString('Application ID cannot be null or empty', $e->getMessage());
        }

        $builder->setId($data['appId']);

        try {
            new App($builder);
            self::fail('Locale is null or empty');
        } catch (\InvalidArgumentException $e) {
            self::assertStringContainsString('Locale cannot be null or empty', $e->getMessage());
        }

        $builder->setLocale($data['locale']);

        try {
            new App($builder);
            self::fail('Country is null or empty');
        } catch (\InvalidArgumentException $e) {
            self::assertStringContainsString('Country cannot be null or empty', $e->getMessage());
        }

        $builder->setCountry($data['country']);

        try {
            new App($builder);
            self::fail('Application name is null or empty');
        } catch (\InvalidArgumentException $e) {
            self::assertStringContainsString('application name cannot be null or empty', $e->getMessage());
        }

        $builder->setName($data['appName']);

        try {
            new App($builder);
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
            new App($builder);
            self::fail('Application icon is null');
        } catch (\InvalidArgumentException $e) {
            self::assertStringContainsString('Application icon cannot be null', $e->getMessage());
        }

        $icon = new GoogleImage($data['iconUrl']);
        $builder->setIcon($icon);

        $app = new App($builder);

        self::assertInstanceOf(App::class, $app);

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

        $appPaid = new App($builder);
        self::assertNotEquals($app, $appPaid);

        self::assertSame($appPaid->getSummary(), $data['summary']);
        self::assertSame($appPaid->getScore(), $data['score']);
        self::assertSame($appPaid->getPriceText(), $data['priceText']);
        self::assertFalse($appPaid->isFree());

        // AppDetail
        try {
            new AppDetail($builder);
            self::fail('Application description is null or empty');
        } catch (\InvalidArgumentException $e) {
            self::assertStringContainsString('Application description cannot be null or empty', $e->getMessage());
        }

        $builder->setDescription($data['description']);

        try {
            new AppDetail($builder);
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

        try {
            new AppDetail($builder);
            self::fail('Application category is null');
        } catch (\InvalidArgumentException $e) {
            self::assertStringContainsString('Application category cannot be null', $e->getMessage());
        }

        $category = new Category($data['categoryId'], $data['categoryName']);
        $builder->setCategory($category);

        $appDetail = new AppDetail($builder);
        self::assertNull($appDetail->getDeveloper()->getDescription());
        self::assertSame($appDetail->getId(), $data['appId']);
        self::assertSame($appDetail->getLocale(), $data['locale']);
        self::assertSame($appDetail->getDescription(), $data['description']);
        self::assertSame($appDetail->getScreenshots(), $data['screenshots']);
        self::assertSame($appDetail->getCategory(), $category);
        self::assertSame($appDetail->getCategory()->getId(), $data['categoryId']);
        self::assertSame($appDetail->getCategory()->getName(), $data['categoryName']);
        self::assertFalse($appDetail->getCategory()->isFamilyCategory());

        self::assertNull($appDetail->getTranslatedFromLocale());
        self::assertNull($appDetail->getCover());
        self::assertNull($appDetail->getPrivacyPoliceUrl());
        self::assertNull($appDetail->getCategoryFamily());
        self::assertNull($appDetail->getVideo());
        self::assertNull($appDetail->getRecentChanges());
        self::assertFalse($appDetail->isEditorsChoice());
        self::assertSame($appDetail->getInstalls(), 0);
        self::assertSame($appDetail->getNumberVoters(), 0);
        self::assertEquals(
            $appDetail->getHistogramRating(),
            new HistogramRating(0, 0, 0, 0, 0)
        );
        self::assertSame($appDetail->getPrice(), 0.0);
        self::assertSame($appDetail->getCurrency(), 'USD');
        self::assertNull($appDetail->getOffersIAPCost());
        self::assertFalse($appDetail->isContainsIAP());
        self::assertFalse($appDetail->isContainsAds());
        self::assertNull($appDetail->getSize());
        self::assertNull($appDetail->getAppVersion());
        self::assertNull($appDetail->getAndroidVersion());
        self::assertNull($appDetail->getMinAndroidVersion());
        self::assertNull($appDetail->getContentRating());
        self::assertNull($appDetail->getReleased());
        self::assertNull($appDetail->getUpdated());
        self::assertSame($appDetail->getNumberReviews(), 0);
        self::assertIsArray($appDetail->getReviews());
        self::assertEmpty($appDetail->getReviews());

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

        $appDetail = new AppDetail($builder);

        self::assertSame($appDetail->getDeveloper(), $developer);
        self::assertSame($appDetail->getDeveloper()->getEmail(), $data['developerEmail']);
        self::assertSame($appDetail->getDeveloper()->getAddress(), $data['developerAddress']);
        self::assertSame($appDetail->getDeveloper()->getWebsite(), $data['developerSite']);
        self::assertNull($appDetail->getDeveloper()->getDescription());
        self::assertNull($appDetail->getDeveloper()->getCover());
        self::assertNull($appDetail->getDeveloper()->getIcon());

        self::assertSame($appDetail->getTranslatedFromLocale(), $data['translatedFromLocale']);
        self::assertSame($appDetail->getCover(), $data['cover']);
        self::assertSame($appDetail->getPrivacyPoliceUrl(), $data['privacyPoliceUrl']);
        self::assertSame($appDetail->getCategoryFamily(), $categoryFamily);
        self::assertSame($appDetail->getCategoryFamily()->getId(), $data['categoryFamilyId']);
        self::assertSame($appDetail->getCategoryFamily()->getName(), $data['categoryFamilyName']);
        self::assertTrue($appDetail->getCategoryFamily()->isFamilyCategory());
        self::assertSame($appDetail->getVideo(), $video);
        self::assertSame($appDetail->getVideo()->getImageUrl(), $data['videoThumbUrl']);
        self::assertSame($appDetail->getVideo()->getVideoUrl(), $data['videoUrl']);
        self::assertSame($appDetail->getVideo()->getYoutubeId(), $data['youtubeId']);
        self::assertSame($appDetail->getRecentChanges(), $data['recentChanges']);
        self::assertSame($appDetail->isEditorsChoice(), $data['editorChoice']);
        self::assertSame($appDetail->getInstalls(), $data['installs']);
        self::assertSame($appDetail->getNumberVoters(), $data['numberVoters']);
        self::assertSame($appDetail->getHistogramRating(), $data['histogramRating']);
        self::assertSame($appDetail->getPrice(), $data['price']);
        self::assertSame($appDetail->getCurrency(), $data['currency']);
        self::assertSame($appDetail->getPriceText(), $data['priceTextEur']);
        self::assertSame($appDetail->getOffersIAPCost(), $data['offersIAPCost']);
        self::assertTrue($appDetail->isContainsIAP());
        self::assertTrue($appDetail->isContainsAds());
        self::assertSame($appDetail->getSize(), $data['size']);
        self::assertSame($appDetail->getAppVersion(), $data['appVersion']);
        self::assertSame($appDetail->getAndroidVersion(), $data['androidVersion']);
        self::assertSame($appDetail->getMinAndroidVersion(), $data['minAndroidVersion']);
        self::assertSame($appDetail->getContentRating(), $data['contentRating']);
        self::assertSame($appDetail->getReleased(), $data['released']);
        self::assertSame($appDetail->getUpdated(), $data['updated']);
        self::assertSame($appDetail->getNumberReviews(), $data['numberReviews']);
        self::assertSame($appDetail->getReviews(), $data['reviews']);
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

    public function testAppDetailEquals(): void
    {
        $builder = AppDetail::newBuilder()
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

        $appDetail = new AppDetail($builder);
        $appDetail2 = new AppDetail($builder2);
        self::assertEquals($appDetail2, $appDetail);
        self::assertTrue($appDetail->equals($appDetail2));

        $builder2->setIcon(
            new GoogleImage(
                'https://lh3.googleusercontent.com/v0e5DxXFtAlnNzdxgpEd6tcS5r6sKxd1oswufLlQFuqOmMjGAukJXrUN5RtHabg69A=s180'
            )
        );
        $appDetail2 = new AppDetail($builder2);
        self::assertNotEquals($appDetail2, $appDetail);
        self::assertFalse($appDetail->equals($appDetail2));
    }
}
