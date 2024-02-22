<?php

namespace Compucie\Congressus;

use Compucie\Congressus\Exception\NoNextPageException;
use Compucie\Congressus\Model\ElasticMemberPagination;
use Compucie\Congressus\Model\EventPagination;
use Compucie\Congressus\Model\GroupMembershipPagination;
use Compucie\Congressus\Model\GroupPagination;
use Compucie\Congressus\Model\Member;
use Compucie\Congressus\Model\MemberPagination;
use Compucie\Congressus\Model\ProductFolderListRecursivePagination;
use Compucie\Congressus\Model\ProductFolderPagination;
use Compucie\Congressus\Model\ProductPagination;
use Compucie\Congressus\Request\Request;
use Compucie\Congressus\Request\Parameters;
use Compucie\Congressus\Request\ParameterType\Path;
use Compucie\Congressus\Request\ParameterType\Query;
use GuzzleHttp\Client as GuzzleHttpClient;

class RawClient extends GuzzleHttpClient
{
    public function __construct(string $token)
    {
        parent::__construct([
            'base_uri' => 'https://api.congressus.nl',
            'headers' => ["Authorization" => "Bearer {$token}"]
        ]);
    }

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
     * @return  Page                The next page
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
     * Request all subsequent pages.
     */
    public function nextPages(Page $page, int $max): array
    {
        $pages = array();
        for ($i=0; $i < $max; $i++) {
            try {
                $page = $this->nextPage($page);
                array_push($pages, $page);
            } catch (NoNextPageException) {
                break;
            }
        }
        return $pages;
    }


    // Members

    public function listMembers(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/members", $parameters);
        $request->allowParameters([
            Query::status_id,
            Query::socie_app_id,
            Query::page,
            Query::page_size,
            Query::order,
            Query::context,
        ]);
        return $this->submit($request, new MemberPagination);
    }

    public function retrieveMember(Parameters $parameters): Member
    {
        $request = new Request("GET", "/v30/members/{obj_id}", $parameters);
        $request->allowParameters([
            Path::obj_id,
            Query::context,
        ]);
        return $this->submit($request, new Member);
    }

    public function searchMembers(Parameters $parameters): Page
    {
        $request = new Request("GET", "/v30/members/search", $parameters);
        $request->allowParameters([
            Query::term
        ]);
        return $this->submit($request, new ElasticMemberPagination);
    }


    // Groups

    public function listGroups(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/groups", $parameters);
        $request->allowParameters([
            Query::published,
            Query::folder_id,
            Query::member_id,
            Query::socie_app_id,
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new GroupPagination);
    }

    public function listGroupMemberships(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/groups/memberships", $parameters);
        $request->allowParameters([
            Query::group_id,
            Query::member_id,
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new GroupMembershipPagination);
    }


    // Events

    /**
     * @param   array   period_filter   Array containing the start and end of the period
     */
    public function listEvents(Parameters $parameters = new Parameters()): Page
    {
        // hook into the given parameters to format the period_filter correctly
        $formatPeriodFilter = function (Parameters $parameters) {
            $period = $parameters->get(Query::period_filter);
            if (is_null($period)) {
                return $parameters; // filter_period parameter not set
            }

            $period_start = $period[0] ?? null;
            $period_end = $period[1] ?? null;
            if (!is_null($period_start) && !is_null($period_end)) {
                $value = date("Ymd", $period_start) . ".." . date("Ymd", $period_end);
            } elseif (is_null($period_start) && !is_null($period_end)) {
                $value = date("Ymd", 0) . ".." . date("Ymd", $period_end);
            } elseif (!is_null($period_start) && is_null($period_end)) {
                $value = date("Ymd", time()) . ".." . date("Ymd", 2147483647);
            } else {
                throw new \InvalidArgumentException("period_filter needs to be a (partially null) array containing the start and end of the period");
            }
            $parameters->add(Query::period_filter, $value);
            return $parameters;
        };

        $parameters = $formatPeriodFilter($parameters);

        // submit request
        $request = new Request("GET", "/v30/events", $parameters);
        $request->allowParameters([
            Query::category_id,
            Query::period_filter,
            Query::published,
            Query::participation_billing_enabled,
            Query::participating_member_id,
            Query::socie_app_id,
            Query::member_id,
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new EventPagination);
    }


    // Products

    public function listProducts(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/products", $parameters);
        $request->allowParameters([
            Query::published,
            Query::status,
            Query::folder_id,
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new ProductPagination);
    }


    // Product folders

    public function listProductFoldersRecursive(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/product-folders/recursive", $parameters);
        $request->allowParameters([
            Query::published,
            Query::parent_id,
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new ProductFolderListRecursivePagination);
    }

    public function listProductFolders(Parameters $parameters = new Parameters()): Page
    {
        $request = new Request("GET", "/v30/product-folders", $parameters);
        $request->allowParameters([
            Query::published,
            Query::parent_id,
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new ProductFolderPagination);
    }
}
