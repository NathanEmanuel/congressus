<?php

declare(strict_types=1);

use Compucie\Congressus\Exceptions\UserNotFoundException;
use Compucie\Congressus\ExtendedClient;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertGreaterThan;
use function PHPUnit\Framework\assertSame;
use function PHPUnit\Framework\assertTrue;

class ExtendedClientTest extends TestCase
{
    private ExtendedClient $client;
    private array $env;

    protected function setUp(): void
    {
        $this->env = parse_ini_file(".env", true);
        if ($this->env) {
            $this->client = new ExtendedClient($this->env["congressus"]);
        }
    }

    /**
     * @throws UserNotFoundException
     */
    function testRetrieveMemberByUsername()
    {
        $member = $this->getClient()->retrieveMemberByUsername("s2191229");
        assertSame("s2191229", $member->getUsername());
    }

    function testRetrieveTopMembersByName(): void
    {
        $name = $this->env["RetrieveTopMembersByName_name"];
        $members = $this->getClient()->retrieveTopMembersByName($name);
        assertGreaterThan(0, count($members));

        $members = $this->getClient()->retrieveTopMembersByName($name, 1);
        assertSame(1, count($members));

        $members = $this->getClient()->retrieveTopMembersByName($name, 2);
        assertSame(2, count($members));
    }

    function testListUpcomingEventsList()
    {
        $upcomingEvents = $this->getClient()->listUpcomingEvents(2);
        assertSame(2, count($upcomingEvents));
    }

    function testIsMemberEventParticipant()
    {
        $member = $this->getClient()->retrieveMember(282676);

        // member was participant
        $event = $this->getClient()->retrieveEvent(98501);
        assertTrue($this->getClient()->isMemberEventParticipant($member, $event));

        // event had no sign up
        $event = $this->getClient()->retrieveEvent(99955);
        assertFalse($this->getClient()->isMemberEventParticipant($member, $event));

        // event had sign up but member was not participant
        $event = $this->getClient()->retrieveEvent(99701);
        assertFalse($this->getClient()->isMemberEventParticipant($member, $event));
    }

    function testRetrieveProductFoldersBySlug()
    {
        $slugs = ["snacks", "drinks", "merch"];
        $productFolders = $this->getClient()->retrieveProductFoldersBySlug(...$slugs);

        assertSame(3, count($productFolders));

        // check order
        $i = 0;
        foreach ($productFolders as $folder) {
            assertSame($slugs[$i], $folder->getSlug());
            $i++;
        }
    }

    function testCreateProductPublished()
    {
        $folderId = 6669;
        $productName = "test";
        $price = 0.00;

        $product = $this->getClient()->createProduct(
            folder_id: $folderId,
            name: $productName,
            published: true,
            price: $price,
            is_archived: false
        );
        assertTrue($product->getPublished());
        assertFalse($product->getIsArchived());
        assertSame($folderId, $product->getFolder()->getId());
        assertSame($productName, $product->getName());
        assertSame($price, $product->getPrice());
        echo $product;

        $this->getClient()->deleteProduct($product->getId());
    }

    function testCreateProductArchived()
    {
        $folderId = 6669;
        $productName = "test";
        $price = 0.00;

        $product = $this->getClient()->createProduct(
            folder_id: $folderId,
            name: $productName,
            published: false,
            price: $price,
            is_archived: true
        );
        assertFalse($product->getPublished());
        assertTrue($product->getIsArchived());
        assertSame($folderId, $product->getFolder()->getId());
        assertSame($productName, $product->getName());
        assertSame($price, $product->getPrice());
        echo $product;

        $this->getClient()->deleteProduct($product->getId());
    }

    function testCreateProductConcept()
    {
        $folderId = 6669;
        $productName = "test";
        $price = 0.00;

        $product = $this->getClient()->createProduct(
            folder_id: $folderId,
            name: $productName,
            published: false,
            price: $price,
            is_archived: false
        );
        assertFalse($product->getPublished());
        assertFalse($product->getIsArchived());
        assertSame($folderId, $product->getFolder()->getId());
        assertSame($productName, $product->getName());
        assertSame($price, $product->getPrice());
        echo $product;

        $this->getClient()->deleteProduct($product->getId());
    }

    function testCreateProductUpdatePublishedToArchived()
    {
        $folderId = 6669;
        $productName = "test";
        $price = 0.00;

        $product = $this->getClient()->createProduct(
            folder_id: $folderId,
            name: $productName,
            published: true,
            price: $price,
            is_archived: false
        );
        assertTrue($product->getPublished());
        assertFalse($product->getIsArchived());
        assertSame($folderId, $product->getFolder()->getId());
        assertSame($productName, $product->getName());
        assertSame($price, $product->getPrice());

        $productId = $product->getId();
        echo $product;

        //update to archived
        $productUpdated = $this->getClient()->updateProduct(
            obj_id: $productId,
            published: false,
            is_archived: true
        );
        assertFalse($productUpdated->getPublished());
        assertTrue($productUpdated->getIsArchived());
        assertSame($folderId, $productUpdated->getFolder()->getId());
        assertSame($productName, $productUpdated->getName());
        assertSame($price, $productUpdated->getPrice());
        echo $productUpdated;

        $this->getClient()->deleteProduct($productId);
    }

    function testCreateProductUpdateArchivedToPublished()
    {
        $folderId = 6669;
        $productName = "test";
        $price = 0.00;

        $product = $this->getClient()->createProduct(
            folder_id: $folderId,
            name: $productName,
            published: false,
            price: $price,
            is_archived: true
        );
        assertFalse($product->getPublished());
        assertTrue($product->getIsArchived());
        assertSame($folderId, $product->getFolder()->getId());
        assertSame($productName, $product->getName());
        assertSame($price, $product->getPrice());

        $productId = $product->getId();
        echo $product;

        //update to published
        $productUpdated = $this->getClient()->updateProduct(
            obj_id: $productId,
            published: true,
            is_archived: false
        );
        assertTrue($productUpdated->getPublished());
        assertFalse($productUpdated->getIsArchived());
        assertSame($folderId, $productUpdated->getFolder()->getId());
        assertSame($productName, $productUpdated->getName());
        assertSame($price, $productUpdated->getPrice());
        echo $productUpdated;

        $this->getClient()->deleteProduct($productId);
    }

    function testCreateProductUpdateArchivedToConcept()
    {
        $folderId = 6669;
        $productName = "test";
        $price = 0.00;

        $product = $this->getClient()->createProduct(
            folder_id: $folderId,
            name: $productName,
            published: true,
            price: $price,
            is_archived: true
        );
        assertTrue($product->getPublished());
        assertTrue($product->getIsArchived());
        assertSame($folderId, $product->getFolder()->getId());
        assertSame($productName, $product->getName());
        assertSame($price, $product->getPrice());

        $productId = $product->getId();
        echo $product;

        //update to concept
        $productUpdated = $this->getClient()->updateProduct(
            obj_id: $productId,
            published: false,
            is_archived: false
        );
        assertFalse($productUpdated->getPublished());
        assertFalse($productUpdated->getIsArchived());
        assertSame($folderId, $productUpdated->getFolder()->getId());
        assertSame($productName, $productUpdated->getName());
        assertSame($price, $productUpdated->getPrice());
        echo $productUpdated;

        $this->getClient()->deleteProduct($productId);
    }

    private function getClient(): ExtendedClient
    {
        return $this->client;
    }
}
