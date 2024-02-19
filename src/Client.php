<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once 'Options.php';

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
        // default options
        $options = new Options();

        // argument handling
        $options->add_query("term", $term);

        // request
        $method = "GET";
        $path = "/v30/members/search";
        return $this->request($method, $path, $options->as_array());
    }

    public function get_events(?int $time_span = null, bool $published = true)
    {
        // default options
        $options = new Options();
        $options->add_query("order", "start:asc");

        // argument handling
        if (!is_null($time_span)) {
            $options->add_query("period_filter", date("Ymd") . ".." . date("Ymd", time() + $time_span));
        }

        if ($published) {
            $options->add_query("published", "1");
        }

        // request
        $method = "GET";
        $path = "/v30/events";
        return $this->request($method, $path, $options->as_array());
    }
}
