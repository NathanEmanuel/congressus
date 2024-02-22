<?php

namespace Compucie\Congressus;

use Compucie\Congressus\Exception\NoNextPageException;
use Compucie\Congressus\Request\Request;
use GuzzleHttp\Client as GuzzleHttpClient;

class RawClient extends GuzzleHttpClient
{
    use RequestingMethodsTrait;

    public function __construct(string $token)
    {
        parent::__construct([
            'base_uri' => 'https://api.congressus.nl',
            'headers' => ["Authorization" => "Bearer {$token}"]
        ]);
    }

    /**
     * Submit request to the Congressus API and return the response as a page or as a data model object.
     * @param   Request $request    The request to submit
     * @param   mixed   $type       The data type of the response
     * @return  mixed               The response as a page or data model object
     */
    private function submit(Request $request, mixed $type): mixed
    {
        // do request
        $response = $this->send($request, $request->getOptions());
        $body = json_decode($response->getBody(), associative: true);

        // deserialize request
        $isPaginated = str_contains(get_class($type), "Pagination");
        if ($isPaginated) {
            $pagination = new $type($body);
            $get_calling_method = function () {
                return debug_backtrace()[2]["function"];
            };
            return new Page($pagination, $get_calling_method(), $request->getParameters());
        }
        return new $type($body);
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
            $parameters->page($page->getNextPage());
            return call_user_func(array($this, $page->getCaller()), $parameters);
        } else {
            throw new NoNextPageException();
        }
    }

    /**
     * Request subsequent pages.
     * @param   Page    $page   The current page
     * @param   int     $max    The maximum amount of pages to request
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
     * Request subsequent pages and return an array containing their data.
     * @param   Page    $page   The current page
     * @param   int     $max    The maximum amount of pages to request
     * @param   array   $array  Array to append the data to
     * @param   array           The data of the subsequent pages
     */
    public function nextPagesAsData(Page $page, int $max, array $array = array())
    {
        $pages = $this->nextPages($page, $max);
        foreach ($pages as $page) {
            $array = array_merge($array, $page->getData());
        }
        return $array;
    }
}
