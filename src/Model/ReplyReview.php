<?php
declare(strict_types=1);

/**
 * @author   Ne-Lexa
 * @license  MIT
 * @link     https://github.com/Ne-Lexa/google-play-scraper
 */

namespace Nelexa\GPlay\Model;

/**
 * Contains the developer’s reply to a review in the Google Play Store.
 *
 * @see \Nelexa\GPlay\Model\Review Contains review of application on Google Play store.
 * @see \Nelexa\GPlay\GPlayApps::getAppReviews() Returns reviews of the
 *     Android app in the Google Play Store.
 */
class ReplyReview implements \JsonSerializable
{
    use JsonSerializableTrait;

    /** @var \DateTimeInterface Reply date. */
    private $date;

    /** @var string Reply text. */
    private $text;

    /**
     * Creates an object with information about the developer’s response
     * to a review of an application in the Google Play store.
     *
     * @param \DateTimeInterface $date Reply date.
     * @param string $text Reply text.
     */
    public function __construct(\DateTimeInterface $date, string $text)
    {
        $this->date = $date;
        $this->text = $text;
    }

    /**
     * Returns reply date.
     *
     * @return \DateTimeInterface Reply date.
     */
    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    /**
     * Returns reply text.
     *
     * @return string Reply text.
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Returns class properties as an array.
     *
     * @return array Class properties as an array.
     */
    public function asArray(): array
    {
        return [
            'date' => $this->date->format(\DateTimeInterface::RFC3339),
            'timestamp' => $this->date->getTimestamp(),
            'text' => $this->text,
        ];
    }
}
