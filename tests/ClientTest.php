<?php
require_once "../src/Client.php";

$client = new Client(getenv("congressus"));

$page = $client->search_members("Nathan Djojomoenawie");
$data = json_decode($page->getBody())->data;
print_r($data);

$page = $client->list_events(period_end: (time() + 2629800));
$data = json_decode($page->getBody())->data;
print_r($data);
