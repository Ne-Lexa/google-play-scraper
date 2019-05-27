<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Scraper;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Nelexa\GPlay\Exception\GooglePlayException;
use Nelexa\GPlay\GPlayApps;
use Nelexa\GPlay\Http\HttpClient;
use Nelexa\GPlay\Http\ResponseHandlerInterface;
use Nelexa\GPlay\Model\App;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class PlayStoreUiPagesScraper implements ResponseHandlerInterface
{
    private const RPC_ID = 'qnKhOb';

    /**
     * @var HttpClient
     */
    protected $httpClient;
    /**
     * @var int
     */
    protected $limit;
    /**
     * @var string
     */
    protected $locale;
    /**
     * @var string
     */
    protected $country;

    /**
     *  constructor.
     *
     * @param HttpClient $httpClient
     * @param int $count
     * @param string $locale
     * @param string $country
     */
    public function __construct(HttpClient $httpClient, int $count, string $locale, string $country)
    {
        $this->httpClient = $httpClient;
        $this->limit = $count;
        $this->locale = $locale;
        $this->country = $country;
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return App[]
     * @throws GooglePlayException
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response)
    {
        $scraper = new ClusterPageScraper();
        $apps = $scraper($request, $response);

        $countApps = count($apps);
        if ($countApps < $this->limit && $scraper->hasNextToken()) {
            $params = [
                'rpcids' => self::RPC_ID,
                GPlayApps::REQ_PARAM_LOCALE => $this->locale,
                GPlayApps::REQ_PARAM_COUNTRY => $this->country,
                'soc-app' => 121,
                'soc-platform' => 1,
                'soc-device' => 1,
            ];
            $playStoreUiUrl = GPlayApps::GOOGLE_PLAY_URL . '/_/PlayStoreUi/data/batchexecute?' . http_build_query($params);

            $savedApps = [$apps];
            while ($countApps < $this->limit && $scraper->hasNextToken()) {
                $limit = min(100, $this->limit - $countApps);
                $body = [
                    'f.req' => '[[["' . self::RPC_ID . '","[[null,[[10,[10,' . $limit . ']],true,null,[1]],null,\\"' . $scraper->getToken() . '\\"]]",null,"generic"]]]',
                ];

                /**
                 * @var PlayStoreUiScraper $scraper
                 */
                $scraper = new PlayStoreUiScraper();
                try {
                    $apps = $this->httpClient->request(
                        'POST',
                        $playStoreUiUrl,
                        [
                            RequestOptions::FORM_PARAMS => $body,
                            HttpClient::OPTION_HANDLER_RESPONSE => $scraper,
                        ]
                    );
                } catch (GuzzleException $e) {
                    throw new GooglePlayException($e->getMessage(), $e->getCode(), $e);
                }

                $countApps += count($apps);
                $savedApps[] = $apps;
            }
            $apps = array_merge(...$savedApps);
        }
        $apps = array_slice($apps, 0, $this->limit);
        return $apps;
    }
}
