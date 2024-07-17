<?php

declare(strict_types=1);

use Compucie\Congressus\ExtendedClient;
use PHPUnit\Framework\TestCase;

class ExtendedClientTest extends TestCase
{
    private ExtendedClient $client;

    protected function setUp(): void
    {
        $this->client = new ExtendedClient(getenv("congressus"));
    }

    function testRetrieveMemberByUsername()
    {
        $member = $this->getClient()->retrieveMemberByUsername("s2191229");
        $this->assertSame("s2191229", $member->getUsername());
    }

    function testListUpcomingEventsList()
    {
        $upcomingEvents = $this->getClient()->listUpcomingEvents(2);
        $this->assertSame(2, count($upcomingEvents));
    }

    function testIsMemberEventParticipant()
    {
        $member = $this->getClient()->retrieveMember(282676);

        // member was participant
        $event = $this->getClient()->retrieveEvent(98501);
        $this->assertTrue($this->getClient()->isMemberEventParticipant($member, $event));

        // event had no sign up
        $event = $this->getClient()->retrieveEvent(99955);
        $this->assertFalse($this->getClient()->isMemberEventParticipant($member, $event));

        // event had sign up but member was not participant
        $event = $this->getClient()->retrieveEvent(99701);
        $this->assertFalse($this->getClient()->isMemberEventParticipant($member, $event));
    }

    function testRetrieveProductFoldersBySlug()
    {
        $slugs = ["snacks", "drinks", "merch"];
        $productFolders = $this->getClient()->retrieveProductFoldersBySlug(...$slugs);

        $this->assertSame(3, count($productFolders));

        // check order
        $i = 0;
        foreach ($productFolders as $folder) {
            $this->assertSame($slugs[$i], $folder->getSlug());
            $i++;
        }
    }

    private function getClient(): ExtendedClient
    {
        return $this->client;
    }
}
