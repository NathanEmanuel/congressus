<?php

namespace Compucie\Congressus\OAuth2;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

require_once __DIR__ . '/../../vendor/autoload.php';

class CongressusResourceOwner implements ResourceOwnerInterface
{
    private array $response;

    public function __construct(array $response)
    {
        $this->response = $response;
    }

    public function getId()
    {
        return $this->response['sub'] ?? null;
    }

    public function toArray()
    {
        return $this->response;
    }
}
