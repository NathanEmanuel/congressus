<?php

use Compucie\Congressus\Client;

require_once '../vendor/autoload.php';

$client = new Client(getenv("congressus"));

// Events

$events = $client->listUpcomingEvents(269);
print_r(count($events));
