<?php

use Compucie\Congressus\RawClient;

require_once '../vendor/autoload.php';

$client = new RawClient(getenv("congressus"));
