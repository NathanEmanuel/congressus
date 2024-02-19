<?php
require_once "../src/Client.php";

$client = new Client(getenv("congressus"));

$page = $client->search_member("Nathan Djojomoenawie");
$data = json_decode($page->getBody())->data;
print_r($data);

$page = $client->get_events(period_end: (time() + 2629800));
$data = json_decode($page->getBody())->data;
print_r($data);
