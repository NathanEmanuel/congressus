<?php

use Psr\Http\Message\ResponseInterface;

require_once '../vendor/autoload.php';
require_once 'request/Request.php';

class Client extends GuzzleHttp\Client
{
    public function __construct(string $token)
    {
        parent::__construct([
            'base_uri' => 'https://api.congressus.nl',
            'headers' => ["Authorization" => "Bearer {$token}"]
        ]);
    }

    private function submit(Request $request): ResponseInterface
    {
        return $this->send($request, $request->get_options());
    }

    // Members - raw

    public function retrieve_member(Arguments $arguments)
    {
        $request = new Request("GET", "/v30/members/{obj_id}");
        $request->allow([
            PathParameter::obj_id,
            QueryParameter::context,
        ]);
        $request->handle_arguments($arguments);
        return $this->submit($request);
    }

    public function search_members(Arguments $arguments)
    {
        $request = new Request("GET", "/v30/members/search");
        $request->allow([
            QueryParameter::term
        ]);
        $request->handle_arguments($arguments);
        return $this->submit($request);
    }

    // Members - custom

    public function retrieve_member_by_id(int|string $id) {
        $arguments = new Arguments();
        $arguments->add(PathParameter::obj_id, $id);
        $response = $this->retrieve_member($arguments);
        return json_decode($response->getBody());
    }

    public function retrieve_member_by_username(string $username) {
        $arguments = new Arguments();
        $arguments->add(QueryParameter::term, $username);
        $response = $this->search_members($arguments);
        $data = json_decode($response->getBody())->data;
        foreach ($data as $member) {
            if ($member->username === $username) {
                return $this->retrieve_member_by_id($member->id);
            }
        }
        return null;
    }

    // Events - raw

    public function list_events(Arguments $arguments)
    {
        $request = new Request("GET", "/v30/events");
        $request->allow([
            QueryParameter::category_id,
            QueryParameter::period_filter,
            QueryParameter::published,
            QueryParameter::order,
        ]);
        $request->handle_arguments($arguments);
        return $this->submit($request);
    }
}
