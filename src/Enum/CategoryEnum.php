<?php

/** @noinspection PhpUnusedPrivateFieldInspection */
declare(strict_types=1);

/**
 * @author   Ne-Lexa
 * @license  MIT
 *
 * @see      https://github.com/Ne-Lexa/google-play-scraper
 */

namespace Nelexa\GPlay\Enum;

use Nelexa\Enum;

/**
 * Contains all valid application category values.
 *
 * @method static CategoryEnum GAME()                Returns the category id 'Games'.
 * @method static CategoryEnum FAMILY()              Returns the category id 'Family'.
 * @method static CategoryEnum ART_AND_DESIGN()      Returns the category id 'Art & Design'.
 * @method static CategoryEnum AUTO_AND_VEHICLES()   Returns the category id 'Auto & Vehicles'.
 * @method static CategoryEnum BEAUTY()              Returns the category id 'Beauty'.
 * @method static CategoryEnum BOOKS_AND_REFERENCE() Returns the category id 'Books & Reference'.
 * @method static CategoryEnum BUSINESS()            Returns the category id 'Business'.
 * @method static CategoryEnum COMICS()              Returns the category id 'Comics'.
 * @method static CategoryEnum COMMUNICATION()       Returns the category id 'Communication'.
 * @method static CategoryEnum DATING()              Returns the category id 'Dating'.
 * @method static CategoryEnum EDUCATION()           Returns the category id 'Education'.
 * @method static CategoryEnum ENTERTAINMENT()       Returns the category id 'Entertainment'.
 * @method static CategoryEnum EVENTS()              Returns the category id 'Events'.
 * @method static CategoryEnum FINANCE()             Returns the category id 'Finance'.
 * @method static CategoryEnum FOOD_AND_DRINK()      Returns the category id 'Food & Drink'.
 * @method static CategoryEnum HEALTH_AND_FITNESS()  Returns the category id 'Health & Fitness'.
 * @method static CategoryEnum HOUSE_AND_HOME()      Returns the category id 'House & Home'.
 * @method static CategoryEnum LIBRARIES_AND_DEMO()  Returns the category id 'Libraries & Demo'.
 * @method static CategoryEnum LIFESTYLE()           Returns the category id 'Lifestyle'.
 * @method static CategoryEnum MAPS_AND_NAVIGATION() Returns the category id 'Maps & Navigation'.
 * @method static CategoryEnum MEDICAL()             Returns the category id 'Medical'.
 * @method static CategoryEnum MUSIC_AND_AUDIO()     Returns the category id 'Music & Audio'.
 * @method static CategoryEnum NEWS_AND_MAGAZINES()  Returns the category id 'News & Magazines'.
 * @method static CategoryEnum PARENTING()           Returns the category id 'Parenting'.
 * @method static CategoryEnum PERSONALIZATION()     Returns the category id 'Personalization'.
 * @method static CategoryEnum PHOTOGRAPHY()         Returns the category id 'Photography'.
 * @method static CategoryEnum PRODUCTIVITY()        Returns the category id 'Productivity'.
 * @method static CategoryEnum SHOPPING()            Returns the category id 'Shopping'.
 * @method static CategoryEnum SOCIAL()              Returns the category id 'Social'.
 * @method static CategoryEnum SPORTS()              Returns the category id 'Sports'.
 * @method static CategoryEnum TOOLS()               Returns the category id 'Tools'.
 * @method static CategoryEnum TRAVEL_AND_LOCAL()    Returns the category id 'Travel & Local'.
 * @method static CategoryEnum VIDEO_PLAYERS()       Returns the category id 'Video Players & Editors'.
 * @method static CategoryEnum ANDROID_WEAR()        Returns the category id 'Wear OS by Google'.
 * @method static CategoryEnum WEATHER()             Returns the category id 'Weather'.
 * @method static CategoryEnum GAME_ACTION()         Returns the category id 'Action'.
 * @method static CategoryEnum GAME_ADVENTURE()      Returns the category id 'Adventure'.
 * @method static CategoryEnum GAME_ARCADE()         Returns the category id 'Arcade'.
 * @method static CategoryEnum GAME_BOARD()          Returns the category id 'Board'.
 * @method static CategoryEnum GAME_CARD()           Returns the category id 'Card'.
 * @method static CategoryEnum GAME_CASINO()         Returns the category id 'Casino'.
 * @method static CategoryEnum GAME_CASUAL()         Returns the category id 'Casual'.
 * @method static CategoryEnum GAME_EDUCATIONAL()    Returns the category id 'Educational'.
 * @method static CategoryEnum GAME_MUSIC()          Returns the category id 'Music'.
 * @method static CategoryEnum GAME_PUZZLE()         Returns the category id 'Puzzle'.
 * @method static CategoryEnum GAME_RACING()         Returns the category id 'Racing'.
 * @method static CategoryEnum GAME_ROLE_PLAYING()   Returns the category id 'Role Playing'.
 * @method static CategoryEnum GAME_SIMULATION()     Returns the category id 'Simulation'.
 * @method static CategoryEnum GAME_SPORTS()         Returns the category id 'Sports'.
 * @method static CategoryEnum GAME_STRATEGY()       Returns the category id 'Strategy'.
 * @method static CategoryEnum GAME_TRIVIA()         Returns the category id 'Trivia'.
 * @method static CategoryEnum GAME_WORD()           Returns the category id 'Word'.
 * @method static CategoryEnum FAMILY_ACTION()       Returns the category id 'Family Action & Adventure'.
 * @method static CategoryEnum FAMILY_BRAINGAMES()   Returns the category id 'Family Brain Games'.
 * @method static CategoryEnum FAMILY_CREATE()       Returns the category id 'Creativity'.
 * @method static CategoryEnum FAMILY_EDUCATION()    Returns the category id 'Education'.
 * @method static CategoryEnum FAMILY_MUSICVIDEO()   Returns the category id 'Family Music and Video'.
 * @method static CategoryEnum FAMILY_PRETEND()      Returns the category id 'Pretend play'.
 */
class CategoryEnum extends Enum
{
    private const GAME = 'GAME';

    private const FAMILY = 'FAMILY';

    private const ART_AND_DESIGN = 'ART_AND_DESIGN';

    private const AUTO_AND_VEHICLES = 'AUTO_AND_VEHICLES';

    private const BEAUTY = 'BEAUTY';

    private const BOOKS_AND_REFERENCE = 'BOOKS_AND_REFERENCE';

    private const BUSINESS = 'BUSINESS';

    private const COMICS = 'COMICS';

    private const COMMUNICATION = 'COMMUNICATION';

    private const DATING = 'DATING';

    private const EDUCATION = 'EDUCATION';

    private const ENTERTAINMENT = 'ENTERTAINMENT';

    private const EVENTS = 'EVENTS';

    private const FINANCE = 'FINANCE';

    private const FOOD_AND_DRINK = 'FOOD_AND_DRINK';

    private const HEALTH_AND_FITNESS = 'HEALTH_AND_FITNESS';

    private const HOUSE_AND_HOME = 'HOUSE_AND_HOME';

    private const LIBRARIES_AND_DEMO = 'LIBRARIES_AND_DEMO';

    private const LIFESTYLE = 'LIFESTYLE';

    private const MAPS_AND_NAVIGATION = 'MAPS_AND_NAVIGATION';

    private const MEDICAL = 'MEDICAL';

    private const MUSIC_AND_AUDIO = 'MUSIC_AND_AUDIO';

    private const NEWS_AND_MAGAZINES = 'NEWS_AND_MAGAZINES';

    private const PARENTING = 'PARENTING';

    private const PERSONALIZATION = 'PERSONALIZATION';

    private const PHOTOGRAPHY = 'PHOTOGRAPHY';

    private const PRODUCTIVITY = 'PRODUCTIVITY';

    private const SHOPPING = 'SHOPPING';

    private const SOCIAL = 'SOCIAL';

    private const SPORTS = 'SPORTS';

    private const TOOLS = 'TOOLS';

    private const TRAVEL_AND_LOCAL = 'TRAVEL_AND_LOCAL';

    private const VIDEO_PLAYERS = 'VIDEO_PLAYERS';

    private const ANDROID_WEAR = 'ANDROID_WEAR';

    private const WEATHER = 'WEATHER';

    private const GAME_ACTION = 'GAME_ACTION';

    private const GAME_ADVENTURE = 'GAME_ADVENTURE';

    private const GAME_ARCADE = 'GAME_ARCADE';

    private const GAME_BOARD = 'GAME_BOARD';

    private const GAME_CARD = 'GAME_CARD';

    private const GAME_CASINO = 'GAME_CASINO';

    private const GAME_CASUAL = 'GAME_CASUAL';

    private const GAME_EDUCATIONAL = 'GAME_EDUCATIONAL';

    private const GAME_MUSIC = 'GAME_MUSIC';

    private const GAME_PUZZLE = 'GAME_PUZZLE';

    private const GAME_RACING = 'GAME_RACING';

    private const GAME_ROLE_PLAYING = 'GAME_ROLE_PLAYING';

    private const GAME_SIMULATION = 'GAME_SIMULATION';

    private const GAME_SPORTS = 'GAME_SPORTS';

    private const GAME_STRATEGY = 'GAME_STRATEGY';

    private const GAME_TRIVIA = 'GAME_TRIVIA';

    private const GAME_WORD = 'GAME_WORD';

    private const FAMILY_ACTION = 'FAMILY_ACTION';

    private const FAMILY_BRAINGAMES = 'FAMILY_BRAINGAMES';

    private const FAMILY_CREATE = 'FAMILY_CREATE';

    private const FAMILY_EDUCATION = 'FAMILY_EDUCATION';

    private const FAMILY_MUSICVIDEO = 'FAMILY_MUSICVIDEO';

    private const FAMILY_PRETEND = 'FAMILY_PRETEND';
}
