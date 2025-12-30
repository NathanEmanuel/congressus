<?php

use Compucie\Congressus\Webhooks\WebhookEndpoint;

require_once "../vendor/autoload.php";

$endpoint = new WebhookEndpoint("password");


$call = $endpoint->receiveWebhookCall();
if ($call) {
    echo json_encode($call->getSaleInvoice());
}