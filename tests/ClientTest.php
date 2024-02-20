<?php
require_once("../src/Client.php");
require_once("../src/request/Arguments.php");

$client = new Client(getenv("congressus"));

$arguments = new Arguments();
$arguments->add(QueryParameter::term, "Nathan Djojomoenawie");
$data = $client->search_members($arguments);
print_r($data);

$arguments = new Arguments();
$arguments->add(QueryParameter::period_filter, [null, (time() + 2629800)]);
$data = $client->list_events($arguments);
print_r($data);

$arguments = new Arguments();
$arguments->add(PathParameter::obj_id, 282676);
$data = $client->retrieve_member($arguments);
print_r($data);

$arguments = new Arguments();
$arguments->add(PathParameter::obj_id, "282676");
$data = $client->retrieve_member($arguments);
print_r($data);

$data = $client->list_events();
print_r($data);
