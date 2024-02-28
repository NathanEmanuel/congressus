<?php

use Compucie\Congressus\RawClient;

require_once '../vendor/autoload.php';

$client = new RawClient(getenv("congressus"));

$client->createMemberLogEntry(member_id: 282676, type: "Note", text: date("Y-m-d H:i:s", time()));
