<?php

declare(strict_types=1);

/**
 * @author   Ne-Lexa
 * @license  MIT
 *
 * @see      https://github.com/Ne-Lexa/google-play-scraper
 */

namespace Nelexa\GPlay\Scraper;

use Nelexa\GPlay\Exception\GooglePlayException;
use Nelexa\GPlay\GPlayApps;
use Nelexa\GPlay\Http\ResponseHandlerInterface;
use Nelexa\GPlay\Model\App;
use Nelexa\GPlay\Model\Developer;
use Nelexa\GPlay\Model\GoogleImage;
use Nelexa\GPlay\Util\ScraperUtil;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use function GuzzleHttp\Psr7\parse_query;

/**
 * @internal
 */
class CategoryAppsScraper implements ResponseHandlerInterface
{
    /**
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     *
     * @throws GooglePlayException
     *
     * @return App[]
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response)
    {
        $query = parse_query($request->getUri()->getQuery());
        $locale = $query[GPlayApps::REQ_PARAM_LOCALE] ?? GPlayApps::DEFAULT_LOCALE;
        $country = $query[GPlayApps::REQ_PARAM_COUNTRY] ?? GPlayApps::DEFAULT_COUNTRY;

        $xpath = $this->getXPath($response);
        $cardNodes = $xpath->query(
            "//div[@class and contains(concat(' ', normalize-space(@class), ' '), ' card ') and @data-docid]"
        );

        $apps = [];

        foreach ($cardNodes as $cardNode) {
            $apps[] = $this->extractApps($request, $xpath, $cardNode, $locale, $country);
        }

        return $apps;
    }

    /**
     * @param ResponseInterface $response
     *
     * @return \DOMXPath
     */
    private function getXPath(ResponseInterface $response): \DOMXPath
    {
        $domDocument = ScraperUtil::createDomDocument($response->getBody()->getContents());

        return new \DOMXPath($domDocument);
    }

    /**
     * @param RequestInterface $request
     * @param \DOMXPath        $xpath
     * @param \DOMElement      $cardNode
     * @param string           $locale
     * @param string           $country
     *
     * @throws GooglePlayException
     *
     * @return App
     */
    private function extractApps(
        RequestInterface $request,
        \DOMXPath $xpath,
        \DOMElement $cardNode,
        string $locale,
        string $country
    ): App {
        $appId = $cardNode->getAttribute('data-docid');

        $nodeTitle = $xpath->query('.//a[@class="title"]', $cardNode)->item(0);

        if ($nodeTitle === null) {
            throw (new GooglePlayException('Error parse app list'))
                ->setUrl($request->getUri()->__toString())
            ;
        }
        $name = trim($nodeTitle->attributes->getNamedItem('title')->textContent);

        $summary = $this->extractSummary($xpath, $cardNode);
        $developer = $this->extractDeveloper($request, $xpath, $cardNode);
        $icon = $this->extractIcon($request, $xpath, $cardNode);
        $price = $this->extractPrice($xpath, $cardNode);
        $score = $this->extractScore($xpath, $cardNode);

        return new App(
            App::newBuilder()
                ->setId($appId)
                ->setLocale($locale)
                ->setCountry($country)
                ->setName($name)
                ->setSummary($summary)
                ->setDeveloper($developer)
                ->setIcon($icon)
                ->setScore($score)
                ->setPriceText($price)
        );
    }

    /**
     * @param \DOMXPath   $xpath
     * @param \DOMElement $cardNode
     *
     * @return string|null
     */
    private function extractSummary(\DOMXPath $xpath, \DOMElement $cardNode): ?string
    {
        $descriptionNode = $xpath->query('.//div[@class="description"]', $cardNode)->item(0);

        if ($descriptionNode !== null) {
            return ScraperUtil::html2text($descriptionNode->textContent);
        }

        return null;
    }

    /**
     * @param RequestInterface $request
     * @param \DOMXPath        $xpath
     * @param \DOMElement      $cardNode
     *
     * @throws GooglePlayException
     *
     * @return Developer
     */
    private function extractDeveloper(RequestInterface $request, \DOMXPath $xpath, \DOMElement $cardNode): Developer
    {
        $developerNode = $xpath->query('.//a[@class="subtitle"]', $cardNode)->item(0);

        if ($developerNode === null) {
            throw (new GooglePlayException('Error parse app list developer node'))
                ->setUrl($request->getUri()->__toString())
            ;
        }
        $developerName = trim($developerNode->textContent);
        $developerUrl = GPlayApps::GOOGLE_PLAY_URL . $developerNode->attributes->getNamedItem('href')->textContent;
        $developerId = parse_query(parse_url($developerUrl, \PHP_URL_QUERY))[GPlayApps::REQ_PARAM_ID];

        return new Developer(
            Developer::newBuilder()
                ->setId($developerId)
                ->setUrl($developerUrl)
                ->setName($developerName)
        );
    }

    /**
     * @param RequestInterface $request
     * @param \DOMXPath        $xpath
     * @param \DOMElement      $cardNode
     *
     * @throws GooglePlayException
     *
     * @return GoogleImage
     */
    private function extractIcon(RequestInterface $request, \DOMXPath $xpath, \DOMElement $cardNode): GoogleImage
    {
        $iconNode = $xpath->query('.//img[@data-cover-large]/@src', $cardNode)->item(0);

        if ($iconNode === null) {
            throw (new GooglePlayException('Error parse app list icon node'))
                ->setUrl($request->getUri()->__toString())
            ;
        }
        $iconSrc = $iconNode->textContent;

        if (strpos($iconSrc, '//') === 0) {
            $iconSrc = 'https:' . $iconSrc;
        }
        $icon = new GoogleImage($iconSrc);
        $icon->reset();

        return $icon;
    }

    /**
     * @param \DOMXPath   $xpath
     * @param \DOMElement $cardNode
     *
     * @return string|null
     */
    private function extractPrice(\DOMXPath $xpath, \DOMElement $cardNode): ?string
    {
        $priceNode = $xpath->query('.//span[@class="display-price"]', $cardNode);

        if ($priceNode->length > 0) {
            $price = trim($priceNode->item(0)->textContent);

            if (!empty($price)) {
                return $price;
            }
        }

        return null;
    }

    /**
     * @param \DOMXPath   $xpath
     * @param \DOMElement $cardNode
     *
     * @return float
     */
    private function extractScore(\DOMXPath $xpath, \DOMElement $cardNode): float
    {
        $ratingStyleAttr = $xpath->query('.//div[@class="current-rating" and @style]/@style', $cardNode)->item(0);

        if ($ratingStyleAttr !== null) {
            $ratingStyle = $ratingStyleAttr->textContent;

            if (preg_match('/([\d\.]+)%/', $ratingStyle, $match)) {
                return round($match[1] * 0.05, 1); // percent * 5 star and round result
            }
        }

        return 0;
    }
}
