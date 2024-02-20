<?php

use Compucie\Congressus\Client;
use Compucie\Congressus\Request\Parameters;
use Compucie\Congressus\Request\ParameterType\Path;
use Compucie\Congressus\Request\ParameterType\Query;

require_once '../vendor/autoload.php';

$client = new Client(getenv("congressus"));

$parameters = new Parameters();
$parameters->add(Query::term, "Nathan Djojomoenawie");
$data = $client->search_members($parameters);
print_r($data);

$parameters = new Parameters();
$parameters->add(Query::period_filter, [null, (time() + 2629800)]);
$data = $client->list_events($parameters);
print_r($data);

$parameters = new Parameters();
$parameters->add(Path::obj_id, 282676);
$data = $client->retrieve_member($parameters);
print_r($data);

$parameters = new Parameters();
$parameters->add(Path::obj_id, "282676");
$data = $client->retrieve_member($parameters);
print_r($data);

$data = $client->list_events();
print_r($data);
