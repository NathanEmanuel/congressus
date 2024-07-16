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
     * Submit request to the Congressus API and return the response as a page or as a data model object.
     * @param   Request $request        The request to submit
     * @param   mixed   $responseType   The data type of the response
     * @return  mixed                   The response as a page or data model object
     */
    private function submit(Request $request, mixed $responseType = null): mixed
    {
        // do request
        $request->finalize();
        $response = $this->send($request, $request->getOptions());
        $responseBody = json_decode($response->getBody(), associative: true);

        // ignore response
        if (is_null($responseType)) {
            return null;
        }

        // deserialize response
        return ObjectSerializer::deserialize($responseBody, get_class($responseType));
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

    private function isRequestingAllowed($page, int $limit): bool
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
}
