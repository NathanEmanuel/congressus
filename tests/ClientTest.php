<?php

declare(strict_types=1);

use Compucie\Congressus\NewtonClient;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    private NewtonClient $client;

    protected function setUp(): void
    {
        $this->client = new NewtonClient(getenv("congressus"));
    }

    public function testRetrieveMemberByUsername()
    {
        $member = $this->client->retrieveMemberByUsername("s2191229");
        $this->assertSame("s2191229", $member->getUsername());
    }
}
