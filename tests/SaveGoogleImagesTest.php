<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Tests;

use Nelexa\GPlay\Exception\GooglePlayException;
use Nelexa\GPlay\GPlayApps;
use Nelexa\GPlay\Model\GoogleImage;
use Nelexa\GPlay\Model\ImageInfo;
use PHPUnit\Framework\TestCase;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Symfony\Component\Cache\Simple\ArrayCache;

class SaveGoogleImagesTest extends TestCase
{
    /**
     * @var string
     */
    private $destDirectory;
    /**
     * @var GPlayApps
     */
    private $gplay;

    protected function setUp()
    {
        parent::setUp();
        $this->destDirectory = sys_get_temp_dir() . '/gplay-screenshots';
        $cache = new ArrayCache();
        $this->gplay = new GPlayApps();
        $this->gplay->setCache($cache);
    }

    protected function tearDown()
    {
        parent::tearDown();

        $it = new RecursiveDirectoryIterator($this->destDirectory, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
        foreach ($files as $file) {
            if ($file->isDir()) {
                rmdir($file->getRealPath());
            } else {
                unlink($file->getRealPath());
            }
        }
        rmdir($this->destDirectory);
    }

    /**
     * @throws GooglePlayException
     */
    public function testSaveIcon(): void
    {
        $detailApp = $this->gplay->getApp('com.google.android.googlequicksearchbox');
        $icon = $detailApp->getIcon();

        $icon->setSize(128);
        $imageInfo = $icon->saveAs($this->destDirectory . '/icon_small.png');
        $this->assertInstanceOf(ImageInfo::class, $imageInfo);
        $this->assertContains(128, [$imageInfo->getWidth(), $imageInfo->getHeight()]);

        $icon->setSize(256);
        $imageInfo = $icon->saveAs($this->destDirectory . '/icon_medium.png');
        $this->assertInstanceOf(ImageInfo::class, $imageInfo);
        $this->assertContains(256, [$imageInfo->getWidth(), $imageInfo->getHeight()]);

        $icon->setSize(512);
        $imageInfo = $icon->saveAs($this->destDirectory . '/icon_large.png');
        $this->assertInstanceOf(ImageInfo::class, $imageInfo);
        $this->assertContains(512, [$imageInfo->getWidth(), $imageInfo->getHeight()]);
    }

    /**
     * @throws GooglePlayException
     */
    public function testSaveImages(): void
    {
        $detailApp = $this->gplay->getApp('com.rovio.angrybirdsfriends');
        $screenshots = $detailApp->getScreenshots();
        array_walk($screenshots, static function (GoogleImage $image) {
            $image->setSize(512);
        });

        $destDir = $this->destDirectory;

        $imageInfos = $this->gplay->saveGoogleImages(
            $screenshots,
            static function (GoogleImage $image) use ($destDir) {
                $hashUrl = $image->getHashUrl('md5', 2);
                return $destDir . DIRECTORY_SEPARATOR . $hashUrl . '.png';
            }
        );
        $this->assertIsArray($imageInfos);
        $this->assertCount(count($screenshots), $imageInfos);
        $this->assertContainsOnlyInstancesOf(ImageInfo::class, $imageInfos);
    }

    /**
     * @throws GooglePlayException
     */
    public function testImages(): void
    {
        $this->expectException(GooglePlayException::class);
        $this->expectExceptionMessage('404 Not Found');

        $invalidImage = new GoogleImage('https://lh3.googleusercontent.com/DKoidc0T3T1KvYC2stChcX9zwmjKj1pgmg3hXzGBDQXM8RG_7JjgiuS0CLOh8DUa000');
        $invalidImage->saveAs($this->destDirectory . '/images.png');
    }

    public function testSaveInvalidImages(): void
    {
        $this->expectException(GooglePlayException::class);

        $invalidImage = new GoogleImage('https://lh3.googleusercontent.com/DKoidc0T3T1KvYC2stChcX9zwmjKj1pgmg3hXzGBDQXM8RG_7JjgiuS0CLOh8DUa000');
        $invalidImage2 = new GoogleImage('https://lh3.googleusercontent.com/DKoidc0T3T1KvYC2stChcX9zwmjKj1pgmg3hXzGBDQXM8RG_7JjgiuS0CLOh8DUa002');
        $invalidImage3 = new GoogleImage('https://lh3.googleusercontent.com/DKoidc0T3T1KvYC2stChcX9zwmjKj1pgmg3hXzGBDQXM8RG_7JjgiuS0CLOh8DUa003');

        $images = [$invalidImage, $invalidImage2, $invalidImage3];
        array_walk($images, static function (GoogleImage $image) {
            $image->setSize(512);
        });

        $destDir = $this->destDirectory;

        $this->gplay->saveGoogleImages(
            $images,
            static function (GoogleImage $image) use ($destDir) {
                $hashUrl = $image->getHashUrl('crc32');
                return $destDir . DIRECTORY_SEPARATOR . $hashUrl . '.png';
            }
        );
    }
}
