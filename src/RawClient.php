<?php

namespace Compucie\Congressus;

use Compucie\Congressus\Model\ElasticMemberPagination;
use Compucie\Congressus\Model\EventPagination;
use Compucie\Congressus\Model\Member;
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

    public function retrieve_member(Parameters $arguments): Member
    {
        $request = new Request("GET", "/v30/members/{obj_id}", $arguments);
        $request->allow_parameter([
            Path::obj_id,
            Query::context,
        ]);
        return $this->submit($request, new Member);
    }

    public function search_members(Parameters $arguments): ElasticMemberPagination
    {
        $request = new Request("GET", "/v30/members/search", $arguments);
        $request->allow_parameter([
            Query::term
        ]);
        return $this->submit($request, new ElasticMemberPagination);
    }


    // Events

    public function list_events(?Parameters $arguments = new Parameters()): EventPagination
    {
        $request = new Request("GET", "/v30/events", $arguments);
        $request->allow_parameter([
            Query::category_id,
            Query::period_filter,
            Query::published,
            Query::order,
        ]);
        return $this->submit($request, new EventPagination);
    }
}
