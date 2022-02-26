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
 * Contains the developer’s reply to a review in the Google Play store.
 *
 * @see Review Contains review of application on Google Play store.
 * @see GPlayApps::getReviews() Returns reviews of the
 *     Android app in the Google Play store.
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
     * @param \DateTimeInterface $date reply date
     * @param string             $text reply text
     */
    public function __construct(\DateTimeInterface $date, string $text)
    {
        $this->date = $date;
        $this->text = $text;
    }

    /**
     * Returns reply date.
     *
     * @return \DateTimeInterface reply date
     */
    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    /**
     * Returns reply text.
     *
     * @return string reply text
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Returns class properties as an array.
     *
     * @return array class properties as an array
     */
    public function asArray(): array
    {
        return [
            'date' => $this->date->format(\DateTime::RFC3339),
            'timestamp' => $this->date->getTimestamp(),
            'text' => $this->text,
        ];
    }
}
