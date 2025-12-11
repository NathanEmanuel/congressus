<?php

namespace Compucie\Congressus\Webhooks;

use Compucie\Congressus\Model\Event;
use Compucie\Congressus\Model\MemberWithCustomFields;
use Compucie\Congressus\Model\SaleInvoice;
use DateTime;

class WebhookCall
{
    private int $webhookId;
    private string $webhookEvent;
    private string $webhookEventTrigger;
    private DateTime $created;
    private array $data;
    private ?MemberWithCustomFields $member;
    private ?Event $event;
    private ?SaleInvoice $saleInvoice;

    public function __construct(int $webhookId, string $webhookEvent, string $webhookEventTrigger, DateTime $created, array $data, ?MemberWithCustomFields $member = null, ?Event $event = null, ?SaleInvoice $saleInvoice = null) {
        $this->webhookId = $webhookId;
        $this->webhookEvent = $webhookEvent;
        $this->webhookEventTrigger = $webhookEventTrigger;
        $this->created = $created;
        $this->data = $data;
        $this->member = $member;
        $this->event = $event;
        $this->saleInvoice = $saleInvoice;
    }

    public function getWebhookId(): int
    {
        return $this->webhookId;
    }

    public function getWebhookEvent(): string
    {
        return $this->webhookEvent;
    }

    public function getWebhookEventTrigger(): string
    {
        return $this->webhookEventTrigger;
    }

    public function getCreated(): DateTime
    {
        return $this->created;
    }

    /**
     * Returns the raw data payload of the webhook call in JSON format. It is generally better to use the specific getters for the different data types.
     */
    public function getData(): array
    {
        return $this->data;
    }

    public function getMember(): ?MemberWithCustomFields
    {
        return $this->member;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function getSaleInvoice(): ?SaleInvoice
    {
        return $this->saleInvoice;
    }
}
