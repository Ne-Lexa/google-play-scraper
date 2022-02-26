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
 * Contains the title and link to the cluster page.
 *
 * @see GPlayApps::getClusterPages() Returns an iterator of cluster pages.
 * @see GPlayApps::getClusterApps() Returns an iterator of applications from the Google Play store for the specified cluster page.
 */
class ClusterPage
{
    /** @var string title cluster page */
    private $title;

    /** @var string cluster page url */
    private $url;

    /**
     * Creates an object with information about the cluster page.
     *
     * @param string $title cluster page title
     * @param string $url   cluster page url
     */
    public function __construct(string $title, string $url)
    {
        $this->title = $title;
        $this->url = $url;
    }

    /**
     * Returns the cluster page title.
     *
     * @return string cluster page title
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Returns the cluster page url.
     *
     * @return string cluster page url
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}
