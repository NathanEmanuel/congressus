<?php

use Compucie\Congressus\Webhooks\WebhookEndpoint;
use Compucie\Congressus\WebhookAuthenticationException;
use Compucie\Congressus\WebhookParsingException;

require_once "../vendor/autoload.php";

$endpoint = new WebhookEndpoint("password");

try {
    $call = $endpoint->receiveWebhookCall();
    echo json_encode($call->getSaleInvoice());
} catch (WebhookAuthenticationException) {
    http_response_code(401);
} catch (WebhookParsingException) {
    http_response_code(400);
}
