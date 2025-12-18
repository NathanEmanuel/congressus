<?php

namespace Compucie\Congressus\OAuth2;

use DateTime;
use DateTimeZone;
use League\OAuth2\Client\Token\AccessToken;

require_once __DIR__ . '/../../vendor/autoload.php';

class CongressusAccessToken extends AccessToken
{
    protected string $tokenType;
    protected string $name;
    protected string $idToken;

    public function __construct(array $options = [])
    {
        parent::__construct(array_merge([
            'access_token' => $options['access_token'] ?? null,
            'refresh_token' => $options['refresh_token'] ?? null,
            'expires' => $this->convertExpires($options['expires_at']),
            'resource_owner_id' => $options['user_id'] ?? null,
        ], $options));

        $this->tokenType = $options['token_type'] ?? '';
        $this->name = $options['name'] ?? '';
        $this->idToken = $options['id_token'] ?? '';
    }

    private function convertExpires(?string $expires): ?int
    {
        if (empty($expires)) return null;
        return (new DateTime($expires, new DateTimeZone('UTC')))->getTimestamp();
    }
}
