<?php

require_once '../vendor/autoload.php';
require_once 'Parameters.php';

class Client extends GuzzleHttp\Client
{
    public function __construct(string $token)
    {
        parent::__construct([
            'base_uri' => 'https://api.congressus.nl',
            'headers' => ["Authorization" => "Bearer {$token}"]
        ]);
    }

    public function search_members(Arguments $arguments)
    {
        $parameters = new Parameters("/v30/members/search");
        $parameters->allow([
            QueryParameter::term
        ]);
        $parameters->handle_arguments($arguments);
        return $this->request("GET", $parameters->get_path(), $parameters->get_options());
    }

    public function list_events(Arguments $arguments)
    {
        $parameters = new Parameters("/v30/events");
        $parameters->allow([
            QueryParameter::category_id,
            QueryParameter::period_filter,
            QueryParameter::published,
            QueryParameter::order,
        ]);
        $parameters->handle_arguments($arguments);
        return $this->request("GET", $parameters->get_path(), $parameters->get_options());
    }
}
