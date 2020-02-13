<?php

declare(strict_types=1);

/**
 * @author   Ne-Lexa
 * @license  MIT
 *
 * @see      https://github.com/Ne-Lexa/google-play-scraper
 */

namespace Nelexa\GPlay\Scraper;

use GuzzleHttp\Psr7\Request;
use Nelexa\GPlay\Enum\SortEnum;
use Nelexa\GPlay\GPlayApps;
use Nelexa\GPlay\Model\AppId;
use Psr\Http\Message\RequestInterface;
use function GuzzleHttp\Psr7\stream_for;

/**
 * @internal
 */
class PlayStoreUiRequest
{
    public const LIMIT_REVIEW_ON_PAGE = 199;

    public const LIMIT_APPS_ON_PAGE = 100;

    private const RPC_ID_REVIEWS = 'UsvDTd';

    private const RPC_ID_APPS = 'qnKhOb';

    private const RPC_ID_PERMISSIONS = 'xdSrCf';

    /**
     * @param AppId       $requestApp
     * @param int         $count
     * @param SortEnum    $sort
     * @param string|null $token
     *
     * @return RequestInterface
     */
    public static function getReviewsRequest(
        AppId $requestApp,
        int $count,
        SortEnum $sort,
        ?string $token = null
    ): RequestInterface {
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
            'f.req' => '[[["' . self::RPC_ID_REVIEWS . '","[null,null,[2,' . $sort->value(
                ) . ',[' . $limit . ',null,' . ($token === null ? 'null' : '\\"' . $token . '\\"') . ']],[\\"' . $requestApp->getId(
                ) . '\\",7]]",null,"generic"]]]',
        ];
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded;charset=utf-8',
        ];
        $body = stream_for(http_build_query($formParams));

        return new Request('POST', $url, $headers, $body);
    }

    /**
     * @param string $locale
     * @param string $country
     * @param int    $count
     * @param string $token
     *
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

        return new Request('POST', $url, $headers, $body);
    }

    /**
     * @param AppId $requestApp
     *
     * @throws \Exception
     *
     * @return RequestInterface
     */
    public static function getPermissionsRequest(AppId $requestApp): RequestInterface
    {
        $queryParams = [
            'rpcids' => self::RPC_ID_PERMISSIONS,
            GPlayApps::REQ_PARAM_LOCALE => $requestApp->getLocale(),
            GPlayApps::REQ_PARAM_COUNTRY => $requestApp->getCountry(),
            'soc-app' => 121,
            'soc-platform' => 1,
            'soc-device' => 1,
        ];
        $url = GPlayApps::GOOGLE_PLAY_URL . '/_/PlayStoreUi/data/batchexecute?' . http_build_query($queryParams);
        $formParams = [
            'f.req' => '[[["' . self::RPC_ID_PERMISSIONS . '","[[null,[\"' .
                $requestApp->getId() . '\",7],[]]]",null,"1"]]]',
        ];
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded;charset=utf-8',
        ];
        $body = stream_for(http_build_query($formParams));

        return new Request('POST', $url, $headers, $body);
    }
}
