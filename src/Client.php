<?php

require_once '../vendor/autoload.php';
require_once 'Options.php';
require_once 'QueryParameter.php';
require_once 'QueryParameters.php';

class Client extends GuzzleHttp\Client
{
    public function __construct(string $token)
    {
        parent::__construct([
            'base_uri' => 'https://api.congressus.nl',
            'headers' => ["Authorization" => "Bearer {$token}"]
        ]);
    }

    public function search_member(string $term)
    {
        $query_parameters = new QueryParameters();
        $query_parameters->allow(QueryParameter::term, $term);

        // request
        $method = "GET";
        $path = "/v30/members/search";
        return $this->request($method, $path, $query_parameters->as_option());
    }

    public function get_events(?array $category_id = null, ?int $period_start = null, ?int $period_end = null, bool $published = false, string $order = "start:asc")
    {
        $query_parameters = new QueryParameters();
        $query_parameters->allow(QueryParameter::category_id, $category_id);
        $query_parameters->allow(QueryParameter::period_filter, [$period_start, $period_end]);
        $query_parameters->allow(QueryParameter::published, $published);
        $query_parameters->allow(QueryParameter::order, $order);

        // request
        $method = "GET";
        $path = "/v30/events";
        return $this->request($method, $path, $query_parameters->as_option());
    }
}
