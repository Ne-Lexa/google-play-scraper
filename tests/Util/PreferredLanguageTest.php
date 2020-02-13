<?php

declare(strict_types=1);

namespace Nelexa\GPlay\Tests\Util;

use Nelexa\GPlay\Util\LocaleHelper;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @small
 */
final class PreferredLanguageTest extends TestCase
{
    /**
     * @dataProvider providerPreferredLanguage
     *
     * @param string $sourceLocale
     * @param string $translateLangName
     * @param string $destLocale
     */
    public function testPreferredLanguage(string $sourceLocale, string $translateLangName, string $destLocale): void
    {
        self::assertEquals(
            LocaleHelper::findPreferredLanguage($sourceLocale, $translateLangName),
            $destLocale,
            'Error ' . $sourceLocale . ' -> ' . $destLocale
        );
    }

    /**
     * @return array
     */
    public function providerPreferredLanguage(): array
    {
        return [
            ['ar', 'الإنجليزية (أستراليا)', 'en_AU'],
            ['az', 'filippin', 'fil'],
            ['be_BE', 'бірманская (М’янма [Бірма])', 'my_MM'],
            ['zh_TW', '挪威文（挪威）', 'no_NO'],
            ['zh_Hans', '挪威语（挪威）', 'no_NO'],
            ['zh_HK', '挪威文（挪威）', 'no_NO'],
            ['tg', 'Английский (Южно-Африканская Республика)', 'en_ZA'],
            ['ru_UA', 'Английский (Южно-Африканская Республика)', 'en_ZA'],
            ['ne_NP', 'फ्रान्सेली (क्यानाडा)', 'fr_CA'],
            ['my_MM', 'အင်္ဂလိပ် (အမေရိကန် ပြည်ထောင်စု)', 'en_US'],
        ];
    }

    /**
     * @dataProvider providerErrorPreferredLanguage
     *
     * @param string $sourceLocale
     * @param string $translateLangName
     * @param string $destLocale
     */
    public function testErrorPreferredLanguage(
        string $sourceLocale,
        string $translateLangName,
        string $destLocale
    ): void {
        self::assertNotEquals(
            LocaleHelper::findPreferredLanguage($sourceLocale, $translateLangName),
            $destLocale,
            $sourceLocale . ' -> ' . $destLocale
        );
    }

    /**
     * @return array
     */
    public function providerErrorPreferredLanguage(): array
    {
        return [
            ['ko', 'الإنجليزية (أستراليا)', 'en_AU'],
            ['mk', 'filippin', 'fil'],
            ['Test', 'бірманская (М’янма [Бірма])', 'my_MM'],
            ['zh_Hans', '挪威文（挪威）', 'no_NO'],
            ['zh_Hant', '挪威语（挪威）', 'no_NO'],
            ['zh_CN', '挪威文（挪威）', 'no_NO'],
            ['be', 'Английский (Южно-Африканская Республика)', 'en_ZA'],
            ['ru_UA', 'Английский (Южно-Африканская Республика)', 'en_US'],
            ['ne_NP', 'फ्रान्सेली (क्यानाडा)', 'fr_FR'],
            ['my_MM', 'အင်္ဂလိပ် (အမေရိကန် ပြည်ထောင်စု)', 'en_IN'],
        ];
    }
}
