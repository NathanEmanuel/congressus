<?php

namespace Compucie\Congressus;

use Compucie\Congressus\models\ElasticMemberPagination;
use Compucie\Congressus\models\EventPagination;
use Compucie\Congressus\models\Member;
use Compucie\Congressus\request\Arguments;
use Compucie\Congressus\request\PathParameter;
use Compucie\Congressus\request\QueryParameter;
use Compucie\Congressus\request\Request;
use GuzzleHttp\Client as GuzzleHttpClient;

class Client extends GuzzleHttpClient
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

    // Members - raw

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

    // Members - custom

    public function retrieve_member_by_id(int|string $id): ?Member
    {
        $arguments = new Arguments();
        $arguments->add(PathParameter::obj_id, $id);
        return $this->retrieve_member($arguments);
    }

    public function retrieve_member_by_username(string $username): ?Member
    {
        $arguments = new Arguments();
        $arguments->add(QueryParameter::term, $username);
        $member_page = $this->search_members($arguments);
        foreach ($member_page as $member) {
            if ($member->username === $username) {
                return $this->retrieve_member_by_id($member->id);
            }
        }
        return null;
    }

    // Events - raw

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
