<?php

/** @noinspection PhpUnusedPrivateMethodInspection */
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
 * The class for converting a localized date to the \DateTimeInterface.
 * It would be possible to use the php-intl library, but its different
 * versions give different results.
 *
 * @internal
 */
class DateStringFormatter
{
    private const MEDIUM_DATE_PATTERNS = [
        'af' => [
            'pattern' => '~^(?P<day>\d+)\s(?P<month>.*?)\s(?P<year>\d{4})$~',
            'months' => [
                'Jan.' => 1,
                'Feb.' => 2,
                'Mrt.' => 3,
                'Apr.' => 4,
                'Mei' => 5,
                'Jun.' => 6,
                'Jul.' => 7,
                'Aug.' => 8,
                'Sep.' => 9,
                'Okt.' => 10,
                'Nov.' => 11,
                'Des.' => 12,
            ],
        ],
        'am' => [
            'pattern' => '~^(?P<day>\d+)\s(?P<month>.*?)\s(?P<year>\d{4})~',
            'months' => [
                'ጃንዩ' => 1,
                'ፌብሩ' => 2,
                'ማርች' => 3,
                'ኤፕሪ' => 4,
                'ሜይ' => 5,
                'ጁን' => 6,
                'ጁላይ' => 7,
                'ኦገስ' => 8,
                'ሴፕቴ' => 9,
                'ኦክቶ' => 10,
                'ኖቬም' => 11,
                'ዲሴም' => 12,
            ],
        ],
        'ar' => [
            'pattern' => '~^(?P<day>\d{2})‏/(?P<month>\d{2})‏/(?P<year>\d{4})$~',
        ],
        'az_AZ' => [
            'pattern' => '~^(?P<day>\d+)\s(?P<month>.*?)\s(?P<year>\d{4})~',
            'months' => [
                'yan' => 1,
                'fev' => 2,
                'mar' => 3,
                'apr' => 4,
                'may' => 5,
                'iyn' => 6,
                'iyl' => 7,
                'avq' => 8,
                'sen' => 9,
                'okt' => 10,
                'noy' => 11,
                'dek' => 12,
            ],
        ],
        'be' => [
            'pattern' => '~^(?P<day>\d{1,2}) (?P<month>.*?) (?P<year>\d{4}) г.$~',
            'months' => [
                'сту' => 1,
                'лют' => 2,
                'сак' => 3,
                'кра' => 4,
                'мая' => 5,
                'чэр' => 6,
                'ліп' => 7,
                'жні' => 8,
                'вер' => 9,
                'кас' => 10,
                'ліс' => 11,
                'сне' => 12,
            ],
        ],
        'bg' => [
            'pattern' => '~^(?P<day>\d{1,2})\.(?P<month>\d{2})\.(?P<year>\d{4}) г.$~',
        ],
        'bn_BD' => [
            'pattern' => '~^(?P<day>\d+)\s(?P<month>.*?),\s(?P<year>\d{4})$~',
            'convert' => [__CLASS__, 'convertBengaliNumbers'],
            'months' => [
                'জানু' => 1,
                'ফেব' => 2,
                'মার্চ' => 3,
                'এপ্রিল' => 4,
                'মে' => 5,
                'জুন' => 6,
                'জুলাই' => 7,
                'আগস্ট' => 8,
                'সেপ্টেম্বর' => 9,
                'অক্টোবর' => 10,
                'নভেম্বর' => 11,
                'ডিসেম্বর' => 12,
            ],
        ],
        'ca' => [
            'pattern' => '~^(?P<day>\d{1,2})\s(?P<month>.*)\s(?P<year>\d{4})$~',
            'months' => [
                'de gen.' => 1,
                'de febr.' => 2,
                'de març' => 3,
                'd’abr.' => 4,
                'de maig' => 5,
                'de juny' => 6,
                'de jul.' => 7,
                'd’ag.' => 8,
                'de set.' => 9,
                'd’oct.' => 10,
                'de nov.' => 11,
                'de des.' => 12,
            ],
        ],
        'cs_CZ' => [
            'pattern' => '~^(?P<day>\d{1,2})\.\s(?P<month>\d{1,2})\.\s(?P<year>\d{4})$~',
        ],
        'da_DK' => [
            'pattern' => '~^(?P<day>\d{1,2})\.\s(?P<month>.*?)\s(?P<year>\d{4})$~',
            'months' => [
                'jan.' => 1,
                'feb.' => 2,
                'mar.' => 3,
                'apr.' => 4,
                'maj' => 5,
                'jun.' => 6,
                'jul.' => 7,
                'aug.' => 8,
                'sep.' => 9,
                'okt.' => 10,
                'nov.' => 11,
                'dec.' => 12,
            ],
        ],
        'de_DE' => [
            'pattern' => '~^(?P<day>\d{2})\.(?P<month>\d{2})\.(?P<year>\d{4})$~',
        ],
        'el_GR' => [
            'pattern' => '~^(?P<day>\d{1,2})\s(?P<month>.*?)\s(?P<year>\d{4})$~',
            'months' => [
                'Ιαν' => 1,
                'Φεβ' => 2,
                'Μαρ' => 3,
                'Απρ' => 4,
                'Μαΐ' => 5,
                'Ιουν' => 6,
                'Ιουλ' => 7,
                'Αυγ' => 8,
                'Σεπ' => 9,
                'Οκτ' => 10,
                'Νοε' => 11,
                'Δεκ' => 12,
            ],
        ],
        'en_AU' => [
            'pattern' => '~^(?P<day>\d{1,2})\s(?P<month>.*?)\s(?P<year>\d{4})$~',
            'months' => [
                'Jan' => 1,
                'Feb' => 2,
                'Mar' => 3,
                'Apr' => 4,
                'May' => 5,
                'Jun' => 6,
                'June' => 6,
                'Jul' => 7,
                'July' => 7,
                'Aug' => 8,
                'Sep' => 9,
                'Sept' => 9,
                'Oct' => 10,
                'Nov' => 11,
                'Dec' => 12,
            ],
        ],
        'en_CA' => [
            'pattern' => '~^(?P<month>.*?)\.?\s(?P<day>\d{1,2}),\s(?P<year>\d{4})$~',
            'months' => [
                'Jan' => 1,
                'Feb' => 2,
                'Mar' => 3,
                'Apr' => 4,
                'May' => 5,
                'Jun' => 6,
                'Jul' => 7,
                'Aug' => 8,
                'Sep' => 9,
                'Sept' => 9,
                'Oct' => 10,
                'Nov' => 11,
                'Dec' => 12,
            ],
        ],
        'en_GB' => [
            'pattern' => '~^(?P<day>\d{1,2})\s(?P<month>.*?)\s(?P<year>\d{4})$~',
            'months' => [
                'Jan' => 1,
                'Feb' => 2,
                'Mar' => 3,
                'Apr' => 4,
                'May' => 5,
                'Jun' => 6,
                'June' => 6,
                'Jul' => 7,
                'July' => 7,
                'Aug' => 8,
                'Sep' => 9,
                'Sept' => 9,
                'Oct' => 10,
                'Nov' => 11,
                'Dec' => 12,
            ],
        ],
        'en_IN' => [
            'pattern' => '~^(?P<day>\d{1,2})-(?P<month>.*?)-(?P<year>\d{4})$~',
            'months' => [
                'Jan' => 1,
                'Feb' => 2,
                'Mar' => 3,
                'Apr' => 4,
                'May' => 5,
                'Jun' => 6,
                'Jul' => 7,
                'Aug' => 8,
                'Sep' => 9,
                'Sept' => 9,
                'Oct' => 10,
                'Nov' => 11,
                'Dec' => 12,
            ],
        ],
        'en_SG' => [
            'pattern' => '~^(?P<day>\d{1,2})\s(?P<month>.*?)\s(?P<year>\d{4})$~',
            'months' => [
                'Jan' => 1,
                'Feb' => 2,
                'Mar' => 3,
                'Apr' => 4,
                'May' => 5,
                'Jun' => 6,
                'Jul' => 7,
                'Aug' => 8,
                'Sep' => 9,
                'Sept' => 9,
                'Oct' => 10,
                'Nov' => 11,
                'Dec' => 12,
            ],
        ],
        'en_US' => [
            'pattern' => '~^(?P<month>.*?)\s(?P<day>\d{1,2}),\s(?P<year>\d{4})$~',
            'months' => [
                'Jan' => 1,
                'Feb' => 2,
                'Mar' => 3,
                'Apr' => 4,
                'May' => 5,
                'Jun' => 6,
                'Jul' => 7,
                'Aug' => 8,
                'Sep' => 9,
                'Oct' => 10,
                'Nov' => 11,
                'Dec' => 12,
            ],
        ],
        'en_ZA' => [
            'pattern' => '~^(?P<day>\d{2})\s(?P<month>.*?)\s(?P<year>\d{4})$~',
            'months' => [
                'Jan' => 1,
                'Feb' => 2,
                'Mar' => 3,
                'Apr' => 4,
                'May' => 5,
                'Jun' => 6,
                'Jul' => 7,
                'Aug' => 8,
                'Sep' => 9,
                'Sept' => 9,
                'Oct' => 10,
                'Nov' => 11,
                'Dec' => 12,
            ],
        ],
        'es_419' => [
            'pattern' => '~^(?P<day>\d{1,2})\s(?P<month>.*?)\.?\s(?P<year>\d{4})$~',
            'months' => [
                'ene' => 1,
                'feb' => 2,
                'mar' => 3,
                'abr' => 4,
                'may' => 5,
                'jun' => 6,
                'jul' => 7,
                'ago' => 8,
                'sep' => 9,
                'sept' => 9,
                'oct' => 10,
                'nov' => 11,
                'dic' => 12,
            ],
        ],
        'es_ES' => [
            'pattern' => '~^(?P<day>\d{1,2})\s(?P<month>.*?)\.?\s(?P<year>\d{4})$~',
            'months' => [
                'ene' => 1,
                'feb' => 2,
                'mar' => 3,
                'abr' => 4,
                'may' => 5,
                'jun' => 6,
                'jul' => 7,
                'ago' => 8,
                'sept' => 9,
                'oct' => 10,
                'nov' => 11,
                'dic' => 12,
            ],
        ],
        'es_US' => [
            'pattern' => '~^(?P<day>\d{1,2})\s(?P<month>.*?)\.?\s(?P<year>\d{4})$~',
            'months' => [
                'ene' => 1,
                'feb' => 2,
                'mar' => 3,
                'abr' => 4,
                'may' => 5,
                'jun' => 6,
                'jul' => 7,
                'ago' => 8,
                'sep' => 9,
                'sept' => 9,
                'oct' => 10,
                'nov' => 11,
                'dic' => 12,
            ],
        ],
        'et' => [
            'pattern' => '~^(?P<day>\d{1,2})\.\s(?P<month>.*?)\s(?P<year>\d{4})$~',
            'months' => [
                'jaan' => 1,
                'veebr' => 2,
                'märts' => 3,
                'apr' => 4,
                'mai' => 5,
                'juuni' => 6,
                'juuli' => 7,
                'aug' => 8,
                'sept' => 9,
                'okt' => 10,
                'nov' => 11,
                'dets' => 12,
            ],
        ],
        'eu_ES' => [
            'pattern' => '~^(?P<year>\d{4})\(e\)ko (?P<month>.*?)\.\s(?P<day>\d{1,2})\(a\)$~',
            'months' => [
                'urt' => 1,
                'ots' => 2,
                'mar' => 3,
                'api' => 4,
                'mai' => 5,
                'eka' => 6,
                'uzt' => 7,
                'abu' => 8,
                'ira' => 9,
                'urr' => 10,
                'aza' => 11,
                'abe' => 12,
            ],
        ],
        'fa' => [
            'pattern' => '~^(?P<day>\d+)\s(?P<month>.*?)\s(?P<year>\d{4})$~',
            'convert' => [__CLASS__, 'convertFarsiNumbers'],
            'convertCalendar' => [__CLASS__, 'convertPersianToGregorianCalendar'],
            'months' => [
                'فروردین' => 1,
                'اردیبهشت' => 2,
                'خرداد' => 3,
                'تیر' => 4,
                'مرداد' => 5,
                'شهریور' => 6,
                'مهر' => 7,
                'آبان' => 8,
                'آذر' => 9,
                'دی' => 10,
                'بهمن' => 11,
                'اسفند' => 12,
            ],
        ],
        'fi_FI' => [
            'pattern' => '~^(?P<day>\d{1,2})\.(?P<month>\d{1,2})\.(?P<year>\d{4})$~',
        ],
        'fil' => [
            'pattern' => '~^(?P<month>\w+)\s(?P<day>\d{1,2}),\s(?P<year>\d{4})$~',
            'months' => [
                'Ene' => 1,
                'Peb' => 2,
                'Mar' => 3,
                'Abr' => 4,
                'May' => 5,
                'Hun' => 6,
                'Hul' => 7,
                'Ago' => 8,
                'Set' => 9,
                'Okt' => 10,
                'Nob' => 11,
                'Dis' => 12,
            ],
        ],
        'fr_CA' => [
            'pattern' => '~^(?P<day>\d{1,2})\s(?P<month>.*?)\s(?P<year>\d{4})$~',
            'months' => [
                'janv.' => 1,
                'févr.' => 2,
                'mars' => 3,
                'avr.' => 4,
                'mai' => 5,
                'juin' => 6,
                'juill.' => 7,
                'août' => 8,
                'sept.' => 9,
                'oct.' => 10,
                'nov.' => 11,
                'déc.' => 12,
            ],
        ],
        'fr_FR' => [
            'pattern' => '~^(?P<day>\d{1,2})\s(?P<month>.*?)\s(?P<year>\d{4})$~',
            'months' => [
                'janv.' => 1,
                'févr.' => 2,
                'mars' => 3,
                'avr.' => 4,
                'mai' => 5,
                'juin' => 6,
                'juil.' => 7,
                'août' => 8,
                'sept.' => 9,
                'oct.' => 10,
                'nov.' => 11,
                'déc.' => 12,
            ],
        ],
        'gl_ES' => [
            'pattern' => '~^(?P<day>\d{1,2})\sde\s(?P<month>.*?)\sde\s(?P<year>\d{4})$~',
            'months' => [
                'xan.' => 1,
                'feb.' => 2,
                'mar.' => 3,
                'abr.' => 4,
                'maio' => 5,
                'xuño' => 6,
                'xul.' => 7,
                'ago.' => 8,
                'set.' => 9,
                'out.' => 10,
                'nov.' => 11,
                'dec.' => 12,
            ],
        ],
        'hi_IN' => [
            'pattern' => '~^(?P<day>\d{1,2})\s(?P<month>.*?)\s(?P<year>\d{4})$~',
            'months' => [
                'जन॰' => 1,
                'फ़र॰' => 2,
                'मार्च' => 3,
                'अप्रैल' => 4,
                'मई' => 5,
                'जून' => 6,
                'जुल॰' => 7,
                'अग॰' => 8,
                'सित॰' => 9,
                'अक्तू॰' => 10,
                'नव॰' => 11,
                'दिस॰' => 12,
            ],
        ],
        'hr' => [
            'pattern' => '~^(?P<day>\d{1,2})\.\s(?P<month>.*?)\s(?P<year>\d{4})\.$~',
            'months' => [
                'sij' => 1,
                'velj' => 2,
                'ožu' => 3,
                'tra' => 4,
                'svi' => 5,
                'lip' => 6,
                'srp' => 7,
                'kol' => 8,
                'ruj' => 9,
                'lis' => 10,
                'stu' => 11,
                'pro' => 12,
            ],
        ],
        'hu_HU' => [
            'pattern' => '~^(?P<year>\d{4})\.\s(?P<month>.*?)\.\s(?P<day>\d{1,2})\.$~',
            'months' => [
                'jan' => 1,
                'febr' => 2,
                'márc' => 3,
                'ápr' => 4,
                'máj' => 5,
                'jún' => 6,
                'júl' => 7,
                'aug' => 8,
                'szept' => 9,
                'okt' => 10,
                'nov' => 11,
                'dec' => 12,
            ],
        ],
        'hy_AM' => [
            'pattern' => '~^(?P<day>\d{2})\s(?P<month>.*?),\s(?P<year>\d{4})\sթ.$~',
            'months' => [
                'հնվ' => 1,
                'փտվ' => 2,
                'մրտ' => 3,
                'ապր' => 4,
                'մյս' => 5,
                'հնս' => 6,
                'հլս' => 7,
                'օգս' => 8,
                'սեպ' => 9,
                'հոկ' => 10,
                'նոյ' => 11,
                'դեկ' => 12,
            ],
        ],
        'id' => [
            'pattern' => '~^(?P<day>\d{1,2})\s(?P<month>.*?)\s(?P<year>\d{4})$~',
            'months' => [
                'Jan' => 1,
                'Feb' => 2,
                'Mar' => 3,
                'Apr' => 4,
                'Mei' => 5,
                'Jun' => 6,
                'Jul' => 7,
                'Agu' => 8,
                'Sep' => 9,
                'Okt' => 10,
                'Nov' => 11,
                'Des' => 12,
            ],
        ],
        'is_IS' => [
            'pattern' => '~^(?P<day>\d{1,2})\.\s(?P<month>.*?)\s(?P<year>\d{4})$~',
            'months' => [
                'jan.' => 1,
                'feb.' => 2,
                'mar.' => 3,
                'apr.' => 4,
                'maí' => 5,
                'jún.' => 6,
                'júl.' => 7,
                'ágú.' => 8,
                'sep.' => 9,
                'okt.' => 10,
                'nóv.' => 11,
                'des.' => 12,
            ],
        ],
        'it_IT' => [
            'pattern' => '~^(?P<day>\d{1,2})\s(?P<month>.*?)\s(?P<year>\d{4})$~',
            'months' => [
                'gen' => 1,
                'feb' => 2,
                'mar' => 3,
                'apr' => 4,
                'mag' => 5,
                'giu' => 6,
                'lug' => 7,
                'ago' => 8,
                'set' => 9,
                'ott' => 10,
                'nov' => 11,
                'dic' => 12,
            ],
        ],
        'iw_IL' => [
            'pattern' => '~^(?P<day>\d{1,2})\s(?P<month>.*?)\s(?P<year>\d{4})$~',
            'months' => [
                'בינו׳' => 1,
                'בפבר׳' => 2,
                'במרץ' => 3,
                'באפר׳' => 4,
                'במאי' => 5,
                'ביוני' => 6,
                'ביולי' => 7,
                'באוג׳' => 8,
                'בספט׳' => 9,
                'באוק׳' => 10,
                'בנוב׳' => 11,
                'בדצמ׳' => 12,
            ],
        ],
        'ja_JP' => [
            'pattern' => '~^(?P<year>\d{4})/(?P<month>\d{2})/(?P<day>\d{2})$~',
        ],
        'ka_GE' => [
            'pattern' => '~^(?P<day>\d{1,2})\s(?P<month>.*?)\.\s(?P<year>\d{4})$~',
            'months' => [
                'იან' => 1,
                'თებ' => 2,
                'მარ' => 3,
                'აპრ' => 4,
                'მაი' => 5,
                'ივნ' => 6,
                'ივლ' => 7,
                'აგვ' => 8,
                'სექ' => 9,
                'ოქტ' => 10,
                'ნოე' => 11,
                'დეკ' => 12,
            ],
        ],
        'kk' => [
            'pattern' => '~^(?P<year>\d{4})\sж\.\s(?P<day>\d{2})\s(?P<month>.*?)$~',
            'months' => [
                'қаң.' => 1,
                'ақп.' => 2,
                'нау.' => 3,
                'сәу.' => 4,
                'мам.' => 5,
                'мау.' => 6,
                'шіл.' => 7,
                'там.' => 8,
                'қыр.' => 9,
                'қаз.' => 10,
                'қар.' => 11,
                'жел.' => 12,
            ],
        ],
        'km_KH' => [
            'pattern' => '~^(?P<day>\d{1,2})\s(?P<month>.*?)\s(?P<year>\d{4})$~',
            'months' => [
                'មករា' => 1,
                'កុម្ភៈ' => 2,
                'មីនា' => 3,
                'មេសា' => 4,
                'ឧសភា' => 5,
                'មិថុនា' => 6,
                'កក្កដា' => 7,
                'សីហា' => 8,
                'កញ្ញា' => 9,
                'តុលា' => 10,
                'វិច្ឆិកា' => 11,
                'ធ្នូ' => 12,
            ],
        ],
        'kn_IN' => [
            'pattern' => '~^(?P<month>.*?)\s(?P<day>\d{1,2}),\s(?P<year>\d{4})$~',
            'months' => [
                'ಜನವರಿ' => 1,
                'ಫೆಬ್ರವರಿ' => 2,
                'ಮಾರ್ಚ್' => 3,
                'ಏಪ್ರಿ' => 4,
                'ಮೇ' => 5,
                'ಜೂನ್' => 6,
                'ಜುಲೈ' => 7,
                'ಆಗ' => 8,
                'ಸೆಪ್ಟೆಂ' => 9,
                'ಅಕ್ಟೋ' => 10,
                'ನವೆಂ' => 11,
                'ಡಿಸೆಂ' => 12,
            ],
        ],
        'ko_KR' => [
            'pattern' => '~^(?P<year>\d{4})\.\s(?P<month>\d{1,2})\.\s(?P<day>\d{1,2})\.$~',
        ],
        'ky_KG' => [
            'pattern' => '~^(?P<year>\d{4})-ж\.,\s(?P<day>\d{1,2})-(?P<month>.*?)$~',
            'months' => [
                'янв.' => 1,
                'фев.' => 2,
                'мар.' => 3,
                'апр.' => 4,
                'май' => 5,
                'июн.' => 6,
                'июл.' => 7,
                'авг.' => 8,
                'сен.' => 9,
                'окт.' => 10,
                'ноя.' => 11,
                'дек.' => 12,
            ],
        ],
        'lo_LA' => [
            'pattern' => '~^(?P<day>\d{1,2})\s(?P<month>.*?)\s(?P<year>\d{4})$~',
            'months' => [
                'ມ.ກ.' => 1,
                'ກ.ພ.' => 2,
                'ມ.ນ.' => 3,
                'ມ.ສ.' => 4,
                'ພ.ພ.' => 5,
                'ມິ.ຖ.' => 6,
                'ກ.ລ.' => 7,
                'ສ.ຫ.' => 8,
                'ກ.ຍ.' => 9,
                'ຕ.ລ.' => 10,
                'ພ.ຈ.' => 11,
                'ທ.ວ.' => 12,
            ],
        ],
        'lt' => [
            'pattern' => '~^(?P<year>\d{4})-(?P<month>\d{2})-(?P<day>\d{2})$~',
        ],
        'lv' => [
            'pattern' => '~^(?P<year>\d{4})\.\sgada\s(?P<day>\d{1,2})\.\s(?P<month>.*?)$~',
            'months' => [
                'janv.' => 1,
                'febr.' => 2,
                'marts' => 3,
                'apr.' => 4,
                'maijs' => 5,
                'jūn.' => 6,
                'jūl.' => 7,
                'aug.' => 8,
                'sept.' => 9,
                'okt.' => 10,
                'nov.' => 11,
                'dec.' => 12,
            ],
        ],
        'mk_MK' => [
            'pattern' => '~^(?P<day>\d{1,2})\.(?P<month>\d{1,2})\.(?P<year>\d{4})$~',
        ],
        'ml_IN' => [
            'pattern' => '~^(?P<year>\d{4}),\s(?P<month>.*?)\s(?P<day>\d{1,2})$~',
            'months' => [
                'ജനു' => 1,
                'ഫെബ്രു' => 2,
                'മാർ' => 3,
                'ഏപ്രി' => 4,
                'മേയ്' => 5,
                'ജൂൺ' => 6,
                'ജൂലൈ' => 7,
                'ഓഗ' => 8,
                'സെപ്റ്റം' => 9,
                'ഒക്ടോ' => 10,
                'നവം' => 11,
                'ഡിസം' => 12,
            ],
        ],
        'mn_MN' => [
            'pattern' => '~^(?P<year>\d{4})\sоны\s(?P<month>\d{1,2})-р\sсарын\s(?P<day>\d{1,2})$~',
        ],
        'mr_IN' => [
            'pattern' => '~^(?P<day>\d{1,2})\s(?P<month>.*?),\s(?P<year>\d{4})$~',
            'convert' => [__CLASS__, 'convertMarathiNumbers'],
            'months' => [
                'जाने' => 1,
                'फेब्रु' => 2,
                'मार्च' => 3,
                'एप्रि' => 4,
                'मे' => 5,
                'जून' => 6,
                'जुलै' => 7,
                'ऑग' => 8,
                'सप्टें' => 9,
                'ऑक्टो' => 10,
                'नोव्हें' => 11,
                'डिसें' => 12,
            ],
        ],
        'ms' => [
            'pattern' => '~^(?P<day>\d{1,2})\s(?P<month>.*?)\s(?P<year>\d{4})$~',
            'months' => [
                'Jan' => 1,
                'Feb' => 2,
                'Mac' => 3,
                'Apr' => 4,
                'Mei' => 5,
                'Jun' => 6,
                'Jul' => 7,
                'Ogo' => 8,
                'Sep' => 9,
                'Okt' => 10,
                'Nov' => 11,
                'Dis' => 12,
            ],
        ],
        'my_MM' => [
            'pattern' => '~^(?P<year>\d{4})-\s(?P<month>.*?)\s(?P<day>\d{1,2})$~',
            'convert' => [__CLASS__, 'convertBurmeseNumbers'],
            'months' => [
                'ဇန်' => 1,
                'ဖေ' => 2,
                'မတ်' => 3,
                'ဧ' => 4,
                'မေ' => 5,
                'ဇွန်' => 6,
                'ဇူ' => 7,
                'ဩ' => 8,
                'စက်' => 9,
                'အောက်' => 10,
                'နို' => 11,
                'ဒီ' => 12,
            ],
        ],
        'ne_NP' => [
            'pattern' => '~^(?P<year>\d{4})\s(?P<month>.*?)\s(?P<day>\d{1,2})$~',
            'convert' => [__CLASS__, 'convertNepalNumbers'],
            'months' => [
                'जनवरी' => 1,
                'फेब्रुअरी' => 2,
                'मार्च' => 3,
                'अप्रिल' => 4,
                'मे' => 5,
                'जुन' => 6,
                'जुलाई' => 7,
                'अगस्ट' => 8,
                'सेप्टेम्बर' => 9,
                'अक्टोबर' => 10,
                'नोभेम्बर' => 11,
                'डिसेम्बर' => 12,
            ],
        ],
        'nl_NL' => [
            'pattern' => '~^(?P<day>\d{1,2})\s(?P<month>.*?)\s(?P<year>\d{4})$~',
            'months' => [
                'jan.' => 1,
                'feb.' => 2,
                'mrt.' => 3,
                'apr.' => 4,
                'mei' => 5,
                'jun.' => 6,
                'jul.' => 7,
                'aug.' => 8,
                'sep.' => 9,
                'okt.' => 10,
                'nov.' => 11,
                'dec.' => 12,
            ],
        ],
        'no_NO' => [
            'pattern' => '~^(?P<day>\d{1,2})\.\s(?P<month>.*?)\s(?P<year>\d{4})$~',
            'months' => [
                'jan.' => 1,
                'feb.' => 2,
                'mar.' => 3,
                'apr.' => 4,
                'mai' => 5,
                'jun.' => 6,
                'jul.' => 7,
                'aug.' => 8,
                'sep.' => 9,
                'okt.' => 10,
                'nov.' => 11,
                'des.' => 12,
            ],
        ],
        'pl_PL' => [
            'pattern' => '~^(?P<day>\d{1,2})\s(?P<month>.*?)\s(?P<year>\d{4})$~',
            'months' => [
                'sty' => 1,
                'lut' => 2,
                'mar' => 3,
                'kwi' => 4,
                'maj' => 5,
                'cze' => 6,
                'lip' => 7,
                'sie' => 8,
                'wrz' => 9,
                'paź' => 10,
                'lis' => 11,
                'gru' => 12,
            ],
        ],
        'pt_BR' => [
            'pattern' => '~^(?P<day>\d{1,2})\sde\s(?P<month>.*?)\.\sde\s(?P<year>\d{4})$~',
            'months' => [
                'jan' => 1,
                'fev' => 2,
                'mar' => 3,
                'abr' => 4,
                'mai' => 5,
                'jun' => 6,
                'jul' => 7,
                'ago' => 8,
                'set' => 9,
                'out' => 10,
                'nov' => 11,
                'dez' => 12,
            ],
        ],
        'pt_PT' => [
            'pattern' => '~^(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})$~',
        ],
        'ro' => [
            'pattern' => '~^(?P<day>\d{1,2})\s(?P<month>.*?)\s(?P<year>\d{4})$~',
            'months' => [
                'ian.' => 1,
                'feb.' => 2,
                'mar.' => 3,
                'apr.' => 4,
                'mai' => 5,
                'iun.' => 6,
                'iul.' => 7,
                'aug.' => 8,
                'sept.' => 9,
                'oct.' => 10,
                'nov.' => 11,
                'dec.' => 12,
            ],
        ],
        'ru_RU' => [
            'pattern' => '~^(?P<day>\d{1,2})\s(?P<month>.*?)\s(?P<year>\d{4})\sг\.$~',
            'months' => [
                'янв.' => 1,
                'февр.' => 2,
                'мар.' => 3,
                'апр.' => 4,
                'мая' => 5,
                'июн.' => 6,
                'июл.' => 7,
                'авг.' => 8,
                'сент.' => 9,
                'окт.' => 10,
                'нояб.' => 11,
                'дек.' => 12,
            ],
        ],
        'si_LK' => [
            'pattern' => '~^(?P<year>\d{4})\s(?P<month>.*?)\s(?P<day>\d{1,2})$~',
            'months' => [
                'ජන' => 1,
                'පෙබ' => 2,
                'මාර්තු' => 3,
                'අප්‍රේල්' => 4,
                'මැයි' => 5,
                'ජූනි' => 6,
                'ජූලි' => 7,
                'අගෝ' => 8,
                'සැප්' => 9,
                'ඔක්' => 10,
                'නොවැ' => 11,
                'දෙසැ' => 12,
            ],
        ],
        'sk' => [
            'pattern' => '~^(?P<day>\d{1,2})\.\s(?P<month>\d{1,2})\.\s(?P<year>\d{4})$~',
        ],
        'sl' => [
            'pattern' => '~^(?P<day>\d{1,2})\.\s(?P<month>.*?)\s(?P<year>\d{4})$~',
            'months' => [
                'jan.' => 1,
                'feb.' => 2,
                'mar.' => 3,
                'apr.' => 4,
                'maj' => 5,
                'jun.' => 6,
                'jul.' => 7,
                'avg.' => 8,
                'sep.' => 9,
                'okt.' => 10,
                'nov.' => 11,
                'dec.' => 12,
            ],
        ],
        'sr' => [
            'pattern' => '~^(?P<day>\d{1,2})\.\s(?P<month>\d{1,2})\.\s(?P<year>\d{4})\.$~',
        ],
        'sv_SE' => [
            'pattern' => '~^(?P<day>\d{1,2})\s(?P<month>.*?)\s(?P<year>\d{4})$~',
            'months' => [
                'jan.' => 1,
                'feb.' => 2,
                'mars' => 3,
                'apr.' => 4,
                'maj' => 5,
                'juni' => 6,
                'juli' => 7,
                'aug.' => 8,
                'sep.' => 9,
                'okt.' => 10,
                'nov.' => 11,
                'dec.' => 12,
            ],
        ],
        'sw' => [
            'pattern' => '~^(?P<day>\d{1,2})\s(?P<month>.*?)\s(?P<year>\d{4})$~',
            'months' => [
                'Jan' => 1,
                'Feb' => 2,
                'Mac' => 3,
                'Apr' => 4,
                'Mei' => 5,
                'Jun' => 6,
                'Jul' => 7,
                'Ago' => 8,
                'Sep' => 9,
                'Okt' => 10,
                'Nov' => 11,
                'Des' => 12,
            ],
        ],
        'ta_IN' => [
            'pattern' => '~^(?P<day>\d{1,2})\s(?P<month>.*?),\s(?P<year>\d{4})$~',
            'months' => [
                'ஜன.' => 1,
                'பிப்.' => 2,
                'மார்.' => 3,
                'ஏப்.' => 4,
                'மே' => 5,
                'ஜூன்' => 6,
                'ஜூலை' => 7,
                'ஆக.' => 8,
                'செப்.' => 9,
                'அக்.' => 10,
                'நவ.' => 11,
                'டிச.' => 12,
            ],
        ],
        'te_IN' => [
            'pattern' => '~^(?P<day>\d{1,2})\s(?P<month>.*?),\s(?P<year>\d{4})$~',
            'months' => [
                'జన' => 1,
                'ఫిబ్ర' => 2,
                'మార్చి' => 3,
                'ఏప్రి' => 4,
                'మే' => 5,
                'జూన్' => 6,
                'జులై' => 7,
                'ఆగ' => 8,
                'సెప్టెం' => 9,
                'అక్టో' => 10,
                'నవం' => 11,
                'డిసెం' => 12,
            ],
        ],
        'th' => [
            'pattern' => '~^(?P<day>\d{1,2})\s(?P<month>.*?)\s(?P<year>\d{4})$~',
            'convertCalendar' => [__CLASS__, 'convertThailandCalendar'],
            'months' => [
                'ม.ค.' => 1,
                'ก.พ.' => 2,
                'มี.ค.' => 3,
                'เม.ย.' => 4,
                'พ.ค.' => 5,
                'มิ.ย.' => 6,
                'ก.ค.' => 7,
                'ส.ค.' => 8,
                'ก.ย.' => 9,
                'ต.ค.' => 10,
                'พ.ย.' => 11,
                'ธ.ค.' => 12,
            ],
        ],
        'tr_TR' => [
            'pattern' => '~^(?P<day>\d{1,2})\s(?P<month>.*?)\s(?P<year>\d{4})$~',
            'months' => [
                'Oca' => 1,
                'Şub' => 2,
                'Mar' => 3,
                'Nis' => 4,
                'May' => 5,
                'Haz' => 6,
                'Tem' => 7,
                'Ağu' => 8,
                'Eyl' => 9,
                'Eki' => 10,
                'Kas' => 11,
                'Ara' => 12,
            ],
        ],
        'uk' => [
            'pattern' => '~^(?P<day>\d{1,2})\s(?P<month>.*?)\s(?P<year>\d{4})\sр\.$~',
            'months' => [
                'січ.' => 1,
                'лют.' => 2,
                'бер.' => 3,
                'квіт.' => 4,
                'трав.' => 5,
                'черв.' => 6,
                'лип.' => 7,
                'серп.' => 8,
                'вер.' => 9,
                'жовт.' => 10,
                'лист.' => 11,
                'груд.' => 12,
            ],
        ],
        'vi' => [
            'pattern' => '~^(?P<day>\d{1,2})\s(?P<month>.*?),\s(?P<year>\d{4})$~',
            'months' => [
                'thg 1' => 1,
                'thg 2' => 2,
                'thg 3' => 3,
                'thg 4' => 4,
                'thg 5' => 5,
                'thg 6' => 6,
                'thg 7' => 7,
                'thg 8' => 8,
                'thg 9' => 9,
                'thg 10' => 10,
                'thg 11' => 11,
                'thg 12' => 12,
            ],
        ],
        'zh_CN' => [
            'pattern' => '~^(?P<year>\d{4})年(?P<month>.*?)(?P<day>\d{1,2})日$~',
            'months' => [
                '1月' => 1,
                '2月' => 2,
                '3月' => 3,
                '4月' => 4,
                '5月' => 5,
                '6月' => 6,
                '7月' => 7,
                '8月' => 8,
                '9月' => 9,
                '10月' => 10,
                '11月' => 11,
                '12月' => 12,
            ],
        ],
        'zh_HK' => [
            'pattern' => '~^(?P<year>\d{4})年(?P<month>.*?)(?P<day>\d{1,2})日$~',
            'months' => [
                '1月' => 1,
                '2月' => 2,
                '3月' => 3,
                '4月' => 4,
                '5月' => 5,
                '6月' => 6,
                '7月' => 7,
                '8月' => 8,
                '9月' => 9,
                '10月' => 10,
                '11月' => 11,
                '12月' => 12,
            ],
        ],
        'zh_TW' => [
            'pattern' => '~^(?P<year>\d{4})年(?P<month>.*?)(?P<day>\d{1,2})日$~',
            'months' => [
                '1月' => 1,
                '2月' => 2,
                '3月' => 3,
                '4月' => 4,
                '5月' => 5,
                '6月' => 6,
                '7月' => 7,
                '8月' => 8,
                '9月' => 9,
                '10月' => 10,
                '11月' => 11,
                '12月' => 12,
            ],
        ],
        'zu' => [
            'pattern' => '~^(?P<month>.*?)\s(?P<day>\d{1,2}),\s(?P<year>\d{4})$~',
            'months' => [
                'Jan' => 1,
                'Feb' => 2,
                'Mas' => 3,
                'Eph' => 4,
                'Mey' => 5,
                'Jun' => 6,
                'Jul' => 7,
                'Aga' => 8,
                'Sep' => 9,
                'Okt' => 10,
                'Nov' => 11,
                'Dis' => 12,
            ],
        ],
    ];

    /**
     * Convert a date as localized string to a \DateTimeInterface object depending on locale.
     *
     * @param string $locale   locale
     * @param string $dateText localized date
     *
     * @return \DateTimeInterface|null returns \DateTimeInterface or null if error
     */
    public static function formatted(string $locale, string $dateText): ?\DateTimeInterface
    {
        $locale = LocaleHelper::getNormalizeLocale($locale);

        if (!isset(self::MEDIUM_DATE_PATTERNS[$locale])) {
            return null;
        }
        $datePatternObj = self::MEDIUM_DATE_PATTERNS[$locale];

        if (isset($datePatternObj['convert'])) {
            $convertedText = forward_static_call($datePatternObj['convert'], $dateText);
            if ($convertedText !== false) {
                $dateText = (string) $convertedText;
            }
        }

        if (preg_match($datePatternObj['pattern'], $dateText, $match)) {
            $day = $match['day'];
            $month = $match['month'];
            $year = $match['year'];

            if (isset($datePatternObj['months'])) {
                if (!isset($datePatternObj['months'][$month])) {
                    throw new \RuntimeException(
                        'Error convert date. Locale ' . $locale . '. Date: ' . $dateText
                        . '. Matches: ' . var_export($match, true)
                    );
                }
                $month = $datePatternObj['months'][$month];
            }

            if (isset($datePatternObj['convertCalendar'])) {
                [$year, $month, $day] = forward_static_call($datePatternObj['convertCalendar'], $year, $month, $day);
            }

            $dateTime = \DateTimeImmutable::createFromFormat(
                'Y.m.d H:i:s',
                $year . '.' . $month . '.' . $day . ' 00:00:00',
                new \DateTimeZone('UTC')
            );

            if ($dateTime !== false) {
                return $dateTime;
            }
        }

        return null;
    }

    /**
     * @param string|int $unixTime
     *
     * @return \DateTimeInterface|null
     */
    public static function unixTimeToDateTime($unixTime): ?\DateTimeInterface
    {
        $dateTime = \DateTimeImmutable::createFromFormat(
            'U',
            (string) $unixTime,
            new \DateTimeZone('UTC')
        );

        return $dateTime === false ? null : $dateTime;
    }

    /**
     * @param string $str
     *
     * @return string
     */
    private static function convertBengaliNumbers(string $str): string
    {
        return str_replace(
            ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'],
            [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
            $str
        );
    }

    /**
     * @param string $str
     *
     * @return string
     */
    private static function convertFarsiNumbers(string $str): string
    {
        return str_replace(
            ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'],
            [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
            $str
        );
    }

    /**
     * @param int $persianYear
     * @param int $persianMonth
     * @param int $persianDay
     *
     * @return array
     */
    private static function convertPersianToGregorianCalendar(
        int $persianYear,
        int $persianMonth,
        int $persianDay
    ): array {
        $gregorianDaysInMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        $persianDaysInMonth = [31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29];
        $jy = $persianYear - 979;
        $jm = $persianMonth - 1;
        $jd = $persianDay - 1;
        $persianDayNo = 365 * $jy + floor($jy / 33) * 8 + floor(($jy % 33 + 3) / 4);
        for ($i = 0; $i < $jm; ++$i) {
            $persianDayNo += $persianDaysInMonth[$i];
        }
        $persianDayNo += $jd;
        $gregorianDayNo = $persianDayNo + 79;
        $gregorianYear = 1600 + 400 * floor($gregorianDayNo / 146097);
        $gregorianDayNo %= 146097;
        $leap = true;

        if ($gregorianDayNo >= 36525) {
            --$gregorianDayNo;
            $gregorianYear += 100 * floor($gregorianDayNo / 36524);
            $gregorianDayNo %= 36524;

            if ($gregorianDayNo >= 365) {
                ++$gregorianDayNo;
            } else {
                $leap = false;
            }
        }
        $gregorianYear += 4 * floor($gregorianDayNo / 1461);
        $gregorianDayNo %= 1461;

        if ($gregorianDayNo >= 366) {
            $leap = false;
            --$gregorianDayNo;
            $gregorianYear += floor($gregorianDayNo / 365);
            $gregorianDayNo %= 365;
        }
        for ($i = 0; $gregorianDayNo >= $gregorianDaysInMonth[$i] + ($i === 1 && $leap); ++$i) {
            $gregorianDayNo -= $gregorianDaysInMonth[$i] + ($i === 1 && $leap);
        }
        $gregorianMonth = $i + 1;
        $gregorianDay = $gregorianDayNo + 1;

        return [$gregorianYear, $gregorianMonth, $gregorianDay];
    }

    /**
     * @param string $str
     *
     * @return string
     */
    private static function convertMarathiNumbers(string $str): string
    {
        return str_replace(
            ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'],
            [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
            $str
        );
    }

    /**
     * @param string $str
     *
     * @return string
     */
    private static function convertBurmeseNumbers(string $str): string
    {
        return str_replace(
            ['၀', '၁', '၂', '၃', '၄', '၅', '၆', '၇', '၈', '၉'],
            [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
            $str
        );
    }

    /**
     * @param string $str
     *
     * @return string
     */
    private static function convertNepalNumbers(string $str): string
    {
        return str_replace(
            ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'],
            [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
            $str
        );
    }

    /**
     * @param int $year
     * @param int $month
     * @param int $day
     *
     * @return array
     */
    private static function convertThailandCalendar(int $year, int $month, int $day): array
    {
        return [$year - 543, $month, $day];
    }
}
