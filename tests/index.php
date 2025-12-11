<?php

use Compucie\Congressus\WebhookServer;

require_once "../vendor/autoload.php";

$call = WebhookServer::parseWebhookCall();
echo("Callback received for event type: " . $call->getTriggeredSignal() . "\n");
http_response_code(200);
