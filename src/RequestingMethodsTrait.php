<?php

namespace Compucie\Congressus;

use Compucie\Congressus\Model;
use Compucie\Congressus\Page;
use Compucie\Congressus\Request\Parameters;
use Compucie\Congressus\Request\ParameterType\Path;
use Compucie\Congressus\Request\ParameterType\Query;
use Compucie\Congressus\Request\Request;

trait RequestingMethodsTrait
{
    /*
        -------------------- Members --------------------
    */

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
        return $this->submit($request, new Model\MemberPagination);
    }

    public function retrieveMember(Parameters $parameters): Model\Member
    {
        $request = new Request("GET", "/v30/members/{obj_id}", $parameters);
        $request->allowParameters([
            Path::obj_id,
            Query::context,
        ]);
        return $this->submit($request, new Model\Member);
    }

    public function searchMembers(Parameters $parameters): Page
    {
        $request = new Request("GET", "/v30/members/search", $parameters);
        $request->allowParameters([
            Query::term
        ]);
        return $this->submit($request, new Model\ElasticMemberPagination);
    }


    /*
        -------------------- Groups --------------------
    */

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
        return $this->submit($request, new Model\GroupPagination);
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
        return $this->submit($request, new Model\GroupMembershipPagination);
    }


    /*
        -------------------- Events --------------------
    */

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
        return $this->submit($request, new Model\EventPagination);
    }

    /*
        -------------------- Products --------------------
    */

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
        return $this->submit($request, new Model\ProductPagination);
    }

    /*
        -------------------- Product folders --------------------
    */

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
        return $this->submit($request, new Model\ProductFolderListRecursivePagination);
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
        return $this->submit($request, new Model\ProductFolderPagination);
    }
}
