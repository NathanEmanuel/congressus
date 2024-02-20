<?php

namespace Compucie\Congressus;

use Compucie\Congressus\Model\ElasticMemberPagination;
use Compucie\Congressus\Model\EventPagination;
use Compucie\Congressus\Model\Member;
use Compucie\Congressus\Request\Arguments;
use Compucie\Congressus\Request\PathParameter;
use Compucie\Congressus\Request\QueryParameter;
use Compucie\Congressus\Request\Request;
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

    public function retrieve_member(Arguments $arguments): Member
    {
        $request = new Request("GET", "/v30/members/{obj_id}", $arguments);
        $request->allow([
            PathParameter::obj_id,
            QueryParameter::context,
        ]);
        return $this->submit($request, new Member);
    }

    public function search_members(Arguments $arguments): ElasticMemberPagination
    {
        $request = new Request("GET", "/v30/members/search", $arguments);
        $request->allow([
            QueryParameter::term
        ]);
        return $this->submit($request, new ElasticMemberPagination);
    }


    // Events

    public function list_events(?Arguments $arguments = new Arguments()): EventPagination
    {
        $request = new Request("GET", "/v30/events", $arguments);
        $request->allow([
            QueryParameter::category_id,
            QueryParameter::period_filter,
            QueryParameter::published,
            QueryParameter::order,
        ]);
        return $this->submit($request, new EventPagination);
    }
}
