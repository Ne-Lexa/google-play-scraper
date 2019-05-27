<?php
declare(strict_types=1);

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

class ListScraper implements ResponseHandlerInterface
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return App[]
     * @throws GooglePlayException
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response)
    {
        $doc = new \DOMDocument();
        $internalErrors = libxml_use_internal_errors(true);
        if (!$doc->loadHTML('<?xml encoding="utf-8" ?>' . $response->getBody()->getContents())) {
            throw new \RuntimeException('error load html');
        }
        libxml_use_internal_errors($internalErrors);

        $xpath = new \DOMXPath($doc);
        $cardNodes = $xpath->query("//div[@class and contains(concat(' ', normalize-space(@class), ' '), ' card ') and @data-docid]");

        $apps = [];
        /**
         * @var \DOMElement $cardNode
         */
        foreach ($cardNodes as $cardNode) {
            {
                $appId = $cardNode->getAttribute('data-docid');
            }

            {
                $nodeTitle = $xpath->query('.//a[@class="title"]', $cardNode)->item(0);
                if ($nodeTitle === null) {
                    throw (new GooglePlayException('Error parse app list'))
                        ->setUrl($request->getUri()->__toString());
                }
                $url = GPlayApps::GOOGLE_PLAY_URL . $nodeTitle->attributes->getNamedItem('href')->textContent;
                $name = trim($nodeTitle->attributes->getNamedItem('title')->textContent);
            }

            {
                $descriptionNode = $xpath->query('.//div[@class="description"]', $cardNode)->item(0);
                $summary = null;
                if ($descriptionNode !== null) {
                    $summary = ScraperUtil::html2text($descriptionNode->textContent);
                }
            }

            {
                $developerNode = $xpath->query('.//a[@class="subtitle"]', $cardNode)->item(0);
                if ($developerNode === null) {
                    throw (new GooglePlayException('Error parse app list developer node'))
                        ->setUrl($request->getUri()->__toString());
                }
                $developerName = trim($developerNode->textContent);
                $developerUrl = GPlayApps::GOOGLE_PLAY_URL . $developerNode->attributes->getNamedItem('href')->textContent;
                $developerId = parse_query(parse_url($developerUrl, PHP_URL_QUERY))[GPlayApps::REQ_PARAM_APP_ID];
            }

            {
                $iconNode = $xpath->query('.//img[@data-cover-large]/@src', $cardNode)->item(0);
                if ($iconNode === null) {
                    throw (new GooglePlayException('Error parse app list icon node'))
                        ->setUrl($request->getUri()->__toString());
                }
                $icon = new GoogleImage('https:' . $iconNode->textContent);
                $icon->reset();
            }

            {
                $price = null;
                $priceNode = $xpath->query('.//span[@class="display-price"]', $cardNode);
                if ($priceNode->count()) {
                    $price = trim($priceNode->item(0)->textContent);
                    if (empty($price)) {
                        $price = null;
                    }
                }
            }

            {
                $score = 0;
                $ratingStyleAttr = $xpath->query('.//div[@class="current-rating" and @style]/@style', $cardNode)->item(0);
                if ($ratingStyleAttr !== null) {
                    $ratingStyle = $ratingStyleAttr->textContent;
                    if (preg_match('/([\d\.]+)%/', $ratingStyle, $match)) {
                        $score = round($match[1] * 0.05, 1); // percent * 5 star and round result
                    }
                }
            }

            $locale = parse_query($request->getUri()->getQuery())[GPlayApps::REQ_PARAM_LOCALE] ?? GPlayApps::DEFAULT_LOCALE;

            $apps[] = new App(
                App::newBuilder()
                    ->setId($appId)
                    ->setUrl($url)
                    ->setLocale($locale)
                    ->setName($name)
                    ->setSummary($summary)
                    ->setDeveloper(
                        new Developer(
                            Developer::newBuilder()
                                ->setId($developerId)
                                ->setUrl($developerUrl)
                                ->setName($developerName)
                        )
                    )
                    ->setIcon($icon)
                    ->setScore($score)
                    ->setPriceText($price)
            );
        }
        return $apps;
    }
}
