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

namespace Nelexa\GPlay\Tests\Model\Builder;

use Nelexa\GPlay\Model\Developer;
use Nelexa\GPlay\Model\GoogleImage;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @small
 */
final class DeveloperBuildTest extends TestCase
{
    public function testBuilder(): void
    {
        $developerId = '11111111111111111';
        $developerUrl = 'https://play.google.com/apps/dev?id=11111111111111111';
        $developerName = 'Test developer';
        $developerIcon = new GoogleImage(
            'https://lh3.googleusercontent.com/n5g1OHEQH0icjrImRZCvXfWEqo7FWN-Jg9tH9n18Ryntv3XxPx-Shd3BQmcp16nyXS0'
        );
        $developerCover = new GoogleImage(
            'https://lh3.googleusercontent.com/LdtfXXzkEBDOqlGpHefUy0SlGL1X07sYAmmAEyFtuaiNwfHwjqqgKTAzRKDgNDi3PQ'
        );
        $developerWebsite = 'https://www.example.com';
        $developerDescription = 'Developer description apps';
        $developerEmail = 'dev@example.com';
        $developerAddress = 'Test, ZZ';

        $builder = Developer::newBuilder();

        try {
            new Developer($builder);
            self::fail('Developer id is null or empty');
        } catch (\InvalidArgumentException $e) {
            self::assertStringContainsString('Developer id', $e->getMessage());
        }

        $builder->setId($developerId);

        try {
            new Developer($builder);
            self::fail('Developer page url is null or empty');
        } catch (\InvalidArgumentException $e) {
            self::assertStringContainsString('Developer url', $e->getMessage());
        }

        $builder->setUrl($developerUrl);

        try {
            new Developer($builder);
            self::fail('Developer name is null or empty');
        } catch (\InvalidArgumentException $e) {
            self::assertStringContainsString('Developer name', $e->getMessage());
        }

        $builder->setName($developerName);

        $developer = new Developer($builder);
        self::assertSame($developer->getId(), $developerId);
        self::assertSame($developer->getUrl(), $developerUrl);
        self::assertSame($developer->getName(), $developerName);
        self::assertNull($developer->getIcon());
        self::assertNull($developer->getCover());
        self::assertNull($developer->getAddress());
        self::assertNull($developer->getEmail());
        self::assertNull($developer->getWebsite());
        self::assertNull($developer->getDescription());

        $builder
            ->setIcon($developerIcon)
            ->setCover($developerCover)
            ->setWebsite($developerWebsite)
            ->setDescription($developerDescription)
            ->setEmail($developerEmail)
            ->setAddress($developerAddress)
        ;

        $developer = new Developer($builder);
        self::assertSame($developer->getIcon(), $developerIcon);
        self::assertSame($developer->getCover(), $developerCover);
        self::assertSame($developer->getWebsite(), $developerWebsite);
        self::assertSame($developer->getDescription(), $developerDescription);
        self::assertSame($developer->getEmail(), $developerEmail);
        self::assertSame($developer->getAddress(), $developerAddress);
    }
}
