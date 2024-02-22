<?php

use Compucie\Congressus\Client;

require_once '../vendor/autoload.php';

$client = new Client(getenv("congressus"));

// Events

$events = $client->listUpcomingEvents(4);
print_r(count($events));
