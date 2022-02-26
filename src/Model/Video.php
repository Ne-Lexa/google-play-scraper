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

namespace Nelexa\GPlay\Model;

use Nelexa\GPlay\GPlayApps;

/**
 * Contains promo video data.
 *
 * @see GPlayApps::getAppsInfo() Returns detailed information about
 *     many android packages.
 * @see GPlayApps::getAppInLocales() Returns detailed information
 *     about an application from the Google Play store for an array of locales.
 * @see GPlayApps::getAppInfoForAvailableLocales() Returns detailed
 *     information about the application in all available locales.
 */
class Video implements \JsonSerializable
{
    use JsonSerializableTrait;

    /** @var string Video thumbnail url. */
    private $imageUrl;

    /** @var string Video url. */
    private $videoUrl;

    /**
     * Creates an object with information about the promo video for Android application.
     *
     * @param string $imageUrl video thumbnail url
     * @param string $videoUrl video url
     */
    public function __construct(string $imageUrl, string $videoUrl)
    {
        $this->imageUrl = $imageUrl;
        $this->videoUrl = $videoUrl;
    }

    /**
     * Returns the video thumbnail url.
     *
     * @return string image url
     */
    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    /**
     * Returns the video url.
     *
     * @return string video url
     */
    public function getVideoUrl(): string
    {
        return $this->videoUrl;
    }

    /**
     * Returns a YouTube id.
     *
     * @return string|null youTube ID or `null` if the video is not from YouTube
     */
    public function getYoutubeId(): ?string
    {
        if (preg_match(
            '~^.*(?:(?:youtu\.be/|v/|vi/|u/\w/|embed/)|(?:(?:watch)?\?v(?:i)?=|&v(?:i)?=))([^#&?]*).*~',
            $this->videoUrl,
            $match
        )) {
            return $match[1];
        }

        return null;
    }

    /**
     * Returns class properties as an array.
     *
     * @return array class properties as an array
     */
    public function asArray(): array
    {
        return [
            'thumbUrl' => $this->imageUrl,
            'videoUrl' => $this->videoUrl,
        ];
    }
}
