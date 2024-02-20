<?php

use Compucie\Congressus\Client;

require_once '../vendor/autoload.php';

$client = new Client(getenv("congressus"));

// Members

// $member = $client->retrieve_member_by_id(69);
// print_r($member);


// Products

$products = $client->list_products_in_folder(5427);
print_r($products);
