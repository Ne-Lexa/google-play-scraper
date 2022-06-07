<?php

/** @noinspection SpellCheckingInspection */
declare(strict_types=1);

/*
 * Copyright (c) Ne-Lexa
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/Ne-Lexa/google-play-scraper
 */

namespace Nelexa\GPlay\Util;

/**
 * Class LocaleHelper.
 */
class LocaleHelper
{
    public const DEFAULT_GOOGLE_PLAY_LOCALE = 'en_US';

    public const SUPPORTED_LOCALES = [
        'en_us' => 'en_US', // English (United States)
        'af' => 'af', // Afrikaans
        'am' => 'am', // Amharic
        'ar' => 'ar', // Arabic
        'az_az' => 'az_AZ', // Azerbaijani
        'be' => 'be', // Belarusian
        'bg' => 'bg', // Bulgarian
        'bn_bd' => 'bn_BD', // Bengali
        'ca' => 'ca', // Catalan
        'cs_cz' => 'cs_CZ', // Czech
        'da_dk' => 'da_DK', // Danish
        'de_de' => 'de_DE', // German
        'el_gr' => 'el_GR', // Greek
        'en_au' => 'en_AU', // English (Australia)
        'en_ca' => 'en_CA', // English (Canada)
        'en_gb' => 'en_GB', // English (United Kingdom)
        'en_in' => 'en_IN', // English (India)
        'en_sg' => 'en_SG', // English (Singapore)
        'en_za' => 'en_ZA', // English (South Africa)
        'es_419' => 'es_419', // Spanish (Latin America)
        'es_es' => 'es_ES', // Spanish (Spain)
        'es_us' => 'es_US', // Spanish (United States)
        'et' => 'et', // Estonian
        'eu_es' => 'eu_ES', // Basque
        'fa' => 'fa', // Persian
        'fi_fi' => 'fi_FI', // Finnish
        'fil' => 'fil', // Filipino
        'fr_ca' => 'fr_CA', // French (Canada)
        'fr_fr' => 'fr_FR', // French
        'gl_es' => 'gl_ES', // Galician
        'hi_in' => 'hi_IN', // Hindi
        'hr' => 'hr', // Croatian
        'hu_hu' => 'hu_HU', // Hungarian
        'hy_am' => 'hy_AM', // Armenian
        'id' => 'id', // Indonesian
        'is_is' => 'is_IS', // Icelandic
        'it_it' => 'it_IT', // Italian
        'iw_il' => 'iw_IL', // Hebrew
        'ja_jp' => 'ja_JP', // Japanese
        'ka_ge' => 'ka_GE', // Georgian
        'kk' => 'kk', // Kazakh
        'km_kh' => 'km_KH', // Khmer
        'kn_in' => 'kn_IN', // Kannada
        'ko_kr' => 'ko_KR', // Korean (South Korea)
        'ky_kg' => 'ky_KG', // Kyrgyz
        'lo_la' => 'lo_LA', // Lao
        'lt' => 'lt', // Lithuanian
        'lv' => 'lv', // Latvian
        'mk_mk' => 'mk_MK', // Macedonian
        'ml_in' => 'ml_IN', // Malayalam
        'mn_mn' => 'mn_MN', // Mongolian
        'mr_in' => 'mr_IN', // Marathi
        'ms' => 'ms', // Malay
        'my_mm' => 'my_MM', // Burmese
        'ne_np' => 'ne_NP', // Nepali
        'nl_nl' => 'nl_NL', // Dutch
        'no_no' => 'no_NO', // Norwegian
        'pl_pl' => 'pl_PL', // Polish
        'pt_br' => 'pt_BR', // Portuguese (Brazil)
        'pt_pt' => 'pt_PT', // Portuguese (Portugal)
        'ro' => 'ro', // Romanian
        'ru_ru' => 'ru_RU', // Russian
        'si_lk' => 'si_LK', // Sinhala
        'sk' => 'sk', // Slovak
        'sl' => 'sl', // Slovenian
        'sr' => 'sr', // Serbian
        'sv_se' => 'sv_SE', // Swedish
        'sw' => 'sw', // Swahili
        'ta_in' => 'ta_IN', // Tamil
        'te_in' => 'te_IN', // Telugu
        'th' => 'th', // Thai
        'tr_tr' => 'tr_TR', // Turkish
        'uk' => 'uk', // Ukrainian
        'vi' => 'vi', // Vietnamese
        'zh_cn' => 'zh_CN', // Chinese (Simplified)
        'zh_hk' => 'zh_HK', // Chinese (Hong Kong)
        'zh_tw' => 'zh_TW', // Chinese (Traditional)
        'zu' => 'zu', // Zulu
    ];

    private const ALIASES_LOCALE = [
        'az' => 'az_AZ',
        'bn' => 'bn_BD',
        'bo' => 'zh_TW',
        'bo_cn' => 'zh_TW',
        'bo_in' => 'zh_TW',
        'br' => 'fr_FR',
        'ckb' => 'ar',
        'cs' => 'cs_CZ',
        'da' => 'da_DK',
        'de' => 'de_DE',
        'el' => 'el_GR',
        'en' => 'en_US',
        'en_001' => 'en_AU',
        'en_150' => 'en_AU',
        'en_ae' => 'en_AU',
        'en_ag' => 'en_AU',
        'en_ai' => 'en_AU',
        'en_as' => 'en_AU',
        'en_at' => 'en_AU',
        'en_bb' => 'en_AU',
        'en_be' => 'en_AU',
        'en_bi' => 'en_AU',
        'en_bm' => 'en_AU',
        'en_bs' => 'en_AU',
        'en_bw' => 'en_AU',
        'en_bz' => 'en_AU',
        'en_cc' => 'en_AU',
        'en_ch' => 'en_AU',
        'en_ck' => 'en_AU',
        'en_cm' => 'en_AU',
        'en_cx' => 'en_AU',
        'en_cy' => 'en_AU',
        'en_de' => 'en_AU',
        'en_dg' => 'en_AU',
        'en_dk' => 'en_AU',
        'en_dm' => 'en_AU',
        'en_er' => 'en_AU',
        'en_ie' => 'en_AU',
        'en_fi' => 'en_AU',
        'en_fj' => 'en_AU',
        'en_fk' => 'en_AU',
        'en_fm' => 'en_AU',
        'en_gd' => 'en_AU',
        'en_gg' => 'en_AU',
        'en_gh' => 'en_AU',
        'en_gi' => 'en_AU',
        'en_gm' => 'en_AU',
        'en_gu' => 'en_AU',
        'en_gy' => 'en_AU',
        'en_hk' => 'en_AU',
        'en_il' => 'en_AU',
        'en_im' => 'en_AU',
        'en_io' => 'en_AU',
        'en_je' => 'en_AU',
        'en_jm' => 'en_AU',
        'en_ke' => 'en_AU',
        'en_ki' => 'en_AU',
        'en_kn' => 'en_AU',
        'en_ky' => 'en_AU',
        'en_lc' => 'en_AU',
        'en_lr' => 'en_AU',
        'en_ls' => 'en_AU',
        'en_mg' => 'en_AU',
        'en_mh' => 'en_AU',
        'en_mo' => 'en_AU',
        'en_mp' => 'en_AU',
        'en_ms' => 'en_AU',
        'en_mt' => 'en_AU',
        'en_mu' => 'en_AU',
        'en_mw' => 'en_AU',
        'en_my' => 'en_AU',
        'en_na' => 'en_AU',
        'en_nf' => 'en_AU',
        'en_ng' => 'en_AU',
        'en_nl' => 'en_AU',
        'en_nr' => 'en_AU',
        'en_nu' => 'en_AU',
        'en_nz' => 'en_AU',
        'en_pg' => 'en_AU',
        'en_ph' => 'en_AU',
        'en_pk' => 'en_AU',
        'en_pn' => 'en_AU',
        'en_pr' => 'en_AU',
        'en_pw' => 'en_AU',
        'en_rw' => 'en_AU',
        'en_sb' => 'en_AU',
        'en_sc' => 'en_AU',
        'en_sd' => 'en_AU',
        'en_se' => 'en_AU',
        'en_sh' => 'en_AU',
        'en_si' => 'en_AU',
        'en_sl' => 'en_AU',
        'en_ss' => 'en_AU',
        'en_sx' => 'en_AU',
        'en_sz' => 'en_AU',
        'en_tc' => 'en_AU',
        'en_tk' => 'en_AU',
        'en_to' => 'en_AU',
        'en_tt' => 'en_AU',
        'en_tv' => 'en_AU',
        'en_tz' => 'en_AU',
        'en_ug' => 'en_AU',
        'en_um' => 'en_AU',
        'en_us_posix' => 'en_US',
        'en_vc' => 'en_AU',
        'en_vg' => 'en_AU',
        'en_vi' => 'en_AU',
        'en_vu' => 'en_AU',
        'en_ws' => 'en_AU',
        'en_zm' => 'en_AU',
        'en_zw' => 'en_AU',
        'es' => 'es_ES',
        'es_br' => 'es_419',
        'es_bz' => 'es_419',
        'es_cu' => 'es_419',
        'eu' => 'eu_ES',
        'fi' => 'fi_FI',
        'fil' => 'fil',
        'fo' => 'da_DK',
        'fr' => 'fr_FR',
        'fr_bl' => 'fr_CA',
        'fr_gf' => 'fr_CA',
        'fr_gp' => 'fr_CA',
        'fr_ht' => 'fr_CA',
        'fr_mf' => 'fr_CA',
        'fr_mq' => 'fr_CA',
        'fr_pm' => 'fr_CA',
        'fy' => 'nl_NL',
        'gl' => 'gl_ES',
        'he' => 'iw_IL',
        'hi' => 'hi_IN',
        'hu' => 'hu_HU',
        'hy' => 'hy_AM',
        'in' => 'id',
        'is' => 'is_IS',
        'it' => 'it_IT',
        'iw' => 'iw_IL',
        'ja' => 'ja_JP',
        'jv' => 'id',
        'ka' => 'ka_GE',
        'km' => 'km_KH',
        'kn' => 'kn_IN',
        'ko' => 'ko_KR',
        'ku' => 'tr_TR',
        'ky' => 'ky_KG',
        'lo' => 'lo_LA',
        'mg' => 'fr_FR',
        'mk' => 'mk_MK',
        'ml' => 'ml_IN',
        'mn' => 'mn_MN',
        'mo' => 'ro',
        'mr' => 'mr_IN',
        'mt' => 'en_GB',
        'mt_mt' => 'en_GB',
        'my' => 'my_MM',
        'nb' => 'no_NO',
        'ne' => 'ne_NP',
        'nl' => 'nl_NL',
        'nn' => 'no_NO',
        'no' => 'no_NO',
        'or' => 'en_GB',
        'or_in' => 'en_GB',
        'pl' => 'pl_PL',
        'ps' => 'en_GB',
        'ps_af' => 'en_GB',
        'pt' => 'pt_PT',
        'pt_ao' => 'pt_PT',
        'pt_ch' => 'pt_PT',
        'pt_cv' => 'pt_PT',
        'pt_gq' => 'pt_PT',
        'pt_gw' => 'pt_PT',
        'pt_lu' => 'pt_PT',
        'pt_mo' => 'pt_PT',
        'pt_mz' => 'pt_PT',
        'pt_st' => 'pt_PT',
        'pt_tl' => 'pt_PT',
        'qu' => 'es_419',
        'qu_bo' => 'es_419',
        'qu_ec' => 'es_419',
        'qu_pe' => 'es_419',
        'rm' => 'de_DE',
        'ro' => 'ro',
        'ru' => 'ru_RU',
        'rw' => 'fr_FR',
        'sh' => 'sr',
        'sh_ba' => 'sr',
        'sh_cs' => 'sr',
        'sh_yu' => 'sr',
        'si' => 'si_LK',
        'sv' => 'sv_SE',
        'ta' => 'ta_IN',
        'te' => 'te_IN',
        'tg' => 'ru_RU',
        'ti' => 'en_GB',
        'ti_er' => 'en_GB',
        'ti_et' => 'en_GB',
        'tk' => 'ru_RU',
        'tl' => 'fil',
        'tr' => 'tr_TR',
        'tt' => 'ru_RU',
        'ug' => 'zh_CN',
        'ug_cn' => 'zh_CN',
        'wo' => 'fr_FR',
        'zh' => 'zh_CN',
        'zh_hans_cn' => 'zh_CN',
        'zh_hant' => 'zh_TW',
        'zh_hant_hk' => 'zh_HK',
        'zh_hant_mo' => 'zh_HK',
        'zh_hant_tw' => 'zh_TW',
        'zh_mo' => 'zh_HK',
    ];

    /**
     * Normalizes the locale.
     *
     * @param string $locale
     *
     * @return string
     */
    public static function getNormalizeLocale(string $locale): string
    {
        if ($locale === '') {
            return self::DEFAULT_GOOGLE_PLAY_LOCALE;
        }
        $locale = str_replace('-', '_', strtolower($locale));

        if (isset(self::SUPPORTED_LOCALES[$locale])) {
            return self::SUPPORTED_LOCALES[$locale];
        }

        if (isset(self::ALIASES_LOCALE[$locale])) {
            return self::ALIASES_LOCALE[$locale];
        }

        if (($pos = strpos($locale, '_')) !== false) {
            $locale = substr($locale, 0, $pos);

            if (isset(self::SUPPORTED_LOCALES[$locale])) {
                return self::SUPPORTED_LOCALES[$locale];
            }

            if (isset(self::ALIASES_LOCALE[$locale])) {
                return self::ALIASES_LOCALE[$locale];
            }
        }

        return self::DEFAULT_GOOGLE_PLAY_LOCALE;
    }

    /**
     * Normalizes the locales.
     *
     * @param array $locales
     *
     * @return array
     */
    public static function getNormalizeLocales(array $locales): array
    {
        $locales = !empty($locales) ? $locales : self::SUPPORTED_LOCALES;
        $locales = array_map([self::class, 'getNormalizeLocale'], $locales);

        return array_values(array_unique($locales));
    }
}
