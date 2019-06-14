<?php
declare(strict_types=1);

/**
 * @author   Ne-Lexa
 * @license  MIT
 * @link     https://github.com/Ne-Lexa/google-play-scraper
 */

namespace Nelexa\GPlay\Model;

/**
 * Contains promo video data.
 *
 * @see \Nelexa\GPlay\GPlayApps::getApps() Returns detailed information about
 *     many android packages.
 * @see \Nelexa\GPlay\GPlayApps::getAppInLocales() Returns detailed information
 *     about an application from the Google Play store for an array of locales.
 * @see \Nelexa\GPlay\GPlayApps::getAppInAvailableLocales() Returns detailed
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
     * @param string $imageUrl Video thumbnail url.
     * @param string $videoUrl Video url.
     */
    public function __construct(string $imageUrl, string $videoUrl)
    {
        $this->imageUrl = $imageUrl;
        $this->videoUrl = $videoUrl;
    }

    /**
     * Returns the video thumbnail url.
     *
     * @return string Image url.
     */
    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    /**
     * Returns the video url.
     *
     * @return string Video url.
     */
    public function getVideoUrl(): string
    {
        return $this->videoUrl;
    }

    /**
     * Returns a YouTube id.
     *
     * @return string|null YouTube ID or `null` if the video is not from YouTube.
     */
    public function getYoutubeId(): ?string
    {
        if (preg_match('~^.*(?:(?:youtu\.be\/|v\/|vi\/|u\/\w\/|embed\/)|(?:(?:watch)?\?v(?:i)?=|\&v(?:i)?=))([^#\&\?]*).*~', $this->videoUrl, $match)) {
            return $match[1];
        }
        return null;
    }

    /**
     * Returns class properties as an array.
     *
     * @return array Class properties as an array.
     */
    public function asArray(): array
    {
        return [
            'thumbUrl' => $this->imageUrl,
            'videoUrl' => $this->videoUrl,
        ];
    }
}
