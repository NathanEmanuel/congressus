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

    public function getId(): ?int
    {
        return $this->response['user_id'] ?? null;
    }

    public function isActive(): ?bool
    {
        return $this->response['is_active'] ?? null;
    }

    public function getUsername(): ?string
    {
        return $this->response['username'] ?? null;
    }

    public function getName(): ?string
    {
        return $this->response['name'] ?? null;
    }

    public function getPicture(): ?string
    {
        return $this->response['picture'] ?? null;
    }

    public function getGender(): ?string
    {
        return $this->response['gender'] ?? null;
    }

    public function getBirthday(): ?string
    {
        return $this->response['birthday'] ?? null;
    }

    public function getMemberStatus(): ?string
    {
        return $this->response['member_status'] ?? null;
    }

    public function getMemberStatusId(): ?int
    {
        return $this->response['member_status_id'] ?? null;
    }

    public function getMemberStatusSince(): ?string
    {
        return $this->response['member_status_since'] ?? null;
    }

    public function getEmail(): ?string
    {
        return $this->response['email'] ?? null;
    }

    public function getAddress(): ?array
    {
        return $this->response['address'] ?? null;
    }

    public function getPhone(): ?string
    {
        return $this->response['phone'] ?? null;
    }

    public function getIban(): ?string
    {
        return $this->response['IBAN'] ?? null;
    }

    public function getBic(): ?string
    {
        return $this->response['BIC'] ?? null;
    }

    public function getCustomField(string $field): mixed
    {
        return $this->getCustomFields()[$field] ?? null;
    }

    public function getCustomFields(): ?array
    {
        return $this->response['custom'] ?? null;
    }

    public function getGroups(): ?array
    {
        return $this->response['groups'] ?? null;
    }

    public function toArray()
    {
        return $this->response;
    }
}
