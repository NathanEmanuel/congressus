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

    public function search_member(string $term)
    {
        $parameters = new Parameters("/v30/members/search");
        $parameters->allow(QueryParameter::term, $term);
        return $this->request("GET", $parameters->get_path(), $parameters->get_options());
    }

    public function get_events(?array $category_id = null, ?int $period_start = null, ?int $period_end = null, bool $published = false, string $order = "start:asc")
    {
        $parameters = new Parameters("/v30/events");
        $parameters->allow(QueryParameter::category_id, $category_id);
        $parameters->allow(QueryParameter::period_filter, [$period_start, $period_end]);
        $parameters->allow(QueryParameter::published, $published);
        $parameters->allow(QueryParameter::order, $order);
        return $this->request("GET", $parameters->get_path(), $parameters->get_options());
    }
}
