<?php
require_once __DIR__ . "/src/Client.php";

$client = new Client(getenv("congressus"));

$page = $client->get_events(31536000);
$events = json_decode($page->getBody())->data;
$start = strtotime($events[0]->start . "UTC");
print_r(date("D M j", $start));
