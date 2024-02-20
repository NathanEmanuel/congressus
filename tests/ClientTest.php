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

$parameters = new Parameters();
$parameters->add(Query::period_filter, [null, (time() + 2629800)]);
$data = $client->list_events($parameters);

$parameters = new Parameters();
$parameters->add(Path::obj_id, 282676);
$data = $client->retrieve_member($parameters);

$parameters = new Parameters();
$parameters->add(Path::obj_id, "282676");
$data = $client->retrieve_member($parameters);

$data = $client->list_members();

$data = $client->list_groups();

$data = $client->list_group_memberships();

$data = $client->list_events();

$data = $client->list_products();

$data = $client->list_products_folders_recursive();
print_r($data);

$data = $client->list_products_folders();
