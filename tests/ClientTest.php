<?php
require_once "../src/Client.php";
require_once "../src/Arguments.php";

$client = new Client(getenv("congressus"));

$arguments = new Arguments();
$arguments->add(QueryParameter::term, "Nathan Djojomoenawie");
$page = $client->search_members($arguments);
$data = json_decode($page->getBody())->data;
print_r($data);

$arguments = new Arguments();
$arguments->add(QueryParameter::period_filter, [null, (time() + 2629800)]);
$page = $client->list_events($arguments);
$data = json_decode($page->getBody())->data;
print_r($data);
