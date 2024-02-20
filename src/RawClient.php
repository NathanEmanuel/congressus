<?php

namespace Compucie\Congressus;

use Compucie\Congressus\Model\ElasticMemberPagination;
use Compucie\Congressus\Model\EventPagination;
use Compucie\Congressus\Model\GroupMembershipPagination;
use Compucie\Congressus\Model\GroupPagination;
use Compucie\Congressus\Model\Member;
use Compucie\Congressus\Model\MemberPagination;
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

    public function list_events(?Parameters $parameters = new Parameters()): EventPagination
    {
        $request = new Request("GET", "/v30/events", $parameters);
        $request->allow_parameters([
            Query::category_id,
            Query::period_filter,
            Query::published,
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

    public function list_products_folders(Parameters $parameters = new Parameters()): ProductFolderPagination
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
