<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Tests\Model\Builder;

use Nelexa\GPlay\Model\Developer;
use Nelexa\GPlay\Model\GoogleImage;
use PHPUnit\Framework\TestCase;

class DeveloperBuildTest extends TestCase
{
    public function testBuilder(): void
    {
        $developerId = '11111111111111111';
        $developerUrl = 'https://play.google.com/apps/dev?id=11111111111111111';
        $developerName = 'Test developer';
        $developerIcon = new GoogleImage('https://lh3.googleusercontent.com/n5g1OHEQH0icjrImRZCvXfWEqo7FWN-Jg9tH9n18Ryntv3XxPx-Shd3BQmcp16nyXS0');
        $developerHeaderImage = new GoogleImage('https://lh3.googleusercontent.com/LdtfXXzkEBDOqlGpHefUy0SlGL1X07sYAmmAEyFtuaiNwfHwjqqgKTAzRKDgNDi3PQ');
        $developerWebsite = 'https://www.example.com';
        $developerDescription = 'Developer description apps';
        $developerEmail = 'dev@example.com';
        $developerAddress = 'Test, ZZ';

        $builder = Developer::newBuilder();

        try {
            new Developer($builder);
            $this->fail('$id is null or empty');
        } catch (\InvalidArgumentException $e) {
            $this->assertStringContainsString('$id', $e->getMessage());
        }

        $builder->setId($developerId);
        try {
            new Developer($builder);
            $this->fail('$url is null or empty');
        } catch (\InvalidArgumentException $e) {
            $this->assertStringContainsString('$url', $e->getMessage());
        }

        $builder->setUrl($developerUrl);
        try {
            new Developer($builder);
            $this->fail('$name is null or empty');
        } catch (\InvalidArgumentException $e) {
            $this->assertStringContainsString('$name', $e->getMessage());
        }

        $builder->setName($developerName);

        $developer = new Developer($builder);
        $this->assertSame($developer->getId(), $developerId);
        $this->assertSame($developer->getUrl(), $developerUrl);
        $this->assertSame($developer->getName(), $developerName);
        $this->assertNull($developer->getIcon());
        $this->assertNull($developer->getHeaderImage());
        $this->assertNull($developer->getAddress());
        $this->assertNull($developer->getEmail());
        $this->assertNull($developer->getWebsite());
        $this->assertNull($developer->getDescription());

        $builder
            ->setIcon($developerIcon)
            ->setHeaderImage($developerHeaderImage)
            ->setWebsite($developerWebsite)
            ->setDescription($developerDescription)
            ->setEmail($developerEmail)
            ->setAddress($developerAddress);

        $developer = new Developer($builder);
        $this->assertSame($developer->getIcon(), $developerIcon);
        $this->assertSame($developer->getHeaderImage(), $developerHeaderImage);
        $this->assertSame($developer->getWebsite(), $developerWebsite);
        $this->assertSame($developer->getDescription(), $developerDescription);
        $this->assertSame($developer->getEmail(), $developerEmail);
        $this->assertSame($developer->getAddress(), $developerAddress);
    }
}
