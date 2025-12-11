<?php

namespace Compucie\Congressus;

class WebhookServer
{
    

    public static function parseWebhookCall(?string $password = null): Model\WebhookCall
    {
        if (isset($password) && !self::verifyWebhookAuthentication($password)) {
            throw new WebhookAuthenticationException();
        }

        $body = json_decode(file_get_contents('php://input'), associative: true);

        if ($body === null && json_last_error() !== JSON_ERROR_NONE) {
            throw new WebhookParsingException();
        }

        return ObjectSerializer::deserialize($body, Model\WebhookCall::class);
    }

    private static function verifyWebhookAuthentication(string $password): bool
    {
        if (!isset($_SERVER['HTTP_AUTHORIZATION'])) {
            return false;
        }

        if (!strpos($_SERVER['HTTP_AUTHORIZATION'], 'Basic ') === 0) {
            return false;
        }

        $encoded = substr($_SERVER['HTTP_AUTHORIZATION'], 6);
        $decoded = base64_decode($encoded);
        $requestPassword = explode(':', $decoded, 2)[1];
        return $password === $requestPassword;
    }
}

class WebhookAuthenticationException extends \Exception {}
class WebhookParsingException extends \Exception {}
