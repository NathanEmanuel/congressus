<?php

namespace Compucie\Congressus\Webhooks;

use Compucie\Congressus\Model\Event;
use Compucie\Congressus\Model\MemberWithCustomFields;
use Compucie\Congressus\Model\SaleInvoice;
use Compucie\Congressus\ObjectSerializer;
use Compucie\Congressus\Webhooks\Exceptions\WebhookAuthenticationException;
use Compucie\Congressus\Webhooks\Exceptions\WebhookParsingException;
use DateTime;

class WebhookEndpoint
{
    private ?string $password;

    public function __construct(?string $password = null) {
        $this->password = $password;
    }

    public function receiveWebhookCall(): ?WebhookCall
    {
        try {
            $call = $this->parseWebhookCall();
            http_response_code(200);
            return $call;
        } catch (WebhookAuthenticationException) {
            http_response_code(401);
        } catch (WebhookParsingException) {
            http_response_code(400);
        }
        return null;
    }

    private function parseWebhookCall(): WebhookCall
    {
        if (!$this->isCallAuthenticated()) {
            throw new WebhookAuthenticationException();
        }

        $body = json_decode(file_get_contents('php://input'), associative: true);

        if ($body === null && json_last_error() !== JSON_ERROR_NONE) {
            throw new WebhookParsingException();
        }

        try {
            $webhookId = (int) ($body['webhook_id'] ?? 0);
            $webhookEvent = (string) ($body['webhook_event'] ?? '');
            $webhookEventTrigger = (string) ($body['webhook_event_trigger'] ?? '');
            $created = new DateTime($body['created'] ?? 'now');
            $data = $body["data"] ?? null;
            $member = ObjectSerializer::deserialize($data['member'] ?? null, MemberWithCustomFields::class);
            $event = ObjectSerializer::deserialize($data['event'] ?? null, Event::class);
            $saleInvoice = ObjectSerializer::deserialize($data['sale_invoice'] ?? null, SaleInvoice::class);
    
            return new WebhookCall($webhookId, $webhookEvent, $webhookEventTrigger, $created, $data, $member, $event, $saleInvoice);
        } catch (\Exception) {
            throw new WebhookParsingException();
        }
    }

    private function isCallAuthenticated(): bool
    {
        if ($this->getPassword() === null) {
            return true;
        }

        if (!isset($_SERVER['HTTP_AUTHORIZATION'])) {
            return false;
        }

        if (!strpos($_SERVER['HTTP_AUTHORIZATION'], 'Basic ') === 0) {
            return false;
        }

        // Decode the Authorization header manually. PHP's $_SERVER['PHP_AUTH_PW'] may not be available on all servers.
        $encoded = substr($_SERVER['HTTP_AUTHORIZATION'], 6);
        $decoded = base64_decode($encoded);
        $password = explode(':', $decoded, 2)[1];
        return $password === $this->getPassword();
    }

    private function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }
}
