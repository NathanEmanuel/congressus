<?php

declare(strict_types=1);

use Compucie\Congressus\Client;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    private Client $client;

    protected function setUp(): void
    {
        $this->client = new Client(getenv("congressus"));
    }

    public function testRetrieveMemberByUsername()
    {
        $member = $this->client->retrieveMemberByUsername("s2191229");
        $this->assertSame("s2191229", $member->getUsername());
    }

    public function testListUpcomingEvents()
    {
        $events = $this->client->listUpcomingEvents(1);

        $this->assertLessThanOrEqual(10, count($events));

        /** @var Compucie\Congressus\Model\Event $event */
        foreach ($events as $event) {
            // print_r($event);
            // $this->assertLessThanOrEqual(time(), $event->getStart()->getTimestamp());
        }
    }
}
