<?php

namespace Compucie\Congressus;

use Compucie\Congressus\Request;
use GuzzleHttp\Client as GuzzleHttpClient;

class RawClient extends GuzzleHttpClient
{
    use CustomRequestingMethodsTrait;
    use GeneratedRequestingMethodsTrait;

    private const DEFAULT_PAGE_SIZE = 25;

    public function __construct(string $token)
    {
        parent::__construct([
            'base_uri' => 'https://api.congressus.nl',
            'headers' => ["Authorization" => "Bearer {$token}"]
        ]);
    }

    /**
     * Submit a request to the Congressus API and return the response as an (array of) data model object(s) or as a page.
     * @param   Request     $request    Request to submit.
     * @param   string      $type       Data type of the response.
     * @return  mixed                   Response as a data model object, data model object array, or page.
     */
    private function submit(Request $request, string $type = null): mixed
    {
        $request->finalize();
        $response = $this->send($request, $request->getOptions());

        if (is_null($type)) {
            return null;
        } else {
            $body = json_decode($response->getBody(), associative: true);
            return ObjectSerializer::deserialize($body, $type);
        }
    }

    /**
     * Download a file to the given file system location.
     * @param   Request $request    The request to submit.
     * @param   string  $filePath   The location where to save the file.
     */
    private function download(Request $request, string $filePath): void
    {
        $resource = \GuzzleHttp\Psr7\Utils::tryFopen($filePath, 'w');
        $stream = \GuzzleHttp\Psr7\Utils::streamFor($resource);
        $this->request($request->getMethod(), $request->getPath(), ["sink" => $stream]); // send() does not seem to work
    }

    private static function isRequestingAllowed($page, int $limit): bool
    {
        if (is_null($page)) {
            return true;
        }

        if (!$page->getHasNext()) {
            return false;
        }

        if (($page->getPrevNum() + 1) * self::DEFAULT_PAGE_SIZE > $limit) {
            return false;
        }

        return true;
    }

    /**
     * Return a formatted period suitable for the API based on a start and/or end timestamp.
     * @param   int     $period_start   Start of filter period in Unix time
     * @param   int     $period_end     End of filter period in Unix time
     * @return  string                  Period string representation suitable for the API
     */
    public static function formatPeriod(int $period_start = null, int $period_end = null,): string
    {
        return match (true) {
            !is_null($period_start) && !is_null($period_end) => date("Ymd", $period_start) . ".." . date("Ymd", $period_end),
            !is_null($period_start) && is_null($period_end) => date("Ymd", time()) . ".." . date("Ymd", 2147483647),
            is_null($period_start) && !is_null($period_end) => date("Ymd", 0) . ".." . date("Ymd", $period_end),
        };
    }
}
