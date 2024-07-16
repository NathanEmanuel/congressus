<?php

namespace Compucie\Congressus;

use Compucie\Congressus\Exception\NoNextPageException;
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
        $isPaginated = str_contains(get_class($responseType), "Pagination");
        if ($isPaginated) {
            $get_calling_method = function () {
                return debug_backtrace()[2]["function"];
            };
            return new Page(get_class($responseType), $responseBody, $get_calling_method(), $request->getArgs());
        }
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

    /**
     * Request next page.
     * @param   Page                $page   The current page
     * @return  Page                        The next page
     * @throws  NoNextPageException
     */
    public function nextPage(Page $page): Page
    {
        if ($page->hasNext()) {
            $parameters = $page->getParameters();
            $parameters["page"] = $page->getNextPageNumber();
            return call_user_func(array($this, $page->getCaller()), ...$parameters);
        } else {
            throw new NoNextPageException();
        }
    }

    /**
     * Request subsequent pages.
     * @param   Page    $page   The current page
     * @param   int     $max    The maximum amount of pages to request
     * @return  Page[]          Array of the subsequent pages
     */
    public function nextPages(Page $page, int $max): array
    {
        $pages = array();
        for ($i = 0; $i < $max; $i++) {
            try {
                $page = $this->nextPage($page);
                array_push($pages, $page);
            } catch (NoNextPageException) {
                break;
            }
        }
        return $pages;
    }

    /**
     * Request subsequent pages and add their data to the data array.
     * @param   array   $data   Data array.
     * @param   Page    $page   The current page.
     * @param   int     $max    The maximum amount of pages to request.
     */
    public function addDataFromNextPages(array &$data, Page $page, int $max): void
    {
        $pages = $this->nextPages($page, $max);
        foreach ($pages as $page) {
            $data = array_merge($data, $page->getData());
        }
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
