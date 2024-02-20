<?php

namespace Compucie\Congressus;

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
        $response = $this->send($request, $request->get_options());
        $data = json_decode($response->getBody(), associative: true);
        return new $type($data);
    }


    // Members

    public function list_members(Parameters $parameters = new Parameters()): MemberPagination
    {
        $request = new Request("GET", "/v30/members", $parameters);
        $request->allow_parameters([
            Query::status_id,
            Query::socie_app_id,
            Query::page,
            Query::page_size,
            Query::order,
            Query::context,
        ]);
        return $this->submit($request, new MemberPagination);
    }

    public function retrieve_member(Parameters $parameters): Member
    {
        $request = new Request("GET", "/v30/members/{obj_id}", $parameters);
        $request->allow_parameters([
            Path::obj_id,
            Query::context,
        ]);
        return $this->submit($request, new Member);
    }

    public function search_members(Parameters $parameters): ElasticMemberPagination
    {
        $request = new Request("GET", "/v30/members/search", $parameters);
        $request->allow_parameters([
            Query::term
        ]);
        return $this->submit($request, new ElasticMemberPagination);
    }


    // Groups

    public function list_groups(Parameters $parameters = new Parameters()): GroupPagination
    {
        $request = new Request("GET", "/v30/groups", $parameters);
        $request->allow_parameters([
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

    public function list_group_memberships(Parameters $parameters = new Parameters()): GroupMembershipPagination
    {
        $request = new Request("GET", "/v30/groups/memberships", $parameters);
        $request->allow_parameters([
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
    public function list_events(Parameters $parameters = new Parameters()): EventPagination
    {
        // hook into the given parameters to format the period_filter correctly
        $period_filter_hook = function (Parameters $parameters) {
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

        $parameters = $period_filter_hook($parameters);

        // submit request
        $request = new Request("GET", "/v30/events", $parameters);
        $request->allow_parameters([
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

    public function list_products(Parameters $parameters = new Parameters()): ProductPagination
    {
        $request = new Request("GET", "/v30/products", $parameters);
        $request->allow_parameters([
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

    public function list_product_folders_recursive(Parameters $parameters = new Parameters()): ProductFolderListRecursivePagination
    {
        $request = new Request("GET", "/v30/product-folders/recursive", $parameters);
        $request->allow_parameters([
            Query::published,
            Query::parent_id,
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new ProductFolderListRecursivePagination);
    }

    public function list_product_folders(Parameters $parameters = new Parameters()): ProductFolderPagination
    {
        $request = new Request("GET", "/v30/product-folders", $parameters);
        $request->allow_parameters([
            Query::published,
            Query::parent_id,
            Query::page,
            Query::page_size,
            Query::order,
        ]);
        return $this->submit($request, new ProductFolderPagination);
    }
}
