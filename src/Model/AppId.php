<?php

declare(strict_types=1);

/**
 * @author   Ne-Lexa
 * @license  MIT
 *
 * @see      https://github.com/Ne-Lexa/google-play-scraper
 */

namespace Nelexa\GPlay\Model;

use Nelexa\GPlay\GPlayApps;
use Nelexa\GPlay\Util\LocaleHelper;

/**
 * Contains the application ID, as well as the locale and country for which the information was or will be obtained.
 *
 * This class is the base class for {@see App} and {@see AppInfo}.
 *
 * @see App Contains basic information about the application
 *     from the Google Play store.
 * @see AppInfo Contains detailed information about the
 *     application from the Google Play store.
 */
class AppId
{
    /** @var string Application ID (Android package name) */
    private $id;

    /** @var string Locale (site language) */
    private $locale;

    /**
     * @var string the country of the request for information about the
     *             application (affects the price and currency of paid applications
     *             and possibly their availability on the Google Play store)
     */
    private $country;

    /**
     * Creates an \Nelexa\GPlay\Model\AppId object.
     *
     * @param string $id      application ID (Android package name)
     * @param string $locale  Locale (ex. en_US, en-CA or en). Default is 'en_US'.
     * @param string $country Country (affects prices). Default is 'us'.
     */
    public function __construct(
        string $id,
        string $locale = GPlayApps::DEFAULT_LOCALE,
        string $country = GPlayApps::DEFAULT_COUNTRY
    ) {
        if (empty($id)) {
            throw new \InvalidArgumentException('Application ID cannot be empty');
        }
        $this->id = $id;
        $this->locale = LocaleHelper::getNormalizeLocale($locale);
        $this->country = $country;
    }

    /**
     * Returns the application ID (android package name).
     *
     * @return string application ID (android package name)
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Returns the locale (site language) for which the information was received.
     *
     * @return string Locale (ex. en_US, en-CA or en). Default is 'en_US'.
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * Returns the country of the request for information about the application.
     *
     * This parameter affects the price and currency of paid applications
     * and, possibly, the presence of an application in the Google Play store).
     *
     * @return string Country (affects prices). Default is 'us'.
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * Returns the URL of the application page in the Google Play store.
     *
     * @return string url of the app page in Google Play
     */
    public function getUrl(): string
    {
        return GPlayApps::GOOGLE_PLAY_APPS_URL . '/details?' . http_build_query(
            [
                GPlayApps::REQ_PARAM_ID => $this->id,
            ]
        );
    }

    /**
     * Returns the full URL of the app's page on Google Play, specifying
     * the locale and country of the request.
     *
     * @return string URL of the app's page on Google Play, specifying the
     *                locale and country of the request
     */
    public function getFullUrl(): string
    {
        return GPlayApps::GOOGLE_PLAY_APPS_URL . '/details?' . http_build_query(
            [
                GPlayApps::REQ_PARAM_ID => $this->id,
                GPlayApps::REQ_PARAM_LOCALE => $this->locale,
                GPlayApps::REQ_PARAM_COUNTRY => $this->country,
            ]
        );
    }
}
