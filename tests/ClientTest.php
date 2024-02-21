<?php

use Compucie\Congressus\Client;

require_once '../vendor/autoload.php';

$client = new Client(getenv("congressus"));

// Events

$events = $client->listUpcomingEvents(8);
print_r($events);
