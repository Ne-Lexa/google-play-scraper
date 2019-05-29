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

class AppBuilderTest extends TestCase
{
    /**
     * @dataProvider provideAppBuilderData
     * @param array $data
     */
    public function testAppBuilder(array $data): void
    {
        $builder = App::newBuilder();

        try {
            new App($builder);
            $this->fail('$id is null');
        } catch (\InvalidArgumentException $e) {
            $this->assertStringContainsString('$id', $e->getMessage());
        }

        $builder->setId($data['appId']);
        try {
            new App($builder);
            $this->fail('$url is null');
        } catch (\InvalidArgumentException $e) {
            $this->assertStringContainsString('$url', $e->getMessage());
        }

        $builder->setUrl($data['appUrl']);
        try {
            new App($builder);
            $this->fail('$locale is null');
        } catch (\InvalidArgumentException $e) {
            $this->assertStringContainsString('$locale', $e->getMessage());
        }

        $builder->setLocale($data['locale']);
        try {
            new App($builder);
            $this->fail('$name is null');
        } catch (\InvalidArgumentException $e) {
            $this->assertStringContainsString('$name', $e->getMessage());
        }

        $builder->setName($data['appName']);
        try {
            new App($builder);
            $this->fail('$developer is null');
        } catch (\InvalidArgumentException $e) {
            $this->assertStringContainsString('$developer', $e->getMessage());
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
            $this->fail('$icon is null');
        } catch (\InvalidArgumentException $e) {
            $this->assertStringContainsString('$icon', $e->getMessage());
        }

        $icon = new GoogleImage($data['iconUrl']);
        $builder->setIcon($icon);

        $app = new App($builder);

        $this->assertInstanceOf(App::class, $app);

        $this->assertSame($app->getId(), $data['appId']);
        $this->assertSame($app->getUrl(), $data['appUrl']);
        $this->assertSame($app->getLocale(), $data['locale']);
        $this->assertSame($app->getName(), $data['appName']);

        $this->assertSame($app->getIcon(), $icon);
        $this->assertSame($app->getIcon()->getUrl(), $data['iconUrl']);

        $this->assertSame($app->getDeveloper(), $developer);
        $this->assertSame($app->getDeveloper()->getId(), $data['developerId']);
        $this->assertSame($app->getDeveloper()->getUrl(), $data['developerUrl']);
        $this->assertSame($app->getDeveloper()->getName(), $data['developerName']);

        $this->assertNull($app->getSummary());
        $this->assertSame($app->getScore(), 0.0);
        $this->assertNull($app->getPriceText());
        $this->assertTrue($app->isFree());

        $builder
            ->setSummary($data['summary'])
            ->setScore($data['score'])
            ->setPriceText($data['priceText']);

        $appPaid = new App($builder);
        $this->assertNotEquals($app, $appPaid);

        $this->assertSame($appPaid->getSummary(), $data['summary']);
        $this->assertSame($appPaid->getScore(), $data['score']);
        $this->assertSame($appPaid->getPriceText(), $data['priceText']);
        $this->assertFalse($appPaid->isFree());

        // AppDetail
        try {
            new AppDetail($builder);
            $this->fail('$description is null or empty');
        } catch (\InvalidArgumentException $e) {
            $this->assertStringContainsString('$description', $e->getMessage());
        }

        $builder->setDescription($data['description']);
        try {
            new AppDetail($builder);
            $this->fail('$screenshots are empty');
        } catch (\InvalidArgumentException $e) {
            $this->assertStringContainsString('$screenshots', $e->getMessage());
        }

        foreach ($data['screenshots'] as $screenshot) {
            $builder->addScreenshot($screenshot);
        }

        $this->assertSame($builder->getScreenshots(), $data['screenshots']);
        $builder->setScreenshots([]);
        $this->assertEmpty($builder->getScreenshots());
        $builder->setScreenshots($data['screenshots']);
        $this->assertSame($builder->getScreenshots(), $data['screenshots']);

        try {
            new AppDetail($builder);
            $this->fail('$category is null');
        } catch (\InvalidArgumentException $e) {
            $this->assertStringContainsString('$category', $e->getMessage());
        }

        $category = new Category($data['categoryId'], $data['categoryName']);
        $builder->setCategory($category);

        $appDetail = new AppDetail($builder);
        $this->assertNull($appDetail->getDeveloper()->getDescription());
        $this->assertSame($appDetail->getId(), $data['appId']);
        $this->assertSame($appDetail->getLocale(), $data['locale']);
        $this->assertSame($appDetail->getDescription(), $data['description']);
        $this->assertSame($appDetail->getScreenshots(), $data['screenshots']);
        $this->assertSame($appDetail->getCategory(), $category);
        $this->assertSame($appDetail->getCategory()->getId(), $data['categoryId']);
        $this->assertSame($appDetail->getCategory()->getName(), $data['categoryName']);
        $this->assertFalse($appDetail->getCategory()->isFamilyCategory());

        $this->assertNull($appDetail->getTranslatedDescription());
        $this->assertNull($appDetail->getTranslatedFromLanguage());
        $this->assertNull($appDetail->getHeaderImage());
        $this->assertNull($appDetail->getPrivacyPoliceUrl());
        $this->assertNull($appDetail->getCategoryFamily());
        $this->assertNull($appDetail->getVideo());
        $this->assertNull($appDetail->getRecentChanges());
        $this->assertFalse($appDetail->isEditorsChoice());
        $this->assertSame($appDetail->getInstalls(), 0);
        $this->assertSame($appDetail->getNumberVoters(), 0);
        $this->assertEquals(
            $appDetail->getHistogramRating(),
            new HistogramRating(0, 0, 0, 0, 0)
        );
        $this->assertSame($appDetail->getPrice(), 0.0);
        $this->assertSame($appDetail->getCurrency(), 'USD');
        $this->assertNull($appDetail->getOffersIAPCost());
        $this->assertFalse($appDetail->isOffersIAP());
        $this->assertFalse($appDetail->isAdSupported());
        $this->assertNull($appDetail->getAppSize());
        $this->assertNull($appDetail->getAppVersion());
        $this->assertNull($appDetail->getAndroidVersion());
        $this->assertNull($appDetail->getMinAndroidVersion());
        $this->assertNull($appDetail->getContentRating());
        $this->assertNull($appDetail->getReleased());
        $this->assertNull($appDetail->getUpdated());
        $this->assertSame($appDetail->getReviewsCount(), 0);
        $this->assertIsArray($appDetail->getReviews());
        $this->assertEmpty($appDetail->getReviews());

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
            ->setTranslated($data['translatedDescription'], $data['translatedFromLanguage'])
            ->setHeaderImage($data['headerImage'])
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
            ->setAdSupported($data['adSupported'])
            ->setAppSize($data['appSize'])
            ->setAppVersion($data['appVersion'])
            ->setAndroidVersion($data['androidVersion'])
            ->setMinAndroidVersion($data['minAndroidVersion'])
            ->setContentRating($data['contentRating'])
            ->setReleased($data['released'])
            ->setUpdated($data['updated'])
            ->setReviewsCount($data['reviewsCount'])
            ->setReviews($data['reviews']);

        $appDetail = new AppDetail($builder);

        $this->assertSame($appDetail->getDeveloper(), $developer);
        $this->assertSame($appDetail->getDeveloper()->getEmail(), $data['developerEmail']);
        $this->assertSame($appDetail->getDeveloper()->getAddress(), $data['developerAddress']);
        $this->assertSame($appDetail->getDeveloper()->getWebsite(), $data['developerSite']);
        $this->assertNull($appDetail->getDeveloper()->getDescription());
        $this->assertNull($appDetail->getDeveloper()->getHeaderImage());
        $this->assertNull($appDetail->getDeveloper()->getIcon());

        $this->assertSame($appDetail->getTranslatedDescription(), $data['translatedDescription']);
        $this->assertSame($appDetail->getTranslatedFromLanguage(), $data['translatedFromLanguage']);
        $this->assertSame($appDetail->getHeaderImage(), $data['headerImage']);
        $this->assertSame($appDetail->getPrivacyPoliceUrl(), $data['privacyPoliceUrl']);
        $this->assertSame($appDetail->getCategoryFamily(), $categoryFamily);
        $this->assertSame($appDetail->getCategoryFamily()->getId(), $data['categoryFamilyId']);
        $this->assertSame($appDetail->getCategoryFamily()->getName(), $data['categoryFamilyName']);
        $this->assertTrue($appDetail->getCategoryFamily()->isFamilyCategory());
        $this->assertSame($appDetail->getVideo(), $video);
        $this->assertSame($appDetail->getVideo()->getThumb(), $data['videoThumbUrl']);
        $this->assertSame($appDetail->getVideo()->getUrl(), $data['videoUrl']);
        $this->assertSame($appDetail->getVideo()->getYoutubeId(), $data['youtubeId']);
        $this->assertSame($appDetail->getRecentChanges(), $data['recentChanges']);
        $this->assertSame($appDetail->isEditorsChoice(), $data['editorChoice']);
        $this->assertSame($appDetail->getInstalls(), $data['installs']);
        $this->assertSame($appDetail->getNumberVoters(), $data['numberVoters']);
        $this->assertSame($appDetail->getHistogramRating(), $data['histogramRating']);

        $this->assertSame(
            $appDetail->getHistogramRating()->__toString(),
            "⭐⭐⭐⭐⭐ {$appDetail->getHistogramRating()->getFiveStars()}\n" .
            "⭐⭐⭐⭐  {$appDetail->getHistogramRating()->getFourStars()}\n" .
            "⭐⭐⭐   {$appDetail->getHistogramRating()->getThreeStars()}\n" .
            "⭐⭐    {$appDetail->getHistogramRating()->getTwoStars()}\n" .
            "⭐     {$appDetail->getHistogramRating()->getOneStar()}"
        );

        $this->assertSame($appDetail->getPrice(), $data['price']);
        $this->assertSame($appDetail->getCurrency(), $data['currency']);
        $this->assertSame($appDetail->getPriceText(), $data['priceTextEur']);
        $this->assertSame($appDetail->getOffersIAPCost(), $data['offersIAPCost']);
        $this->assertTrue($appDetail->isOffersIAP());
        $this->assertTrue($appDetail->isAdSupported());
        $this->assertSame($appDetail->getAppSize(), $data['appSize']);
        $this->assertSame($appDetail->getAppVersion(), $data['appVersion']);
        $this->assertSame($appDetail->getAndroidVersion(), $data['androidVersion']);
        $this->assertSame($appDetail->getMinAndroidVersion(), $data['minAndroidVersion']);
        $this->assertSame($appDetail->getContentRating(), $data['contentRating']);
        $this->assertSame($appDetail->getReleased(), $data['released']);
        $this->assertSame($appDetail->getUpdated(), $data['updated']);
        $this->assertSame($appDetail->getReviewsCount(), $data['reviewsCount']);
        $this->assertSame($appDetail->getReviews(), $data['reviews']);
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function provideAppBuilderData(): array
    {
        return [
            [
                [
                    'appId' => 'com.test',
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
                    'locale' => 'en_US',
                    'description' => 'Description du test',
                    'screenshots' => [
                        new GoogleImage('https://lh3.ggpht.com/ueLFEoDXfL5ng9SeWLqstSw4GLAXyLgDSym5JKykOHpv_s0sm2HHHI_d2dAC_ugDyw=w720-h310'),
                        new GoogleImage('https://lh3.ggpht.com/bhb0uFArLTzGg515ayV_eOYNlgtmDkwQjhTmQIfK1r_U0nS7fOp2Xfz6dpLGQCUcPOHt=w720-h310'),
                        new GoogleImage('https://lh3.ggpht.com/pHNFX1g4E3QTnytKFOry-8rbaOMR9P8nT4IiuBZVYMHjfJLOYFsKSGvvTr_92SXafzU=w720-h310'),
                    ],
                    'categoryId' => 'EVENTS',
                    'categoryName' => 'Events',
                    'released' => new \DateTimeImmutable(
                        '-33 months',
                        new \DateTimeZone('UTC')
                    ),
                    'translatedDescription' => 'Test description',
                    'translatedFromLanguage' => 'fr_FR',
                    'headerImage' => new GoogleImage('https://lh3.googleusercontent.com/_X0MDs89e-vT-xHIfPWnx3ws1brEhC8v1cx3cuwubc9EYDIav3h2ickpUJJfWm1UBqg'),
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
                    'adSupported' => true,
                    'appSize' => '7.4M',
                    'appVersion' => '1.0.2',
                    'androidVersion' => '4.1 and up',
                    'minAndroidVersion' => '4.1',
                    'contentRating' => 'PEGI 3',
                    'updated' => new \DateTimeImmutable(
                        '-3 days 30 min',
                        new \DateTimeZone('UTC')
                    ),
                    'reviewsCount' => 15266,
                    'reviews' => [
                        new Review(
                            'gp:XXXXXXXXXXX',
                            'https://play.google.com/store/apps/details?id=com.test&hl=en_US&reviewId=gp:XXXXXXXXXXX',
                            'Google User',
                            'The best app!',
                            new GoogleImage('https://lh5.googleusercontent.com/-hGyaot6je8A/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rcSBa3olHGF7huPpQN97OQA01cmTQ/w200/avatar.jpg'),
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
                            new GoogleImage('https://lh4.googleusercontent.com/-l2Ebb1iCsto/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rd_fPyE4q23MdG95wvDs4_XJ27z6g/'),
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
            ->setUrl('https://play.google.com/store/apps/details?id=com.test')
            ->setName('test')
            ->setLocale('en_US')
            ->setDeveloper(new Developer(
                Developer::newBuilder()
                    ->setId('010101101010')
                    ->setName('developer test')
                    ->setUrl('https://example.com/')
            ))
            ->setIcon(new GoogleImage('https://lh3.googleusercontent.com/DKoidc0T3T1KvYC2stChcX9zwmjKj1pgmg3hXzGBDQXM8RG_7JjgiuS0CLOh8DUa7as=s180'))
            ->setDescription('test description')
            ->addScreenshot(new GoogleImage('https://lh3.googleusercontent.com/1Ec6E-6nPcTn6OYzH9_P8sKupUsfJhbUd8M-iEOkzimaMr9CALI-KUpT2UyxHQUOPSY=w720-h310'))
            ->setCategory(new Category(
                'TEST',
                'Test Category'
            ));

        $builder2 = clone $builder;

        $appDetail = new AppDetail($builder);
        $appDetail2 = new AppDetail($builder2);
        $this->assertEquals($appDetail2, $appDetail);
        $this->assertTrue($appDetail->equals($appDetail2));

        $builder2->setIcon(new GoogleImage('https://lh3.googleusercontent.com/v0e5DxXFtAlnNzdxgpEd6tcS5r6sKxd1oswufLlQFuqOmMjGAukJXrUN5RtHabg69A=s180'));
        $appDetail2 = new AppDetail($builder2);
        $this->assertNotEquals($appDetail2, $appDetail);
        $this->assertFalse($appDetail->equals($appDetail2));
    }
}
