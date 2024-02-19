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

    public function search_members(Arguments $arguments)
    {
        $request = new Request("GET", "/v30/members/search");
        $request->allow([
            QueryParameter::term
        ]);
        $request->handle_arguments($arguments);
        return $this->submit($request);
    }

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
