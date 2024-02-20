<?php

use Compucie\Congressus\RawClient;
use Compucie\Congressus\Request\Parameters;
use Compucie\Congressus\Request\ParameterType\Path;
use Compucie\Congressus\Request\ParameterType\Query;

require_once '../vendor/autoload.php';

$client = new RawClient(getenv("congressus"));

// $parameters = new Parameters();
// $parameters->add(Query::term, "Nathan Djojomoenawie");
// $data = $client->search_members($parameters);

$parameters = new Parameters();
$parameters->add(Query::published, true);
// $parameters->add(Query::period_filter, time());
// $parameters->add(Query::period_filter, [time(), null]);
// $parameters->add(Query::period_filter, [null, time()]);
// $parameters->add(Query::period_filter, [time(), time() + 5260000]);
$data = $client->list_events($parameters);
print_r($data["total"]);

// $parameters = new Parameters();
// $parameters->add(Path::obj_id, 282676);
// $data = $client->retrieve_member($parameters);

// $parameters = new Parameters();
// $parameters->add(Path::obj_id, "282676");
// $data = $client->retrieve_member($parameters);

// $data = $client->list_members();

// $data = $client->list_groups();

// $data = $client->list_group_memberships();

// $data = $client->list_events();

// $data = $client->list_products();

// $data = $client->list_products_folders_recursive();

// $data = $client->list_products_folders();
