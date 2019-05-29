<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Scraper;

use Nelexa\GPlay\Exception\GooglePlayException;
use Nelexa\GPlay\GPlayApps;
use Nelexa\GPlay\Http\ResponseHandlerInterface;
use Nelexa\GPlay\Model\Developer;
use Nelexa\GPlay\Model\GoogleImage;
use Nelexa\GPlay\Util\ScraperUtil;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use function GuzzleHttp\Psr7\parse_query;

class DeveloperInfoScraper implements ResponseHandlerInterface
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return mixed
     * @throws GooglePlayException
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response)
    {
        $url = $request->getUri()->__toString();
        $urlComponents = parse_url($url);
        $query = parse_query($urlComponents['query']);
        $developerId = $query[GPlayApps::REQ_PARAM_ID];
        $url = $urlComponents['scheme'] . '://'
            . $urlComponents['host']
            . $urlComponents['path']
            . '?' . http_build_query([GPlayApps::REQ_PARAM_ID => $developerId]);

        $scriptData = ScraperUtil::extractScriptData($response->getBody()->getContents());

        $scriptDataInfo = null;
        foreach ($scriptData as $key => $scriptValue) {
            if (isset($scriptValue[0][21])) {
                $scriptDataInfo = $scriptValue; // ds:5
                break;
            }
        }
        if ($scriptDataInfo === null) {
            throw (new GooglePlayException(sprintf(
                'Error parse vendor page %s. Need update library.',
                $request->getUri()
            )))->setUrl($request->getUri()->__toString());
        }

        $name = $scriptDataInfo[0][0][0];

        $headerImage = empty($scriptDataInfo[0][9][0][3][2]) ?
            null :
            new GoogleImage($scriptDataInfo[0][9][0][3][2]);
        $icon = empty($scriptDataInfo[0][9][1][3][2]) ?
            null :
            new GoogleImage($scriptDataInfo[0][9][1][3][2]);
        $developerSite = $scriptDataInfo[0][9][2][0][5][2] ?? null;
        $description = $scriptDataInfo[0][10][1][1] ?? '';

        return new Developer(
            Developer::newBuilder()
                ->setId($developerId)
                ->setUrl($url)
                ->setName($name)
                ->setDescription($description)
                ->setWebsite($developerSite)
                ->setIcon($icon)
                ->setHeaderImage($headerImage)
        );
    }
}
