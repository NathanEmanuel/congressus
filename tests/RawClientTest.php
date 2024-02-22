<?php

use Compucie\Congressus\RawClient;

require_once '../vendor/autoload.php';

$client = new RawClient(getenv("congressus"));
$page = $client->listGroups();

for ($i=0; $i < 10; $i++) { 
    echo $page->getNextPage();
    $page = $client->nextPage($page);
}
