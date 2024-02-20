<?php

namespace Compucie\Congressus;

use Compucie\Congressus\Model\ElasticMemberPagination;
use Compucie\Congressus\Model\EventPagination;
use Compucie\Congressus\Model\Member;
use Compucie\Congressus\Model\MemberPagination;
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
}
