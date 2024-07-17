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
