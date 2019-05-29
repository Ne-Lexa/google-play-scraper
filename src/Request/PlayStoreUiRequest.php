<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Request;

use GuzzleHttp\Psr7\Request;
use Nelexa\GPlay\Enum\SortEnum;
use Nelexa\GPlay\GPlayApps;
use Psr\Http\Message\RequestInterface;
use function GuzzleHttp\Psr7\stream_for;

class PlayStoreUiRequest
{
    public const LIMIT_REVIEW_ON_PAGE = 199;
    public const LIMIT_APPS_ON_PAGE = 100;

    private const RPC_ID_REVIEWS = 'UsvDTd';
    private const RPC_ID_APPS = 'qnKhOb';

    /**
     * @param RequestApp $requestApp
     * @param int $count
     * @param SortEnum $sort
     * @param string|null $token
     * @return RequestInterface
     */
    public static function getReviewsRequest(RequestApp $requestApp, int $count, SortEnum $sort, ?string $token = null): RequestInterface
    {
        $limit = min(self::LIMIT_REVIEW_ON_PAGE, max(1, $count));
        $queryParams = [
            'rpcids' => self::RPC_ID_REVIEWS,
            GPlayApps::REQ_PARAM_LOCALE => $requestApp->getLocale(),
            GPlayApps::REQ_PARAM_COUNTRY => $requestApp->getCountry(),
            'authuser' => null,
            'soc-app' => 121,
            'soc-platform' => 1,
            'soc-device' => 1,
        ];
        $url = GPlayApps::GOOGLE_PLAY_URL . '/_/PlayStoreUi/data/batchexecute?' . http_build_query($queryParams);
        $formParams = [
            'f.req' => '[[["' . self::RPC_ID_REVIEWS . '","[null,null,[2,' . $sort->value() . ',[' . $limit . ',null,' . ($token === null ? 'null' : '\\"' . $token . '\\"') . ']],[\\"' . $requestApp->getId() . '\\",7]]",null,"generic"]]]',
        ];
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded;charset=utf-8',
        ];
        $body = stream_for(http_build_query($formParams));
        return new Request('POST', $url, $headers, $body, '2.0');
    }

    /**
     * @param string $locale
     * @param string $country
     * @param int $count
     * @param string $token
     * @return RequestInterface
     */
    public static function getAppsRequest(string $locale, string $country, int $count, string $token): RequestInterface
    {
        $limit = min(self::LIMIT_APPS_ON_PAGE, max(1, $count));
        $queryParams = [
            'rpcids' => self::RPC_ID_APPS,
            GPlayApps::REQ_PARAM_LOCALE => $locale,
            GPlayApps::REQ_PARAM_COUNTRY => $country,
            'soc-app' => 121,
            'soc-platform' => 1,
            'soc-device' => 1,
        ];
        $url = GPlayApps::GOOGLE_PLAY_URL . '/_/PlayStoreUi/data/batchexecute?' . http_build_query($queryParams);
        $formParams = [
            'f.req' => '[[["' . self::RPC_ID_APPS . '","[[null,[[10,[10,' . $limit . ']],true,null,[1]],null,\\"' . $token . '\\"]]",null,"generic"]]]',
        ];
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded;charset=utf-8',
        ];
        $body = stream_for(http_build_query($formParams));
        return new Request('POST', $url, $headers, $body, '2.0');
    }
}
