<?php

use Compucie\Congressus\Client;

require_once("../vendor/autoload.php");

$client = new Client(getenv("congressus"));
$events = $client->listUpcomingEvents(1);
