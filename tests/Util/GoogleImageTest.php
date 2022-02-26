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

namespace Nelexa\GPlay\Tests\Util;

use Nelexa\GPlay\Model\GoogleImage;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @small
 */
final class GoogleImageTest extends TestCase
{
    /**
     * @dataProvider provideImages
     *
     * @param string $url
     * @param string $actualUrl
     * @param string $actualBestSizeUrl
     */
    public function testParseUrlImage(string $url, string $actualUrl, string $actualBestSizeUrl): void
    {
        $this->markAsRisky();

        $googleImage = new GoogleImage($url);
        $url = $googleImage->getUrl();
        $bestSizeUrl = $googleImage->getOriginalSizeUrl();

        self::assertSame($url, $actualUrl);
        self::assertSame($bestSizeUrl, $actualBestSizeUrl);
    }

    /**
     * @return array
     */
    public function provideImages(): array
    {
        return [
            [
                'https://lh3.googleusercontent.com/GbJNOZ-E87H68Tq6Q_G4uqABQRKnA1zJqU1C5LTP8hUhCKq3BomtfntBnIJF2YhRrQ',
                'https://lh3.googleusercontent.com/GbJNOZ-E87H68Tq6Q_G4uqABQRKnA1zJqU1C5LTP8hUhCKq3BomtfntBnIJF2YhRrQ',
                'https://lh3.googleusercontent.com/GbJNOZ-E87H68Tq6Q_G4uqABQRKnA1zJqU1C5LTP8hUhCKq3BomtfntBnIJF2YhRrQ=s0',
            ],
            [
                'https://lh3.googleusercontent.com/GbJNOZ-E87H68Tq6Q_G4uqABQRKnA1zJqU1C5LTP8hUhCKq3BomtfntBnIJF2YhRrQ=s0-k-no',
                'https://lh3.googleusercontent.com/GbJNOZ-E87H68Tq6Q_G4uqABQRKnA1zJqU1C5LTP8hUhCKq3BomtfntBnIJF2YhRrQ=s0',
                'https://lh3.googleusercontent.com/GbJNOZ-E87H68Tq6Q_G4uqABQRKnA1zJqU1C5LTP8hUhCKq3BomtfntBnIJF2YhRrQ=s0',
            ],
            [
                'https://lh3.googleusercontent.com/HANcKpgwKaXt380ZJKK8_YpZlGn0NcjY5os1GOJmRHQjn9x9iCz9C-_lZRUkgTHYOChGMcMuuw=w200-h300',
                'https://lh3.googleusercontent.com/HANcKpgwKaXt380ZJKK8_YpZlGn0NcjY5os1GOJmRHQjn9x9iCz9C-_lZRUkgTHYOChGMcMuuw=w200-h300',
                'https://lh3.googleusercontent.com/HANcKpgwKaXt380ZJKK8_YpZlGn0NcjY5os1GOJmRHQjn9x9iCz9C-_lZRUkgTHYOChGMcMuuw=s0',
            ],

            [
                'https://lh3.googleusercontent.com/-LB59qNIqtS4/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rf3YR_W16kFTuh5tCgHpZ02_ndQOg/',
                'https://lh3.googleusercontent.com/-LB59qNIqtS4/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rf3YR_W16kFTuh5tCgHpZ02_ndQOg/',
                'https://lh3.googleusercontent.com/-LB59qNIqtS4/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rf3YR_W16kFTuh5tCgHpZ02_ndQOg/s0/',
            ],
            [
                'https://lh3.googleusercontent.com/-LB59qNIqtS4/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rf3YR_W16kFTuh5tCgHpZ02_ndQOg/w40/',
                'https://lh3.googleusercontent.com/-LB59qNIqtS4/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rf3YR_W16kFTuh5tCgHpZ02_ndQOg/w40/',
                'https://lh3.googleusercontent.com/-LB59qNIqtS4/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rf3YR_W16kFTuh5tCgHpZ02_ndQOg/s0/',
            ],
            [
                'https://lh3.googleusercontent.com/-LB59qNIqtS4/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rf3YR_W16kFTuh5tCgHpZ02_ndQOg/photo.jpg',
                'https://lh3.googleusercontent.com/-LB59qNIqtS4/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rf3YR_W16kFTuh5tCgHpZ02_ndQOg/',
                'https://lh3.googleusercontent.com/-LB59qNIqtS4/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rf3YR_W16kFTuh5tCgHpZ02_ndQOg/s0/',
            ],
            [
                'https://lh3.googleusercontent.com/-LB59qNIqtS4/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rf3YR_W16kFTuh5tCgHpZ02_ndQOg/s100-no/photo.jpg',
                'https://lh3.googleusercontent.com/-LB59qNIqtS4/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rf3YR_W16kFTuh5tCgHpZ02_ndQOg/s100/',
                'https://lh3.googleusercontent.com/-LB59qNIqtS4/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rf3YR_W16kFTuh5tCgHpZ02_ndQOg/s0/',
            ],

            [
                'https://lh3.googleusercontent.com/-khz-7NpZXic/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3reKXLHM7Pk6A7iXGRNBP8HxB0Xs1Q/w48-h48-n-mo/photo.jpg',
                'https://lh3.googleusercontent.com/-khz-7NpZXic/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3reKXLHM7Pk6A7iXGRNBP8HxB0Xs1Q/w48-h48/',
                'https://lh3.googleusercontent.com/-khz-7NpZXic/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3reKXLHM7Pk6A7iXGRNBP8HxB0Xs1Q/s0/',
            ],

            [
                'https://lh3.googleusercontent.com/FStqaBaXK7pteZ4jX5poKc0c-Ed2tqKcv2NyTAP7MwuH=k-no',
                'https://lh3.googleusercontent.com/FStqaBaXK7pteZ4jX5poKc0c-Ed2tqKcv2NyTAP7MwuH',
                'https://lh3.googleusercontent.com/FStqaBaXK7pteZ4jX5poKc0c-Ed2tqKcv2NyTAP7MwuH=s0',
            ],
            [
                'https://lh3.googleusercontent.com/FStqaBaXK7pteZ4jX5poKc0c-Ed2tqKcv2NyTAP7MwuH=s0-b30-fv',
                'https://lh3.googleusercontent.com/FStqaBaXK7pteZ4jX5poKc0c-Ed2tqKcv2NyTAP7MwuH=s0-b30-fv',
                'https://lh3.googleusercontent.com/FStqaBaXK7pteZ4jX5poKc0c-Ed2tqKcv2NyTAP7MwuH=s0',
            ],
            [
                'https://lh3.googleusercontent.com/FStqaBaXK7pteZ4jX5poKc0c-Ed2tqKcv2NyTAP7MwuH=s0-b30-fh',
                'https://lh3.googleusercontent.com/FStqaBaXK7pteZ4jX5poKc0c-Ed2tqKcv2NyTAP7MwuH=s0-b30-fh',
                'https://lh3.googleusercontent.com/FStqaBaXK7pteZ4jX5poKc0c-Ed2tqKcv2NyTAP7MwuH=s0',
            ],
            [
                'https://lh3.googleusercontent.com/FStqaBaXK7pteZ4jX5poKc0c-Ed2tqKcv2NyTAP7MwuH=s100-k-d-no',
                'https://lh3.googleusercontent.com/FStqaBaXK7pteZ4jX5poKc0c-Ed2tqKcv2NyTAP7MwuH=s100',
                'https://lh3.googleusercontent.com/FStqaBaXK7pteZ4jX5poKc0c-Ed2tqKcv2NyTAP7MwuH=s0',
            ],
            [
                'https://lh3.googleusercontent.com/FStqaBaXK7pteZ4jX5poKc0c-Ed2tqKcv2NyTAP7MwuH=w100-c',
                'https://lh3.googleusercontent.com/FStqaBaXK7pteZ4jX5poKc0c-Ed2tqKcv2NyTAP7MwuH=w100-c',
                'https://lh3.googleusercontent.com/FStqaBaXK7pteZ4jX5poKc0c-Ed2tqKcv2NyTAP7MwuH=s0',
            ],

            [
                'https://lh3.googleusercontent.com/proxy/3cI6bAx1WWTsIL5iPDRiPPknXImSb8xJtNuEUKGgXg8hWaGTY48kqGOdpOkLQJG1BGj3N6Y1Dc-6qvdfHoIdtk2PcwByKzpu3PkrsFIOXe-ePM9r9jPRL1lg9A=w720-h405',
                'https://lh3.googleusercontent.com/proxy/3cI6bAx1WWTsIL5iPDRiPPknXImSb8xJtNuEUKGgXg8hWaGTY48kqGOdpOkLQJG1BGj3N6Y1Dc-6qvdfHoIdtk2PcwByKzpu3PkrsFIOXe-ePM9r9jPRL1lg9A=w720-h405',
                'https://lh3.googleusercontent.com/proxy/3cI6bAx1WWTsIL5iPDRiPPknXImSb8xJtNuEUKGgXg8hWaGTY48kqGOdpOkLQJG1BGj3N6Y1Dc-6qvdfHoIdtk2PcwByKzpu3PkrsFIOXe-ePM9r9jPRL1lg9A=s0',
            ],

            [
                'https://lh3.ggpht.com/EGemoI2NTXmTsBVtJqk8jxF9rh8ApRWfsIMQSt2uE4OcpQqbFu7f7NbTK05lx80nuSijCz7sc3a277R67g',
                'https://lh3.ggpht.com/EGemoI2NTXmTsBVtJqk8jxF9rh8ApRWfsIMQSt2uE4OcpQqbFu7f7NbTK05lx80nuSijCz7sc3a277R67g',
                'https://lh3.ggpht.com/EGemoI2NTXmTsBVtJqk8jxF9rh8ApRWfsIMQSt2uE4OcpQqbFu7f7NbTK05lx80nuSijCz7sc3a277R67g=s0',
            ],

            [
                'https://lh3.googleusercontent.com/a-/AAuE7mAndrvGgUUJNSkl3mPSa-y-XcUJch1aKZDzCD2S=w0',
                'https://lh3.googleusercontent.com/a-/AAuE7mAndrvGgUUJNSkl3mPSa-y-XcUJch1aKZDzCD2S=w0',
                'https://lh3.googleusercontent.com/a-/AAuE7mAndrvGgUUJNSkl3mPSa-y-XcUJch1aKZDzCD2S=s0',
            ],

            [
                'https://1.bp.blogspot.com/-gZoPZt6mOLQ/XMa2QFgXs6I/AAAAAAAACGs/wqldyhxSPX4PcttYLT1SB32O8-mbe5q7QCEwYBhgL/w100/top%2B40%2Bbest%2Btravel%2Bquotes.png',
                'https://1.bp.blogspot.com/-gZoPZt6mOLQ/XMa2QFgXs6I/AAAAAAAACGs/wqldyhxSPX4PcttYLT1SB32O8-mbe5q7QCEwYBhgL/w100/',
                'https://1.bp.blogspot.com/-gZoPZt6mOLQ/XMa2QFgXs6I/AAAAAAAACGs/wqldyhxSPX4PcttYLT1SB32O8-mbe5q7QCEwYBhgL/s0/',
            ],
        ];
    }

    public function testSettersAndGetters(): void
    {
        $baseUrl = 'https://lh3.googleusercontent.com/lwNbmbYSbFOQmVVVlMRHow9rpIcgAMnqfXRTQ6NUfvjJb6ZSXn_a7vouRuc7avmArmA';
        $imageUrl = $baseUrl . '=w515-h290';

        $googleImage = new GoogleImage($imageUrl);
        self::assertSame($googleImage->getUrl(), $baseUrl . '=w515-h290');

        self::assertNull($googleImage->getSize());
        self::assertSame($googleImage->getWidth(), 515);
        self::assertSame($googleImage->getHeight(), 290);
        self::assertNull($googleImage->getBorder());
        self::assertFalse($googleImage->isSmartCrop());
        self::assertFalse($googleImage->isSquareCrop());
        self::assertFalse($googleImage->isVerticalFlip());
        self::assertFalse($googleImage->isHorizontalFlip());
        self::assertSame($googleImage->getUrl(), $baseUrl . '=w515-h290');

        $googleImage->setSize(300);
        self::assertSame($googleImage->getSize(), 300);
        self::assertNull($googleImage->getWidth());
        self::assertNull($googleImage->getHeight());
        self::assertNull($googleImage->getBorder());
        self::assertFalse($googleImage->isSmartCrop());
        self::assertFalse($googleImage->isSquareCrop());
        self::assertFalse($googleImage->isVerticalFlip());
        self::assertFalse($googleImage->isHorizontalFlip());
        self::assertSame($googleImage->getUrl(), $baseUrl . '=s300');

        $googleImage->useOriginalSize();
        self::assertSame($googleImage->getSize(), 0);
        self::assertNull($googleImage->getWidth());
        self::assertNull($googleImage->getHeight());
        self::assertNull($googleImage->getBorder());
        self::assertFalse($googleImage->isSmartCrop());
        self::assertFalse($googleImage->isSquareCrop());
        self::assertFalse($googleImage->isVerticalFlip());
        self::assertFalse($googleImage->isHorizontalFlip());
        self::assertSame($googleImage->getUrl(), $baseUrl . '=s0');

        $googleImage->setWidth(500);
        self::assertNull($googleImage->getSize());
        self::assertSame($googleImage->getWidth(), 500);
        self::assertNull($googleImage->getHeight());
        self::assertNull($googleImage->getBorder());
        self::assertFalse($googleImage->isSmartCrop());
        self::assertFalse($googleImage->isSquareCrop());
        self::assertFalse($googleImage->isVerticalFlip());
        self::assertFalse($googleImage->isHorizontalFlip());
        self::assertSame($googleImage->getUrl(), $baseUrl . '=w500');

        $googleImage->setHeight(400);
        self::assertNull($googleImage->getSize());
        self::assertSame($googleImage->getWidth(), 500);
        self::assertSame($googleImage->getHeight(), 400);
        self::assertNull($googleImage->getBorder());
        self::assertFalse($googleImage->isSmartCrop());
        self::assertFalse($googleImage->isSquareCrop());
        self::assertFalse($googleImage->isVerticalFlip());
        self::assertFalse($googleImage->isHorizontalFlip());
        self::assertSame($googleImage->getUrl(), $baseUrl . '=w500-h400');

        $googleImage->setBorder(10);
        self::assertNull($googleImage->getSize());
        self::assertSame($googleImage->getWidth(), 500);
        self::assertSame($googleImage->getHeight(), 400);
        self::assertSame($googleImage->getBorder(), 10);
        self::assertFalse($googleImage->isSmartCrop());
        self::assertFalse($googleImage->isSquareCrop());
        self::assertFalse($googleImage->isVerticalFlip());
        self::assertFalse($googleImage->isHorizontalFlip());
        self::assertSame($googleImage->getUrl(), $baseUrl . '=w500-h400-b10');

        $googleImage->setSmartCrop(true);
        self::assertNull($googleImage->getSize());
        self::assertSame($googleImage->getWidth(), 500);
        self::assertSame($googleImage->getHeight(), 400);
        self::assertSame($googleImage->getBorder(), 10);
        self::assertTrue($googleImage->isSmartCrop());
        self::assertFalse($googleImage->isSquareCrop());
        self::assertFalse($googleImage->isVerticalFlip());
        self::assertFalse($googleImage->isHorizontalFlip());
        self::assertSame($googleImage->getUrl(), $baseUrl . '=w500-h400-p-b10');

        $googleImage->setSquareCrop(true);
        self::assertNull($googleImage->getSize());
        self::assertSame($googleImage->getWidth(), 500);
        self::assertSame($googleImage->getHeight(), 400);
        self::assertSame($googleImage->getBorder(), 10);
        self::assertFalse($googleImage->isSmartCrop());
        self::assertTrue($googleImage->isSquareCrop());
        self::assertFalse($googleImage->isVerticalFlip());
        self::assertFalse($googleImage->isHorizontalFlip());
        self::assertSame($googleImage->getUrl(), $baseUrl . '=w500-h400-c-b10');

        $googleImage->setVerticalFlip(true);
        self::assertNull($googleImage->getSize());
        self::assertSame($googleImage->getWidth(), 500);
        self::assertSame($googleImage->getHeight(), 400);
        self::assertSame($googleImage->getBorder(), 10);
        self::assertFalse($googleImage->isSmartCrop());
        self::assertTrue($googleImage->isSquareCrop());
        self::assertTrue($googleImage->isVerticalFlip());
        self::assertFalse($googleImage->isHorizontalFlip());
        self::assertSame($googleImage->getUrl(), $baseUrl . '=w500-h400-c-b10-fv');

        $googleImage->setHorizontalFlip(true);
        self::assertNull($googleImage->getSize());
        self::assertSame($googleImage->getWidth(), 500);
        self::assertSame($googleImage->getHeight(), 400);
        self::assertSame($googleImage->getBorder(), 10);
        self::assertFalse($googleImage->isSmartCrop());
        self::assertTrue($googleImage->isSquareCrop());
        self::assertTrue($googleImage->isVerticalFlip());
        self::assertTrue($googleImage->isHorizontalFlip());
        self::assertSame($googleImage->getUrl(), $baseUrl . '=w500-h400-c-b10-fv-fh');

        $googleImage->setSize(300);
        self::assertSame($googleImage->getSize(), 300);
        self::assertNull($googleImage->getWidth());
        self::assertNull($googleImage->getHeight());
        self::assertSame($googleImage->getBorder(), 10);
        self::assertFalse($googleImage->isSmartCrop());
        self::assertTrue($googleImage->isSquareCrop());
        self::assertTrue($googleImage->isVerticalFlip());
        self::assertTrue($googleImage->isHorizontalFlip());
        self::assertSame($googleImage->getUrl(), $baseUrl . '=s300-c-b10-fv-fh');

        $googleImage->setHeight(600);
        self::assertNull($googleImage->getSize());
        self::assertNull($googleImage->getWidth());
        self::assertSame($googleImage->getHeight(), 600);
        self::assertSame($googleImage->getBorder(), 10);
        self::assertFalse($googleImage->isSmartCrop());
        self::assertTrue($googleImage->isSquareCrop());
        self::assertTrue($googleImage->isVerticalFlip());
        self::assertTrue($googleImage->isHorizontalFlip());
        self::assertSame($googleImage->getUrl(), $baseUrl . '=h600-c-b10-fv-fh');

        $googleImage->setSmartCrop(true);
        self::assertNull($googleImage->getSize());
        self::assertNull($googleImage->getWidth());
        self::assertSame($googleImage->getHeight(), 600);
        self::assertSame($googleImage->getBorder(), 10);
        self::assertTrue($googleImage->isSmartCrop());
        self::assertFalse($googleImage->isSquareCrop());
        self::assertTrue($googleImage->isVerticalFlip());
        self::assertTrue($googleImage->isHorizontalFlip());
        self::assertSame($googleImage->getUrl(), $baseUrl . '=h600-b10-fv-fh');

        $googleImage->setWidth(300);
        self::assertNull($googleImage->getSize());
        self::assertSame($googleImage->getWidth(), 300);
        self::assertSame($googleImage->getHeight(), 600);
        self::assertSame($googleImage->getBorder(), 10);
        self::assertTrue($googleImage->isSmartCrop());
        self::assertFalse($googleImage->isSquareCrop());
        self::assertTrue($googleImage->isVerticalFlip());
        self::assertTrue($googleImage->isHorizontalFlip());
        self::assertSame($googleImage->getUrl(), $baseUrl . '=w300-h600-p-b10-fv-fh');

        // test toString()
        self::assertEquals($googleImage, $baseUrl . '=w300-h600-p-b10-fv-fh');
        self::assertEquals($googleImage, $googleImage->__toString());
        self::assertEquals($googleImage, $googleImage->getUrl());

        // reset
        $googleImage->reset();
        self::assertNull($googleImage->getSize());
        self::assertNull($googleImage->getWidth());
        self::assertNull($googleImage->getHeight());
        self::assertNull($googleImage->getBorder());
        self::assertFalse($googleImage->isSmartCrop());
        self::assertFalse($googleImage->isSquareCrop());
        self::assertFalse($googleImage->isVerticalFlip());
        self::assertFalse($googleImage->isHorizontalFlip());
        self::assertSame($googleImage->getUrl(), $baseUrl);
    }

    public function testSize(): void
    {
        $this->markAsRisky();

        $imageUrl = 'https://lh3.googleusercontent.com/lwNbmbYSbFOQmVVVlMRHow9rpIcgAMnqfXRTQ6NUfvjJb6ZSXn_a7vouRuc7avmArmA';

        $size = 300;
        $googleImage = new GoogleImage($imageUrl . '=w2247-h1264-p', false);
        $googleImage->setSize($size);
        $url = $googleImage->getUrl();

        self::assertSame($url, $imageUrl . '=s' . $size);

        $imageInfo = getimagesize($url);
        self::assertNotFalse($imageInfo);

        self::assertContains($size, [$imageInfo[0], $imageInfo[1]]);
    }

    public function testSizeSmartCrop(): void
    {
        $this->markAsRisky();

        $imageUrl = 'https://lh3.googleusercontent.com/lwNbmbYSbFOQmVVVlMRHow9rpIcgAMnqfXRTQ6NUfvjJb6ZSXn_a7vouRuc7avmArmA';

        $size = 300;
        $googleImage = new GoogleImage($imageUrl . '=w2247-h1264', false);
        $url = $googleImage
            ->setSize($size)
            ->setSmartCrop(true)
            ->getUrl()
        ;

        self::assertSame($url, $imageUrl . '=s' . $size . '-p');

        $imageInfo = getimagesize($url);
        self::assertNotFalse($imageInfo, 'Error fetch image to ' . $url);

        self::assertSame($imageInfo[0], $size);
        self::assertSame($imageInfo[1], $size);
    }

    public function testSizeSquareCrop(): void
    {
        $this->markAsRisky();

        $imageUrl = 'https://lh3.googleusercontent.com/lwNbmbYSbFOQmVVVlMRHow9rpIcgAMnqfXRTQ6NUfvjJb6ZSXn_a7vouRuc7avmArmA';

        $size = 300;
        $googleImage = new GoogleImage($imageUrl . '=w2247-h1264', false);
        $url = $googleImage
            ->setSize($size)
            ->setSquareCrop(true)
            ->getUrl()
        ;

        self::assertSame($url, $imageUrl . '=s' . $size . '-c');

        $imageInfo = getimagesize($url);
        self::assertNotFalse($imageInfo, 'Error fetch image to ' . $url);

        self::assertSame($imageInfo[0], $size);
        self::assertSame($imageInfo[1], $size);
    }

    public function testWidth(): void
    {
        $this->markAsRisky();

        $imageUrl = 'https://lh3.googleusercontent.com/lwNbmbYSbFOQmVVVlMRHow9rpIcgAMnqfXRTQ6NUfvjJb6ZSXn_a7vouRuc7avmArmA';

        $size = 300;
        $googleImage = new GoogleImage($imageUrl . '=w2247-h1264', false);
        $url = $googleImage
            ->setWidth($size)
            ->getUrl()
        ;

        self::assertSame($url, $imageUrl . '=w' . $size);

        $imageInfo = getimagesize($url);
        self::assertNotFalse($imageInfo, 'Error fetch image to ' . $url);

        self::assertSame($imageInfo[0], $size);
        self::assertNotSame($imageInfo[1], $size);
    }

    public function testWidthSquareCrop(): void
    {
        $this->markAsRisky();

        $imageUrl = 'https://lh3.googleusercontent.com/lwNbmbYSbFOQmVVVlMRHow9rpIcgAMnqfXRTQ6NUfvjJb6ZSXn_a7vouRuc7avmArmA';

        $size = 300;
        $googleImage = new GoogleImage($imageUrl . '=w2247-h1264', false);
        $url = $googleImage
            ->setWidth($size)
            ->setSquareCrop(true)
            ->getUrl()
        ;

        self::assertSame($url, $imageUrl . '=w' . $size . '-c');

        $imageInfo = getimagesize($url);
        self::assertNotFalse($imageInfo, 'Error fetch image to ' . $url);

        self::assertSame($imageInfo[0], $size);
        self::assertSame($imageInfo[1], $size);
    }

    public function testHeight(): void
    {
        $this->markAsRisky();

        $imageUrl = 'https://lh3.googleusercontent.com/lwNbmbYSbFOQmVVVlMRHow9rpIcgAMnqfXRTQ6NUfvjJb6ZSXn_a7vouRuc7avmArmA';

        $size = 300;
        $googleImage = new GoogleImage($imageUrl . '=w2247-h1264', false);
        $url = $googleImage
            ->setHeight($size)
            ->getUrl()
        ;

        self::assertSame($url, $imageUrl . '=h' . $size);

        $imageInfo = getimagesize($url);
        self::assertNotFalse($imageInfo, 'Error fetch image to ' . $url);

        self::assertNotSame($imageInfo[0], $size);
        self::assertSame($imageInfo[1], $size);
    }

    public function testHeightSquareCrop(): void
    {
        $this->markAsRisky();

        $imageUrl = 'https://lh3.googleusercontent.com/lwNbmbYSbFOQmVVVlMRHow9rpIcgAMnqfXRTQ6NUfvjJb6ZSXn_a7vouRuc7avmArmA';

        $size = 300;
        $googleImage = new GoogleImage($imageUrl . '=w2247-h1264', false);
        $url = $googleImage
            ->setHeight($size)
            ->setSquareCrop(true)
            ->getUrl()
        ;

        self::assertSame($url, $imageUrl . '=h' . $size . '-c');

        $imageInfo = getimagesize($url);
        self::assertNotFalse($imageInfo, 'Error fetch image to ' . $url);

        self::assertSame($imageInfo[0], $size);
        self::assertSame($imageInfo[1], $size);
    }

    public function testWidthHeight(): void
    {
        $this->markAsRisky();

        $imageUrl = 'https://lh3.googleusercontent.com/lwNbmbYSbFOQmVVVlMRHow9rpIcgAMnqfXRTQ6NUfvjJb6ZSXn_a7vouRuc7avmArmA';

        $width = 300;
        $height = 333;
        $googleImage = new GoogleImage($imageUrl . '=w2247-h1264', false);
        $url = $googleImage
            ->setWidth($width)
            ->setHeight($height)
            ->getUrl()
        ;

        self::assertSame($url, $imageUrl . '=w' . $width . '-h' . $height);

        $imageInfo = getimagesize($url);
        self::assertNotFalse($imageInfo, 'Error fetch image to ' . $url);

        if ($imageInfo[0] === $width) {
            self::assertNotSame($imageInfo[1], $height);
        } elseif ($imageInfo[1] === $height) {
            self::assertNotSame($imageInfo[0], $width);
        } else {
            self::fail(
                'Error image ' . $url . '. Expected ' . $width . 'x' . $height . '. Actual: ' . $imageInfo[0] . 'x' . $imageInfo[1]
            );
        }
    }

    public function testWidthHeightSmartCrop(): void
    {
        $this->markAsRisky();

        $imageUrl = 'https://lh3.googleusercontent.com/nYhPnY2I-e9rpqnid9u9aAODz4C04OycEGxqHG5vxFnA35OGmLMrrUmhM9eaHKJ7liB-';

        $width = 240;
        $height = 320;
        $googleImage = new GoogleImage($imageUrl . '=s180', false);
        $url = $googleImage
            ->setWidth($width)
            ->setHeight($height)
            ->setSmartCrop(true)
            ->getUrl()
        ;

        self::assertSame($url, $imageUrl . '=w' . $width . '-h' . $height . '-p');

        $imageInfo = getimagesize($url);
        self::assertNotFalse($imageInfo, 'Error fetch image to ' . $url);

        self::assertSame($imageInfo[0], $width);
        self::assertSame($imageInfo[1], $height);
    }

    public function testWidthHeightSquareCrop(): void
    {
        $this->markAsRisky();

        $imageUrl = 'https://lh3.googleusercontent.com/6EtT4dght1QF9-XYvSiwx2uqkBiOnrwq-N-dPZLUw4x61Bh2Bp_w6BZ_d0dZPoTBVqM';

        $width = 200;
        $height = 300;
        $googleImage = new GoogleImage($imageUrl . '=w515-h290', false);
        $url = $googleImage
            ->setWidth($width)
            ->setHeight($height)
            ->setSquareCrop(true)
            ->getUrl()
        ;

        self::assertSame($url, $imageUrl . '=w' . $width . '-h' . $height . '-c');

        $imageInfo = getimagesize($url);
        self::assertNotFalse($imageInfo, 'Error fetch image to ' . $url);

        self::assertSame($imageInfo[0], $width);
        self::assertSame($imageInfo[1], $height);
    }

    public function testUrlVariant(): void
    {
        $baseUrl = 'https://lh3.googleusercontent.com/-khz-7NpZXic/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3reKXLHM7Pk6A7iXGRNBP8HxB0Xs1Q/';
        $imageUrl = $baseUrl . 'w48-h48-n-mo/photo.jpg';

        $googleImage = new GoogleImage($imageUrl);
        self::assertSame($googleImage->getUrl(), $baseUrl . 'w48-h48/');
        $googleImage->reset();

        self::assertSame($googleImage->getUrl(), $baseUrl);
        $imageInfo = getimagesize($googleImage->getUrl());
        self::assertNotFalse($imageInfo, 'Error fetch image to ' . $googleImage->getUrl());
        self::assertSame($imageInfo[0], 512);
        self::assertSame($imageInfo[1], 512);

        $googleImage->setSize(300);
        self::assertSame($googleImage->getUrl(), $baseUrl . 's300/');
        $imageInfo = getimagesize($googleImage->getUrl());
        self::assertNotFalse($imageInfo, 'Error fetch image to ' . $googleImage->getUrl());
        self::assertSame($imageInfo[0], 300);
        self::assertSame($imageInfo[1], 300);

        $googleImage->setWidth(300);
        self::assertSame($googleImage->getUrl(), $baseUrl . 'w300/');
        $imageInfo = getimagesize($googleImage->getUrl());
        self::assertNotFalse($imageInfo, 'Error fetch image to ' . $googleImage->getUrl());
        self::assertSame($imageInfo[0], 300);
        self::assertSame($imageInfo[1], 300);

        $googleImage->setHeight(300);
        self::assertSame($googleImage->getUrl(), $baseUrl . 'w300-h300/');
        $imageInfo = getimagesize($googleImage->getUrl());
        self::assertNotFalse($imageInfo, 'Error fetch image to ' . $googleImage->getUrl());
        self::assertSame($imageInfo[0], 300);
        self::assertSame($imageInfo[1], 300);

        $googleImage->setHeight(100);
        self::assertSame($googleImage->getUrl(), $baseUrl . 'w300-h100/');
        $imageInfo = getimagesize($googleImage->getUrl());
        self::assertNotFalse($imageInfo, 'Error fetch image to ' . $googleImage->getUrl());
        self::assertSame($imageInfo[0], 300);
        self::assertSame($imageInfo[1], 100);

        $googleImage->setSquareCrop(true);
        self::assertSame($googleImage->getUrl(), $baseUrl . 'w300-h100-c/');
        $imageInfo = getimagesize($googleImage->getUrl());
        self::assertNotFalse($imageInfo, 'Error fetch image to ' . $googleImage->getUrl());
        self::assertSame($imageInfo[0], 100);
        self::assertSame($imageInfo[1], 100);

        $googleImage->setSmartCrop(true);
        self::assertSame($googleImage->getUrl(), $baseUrl . 'w300-h100-p/');
        $imageInfo = getimagesize($googleImage->getUrl());
        self::assertNotFalse($imageInfo, 'Error fetch image to ' . $googleImage->getUrl());
        self::assertSame($imageInfo[0], 300);
        self::assertSame($imageInfo[1], 100);

        $googleImage->setWidth(null);
        self::assertSame($googleImage->getUrl(), $baseUrl . 'h100/');
        $imageInfo = getimagesize($googleImage->getUrl());
        self::assertNotFalse($imageInfo, 'Error fetch image to ' . $googleImage->getUrl());
        self::assertSame($imageInfo[0], 100);
        self::assertSame($imageInfo[1], 100);

        // no effect for avatar
        $googleImage->setBorder(10);
        $googleImage->setVerticalFlip(true);
        $googleImage->setHorizontalFlip(true);
        self::assertSame($googleImage->getUrl(), $baseUrl . 'h100/');
    }

    public function testHashUrl(): void
    {
        $imageUrl = 'https://lh3.googleusercontent.com/nYhPnY2I-e9rpqnid9u9aAODz4C04OycEGxqHG5vxFnA35OGmLMrrUmhM9eaHKJ7liB-';

        $image = new GoogleImage($imageUrl);

        $algo = 'sha1';
        self::assertSame($image->getHashUrl(), '8c720ab622672d2324898aaff5dd381c');
        self::assertSame($image->getHashUrl($algo), '8e7fb0940b21b4f428974a252da484a835b10fb3');
        self::assertSame($image->getHashUrl($algo, 2), '8e/7f/8e7fb0940b21b4f428974a252da484a835b10fb3');
        self::assertSame($image->getHashUrl($algo, 2, 3), '8e7/fb0/8e7fb0940b21b4f428974a252da484a835b10fb3');
        self::assertSame(
            $image->getHashUrl($algo, 3, 10),
            '8e7fb0940b/21b4f42897/4a252da484/8e7fb0940b21b4f428974a252da484a835b10fb3'
        );
        self::assertSame(
            $image->getHashUrl($algo, 100, 100),
            '8e7fb0/940b21/b4f428/974a25/2da484/a835b1/8e7fb0940b21b4f428974a252da484a835b10fb3'
        );
    }

    /**
     * @dataProvider provideInvalidHostUrl
     *
     * @param string $url
     */
    public function testInvalidHostUrl(string $url): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Unsupported URL');

        new GoogleImage($url);
    }

    /**
     * @return array
     */
    public function provideInvalidHostUrl(): array
    {
        return [
            [''],
            ['https://i.ytimg.com/vi/2-BhzcS2UNw/maxresdefault.jpg'],
            ['https://googleusercontent.com/nYhPnY2I-e9rpqnid9u9aAODz4C04OycEGxqHG5vxFnA35OGmLMrrUmhM9eaHKJ7liB-'],
            ['https://ggpht.com/EGemoI2NTXmTsBVtJqk8jxF9rh8ApRWfsIMQSt2uE4OcpQqbFu7f7NbTK05lx80nuSijCz7sc3a277R67g'],
            ['https://bp.blogspot.com/-gZoPZt6mOLQ/XMa2QFgXs6I/AAAAAAAACGs/wqldyhxSPX4PcttYLT1SB32O8-mbe5q7QCEwYBhgL/w100/top%2B40%2Bbest%2Btravel%2Bquotes.png'],
        ];
    }
}
