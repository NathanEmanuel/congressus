<?php

declare(strict_types=1);

use Compucie\Congressus\ExtendedClientnt;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    private ExtendedClientnt $client;

    protected function setUp(): void
    {
        $this->client = new ExtendedClientnt(getenv("congressus"));
    }

    public function testRetrieveMemberByUsername()
    {
        $member = $this->client->retrieveMemberByUsername("s2191229");
        $this->assertSame("s2191229", $member->getUsername());
    }
}
