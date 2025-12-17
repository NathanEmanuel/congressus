<?php

namespace Compucie\Congressus\OAuth2;

use League\OAuth2\Client\Grant\AbstractGrant;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\ResponseInterface;

require_once __DIR__ . '/../../vendor/autoload.php';

class CongressusOAuth2 extends AbstractProvider
{
    use BearerAuthorizationTrait;

    private string $domain;
    private CongressusAccessToken $accessToken;

    public function __construct(string $clientId, string $clientSecret, string $domain, array $options = [], array $collaborators = [])
    {
        $this->domain = parse_url($domain, PHP_URL_HOST);

        $defaultOptions = [
            'clientId' => $clientId,
            'clientSecret' => $clientSecret,
        ];

        parent::__construct(array_merge($defaultOptions, $options), $collaborators);
    }

    public function handleRequest()
    {
        session_start();

        if (!isset($_GET['code'])) {
            $this->authorize();
        } elseif (empty($_GET['state']) || empty($_SESSION['oauth2state']) || $_GET['state'] !== $_SESSION['oauth2state']) {

            if (isset($_SESSION['oauth2state'])) {
                unset($_SESSION['oauth2state']);
            }

            exit('Invalid state');
        } else {
            try {
                $this->getAccessToken();

                echo json_encode($this->getResourceOwner()->toArray());
            } catch (IdentityProviderException $e) {
                exit("Request failed: {$e->getMessage()}");
            }
        }
    }

    public function getAccessToken(mixed $grant = null, array $options = [])
    {
        if (empty($this->accessToken) || $grant === "authorization_code") {
            $grant = 'authorization_code';
            $options['code'] = $_GET['code'];
        } else if ($this->accessToken->hasExpired() || $grant === "refresh_token") {
            $grant = 'refresh_token';
            $options['refresh_token'] = $this->accessToken->getRefreshToken();
        } else {
            return $this->accessToken;
        }

        $accessToken = parent::getAccessToken($grant, $options);
        $this->setAccessToken($accessToken);
        return $accessToken;
    }

    private function setAccessToken(CongressusAccessToken $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * Requests and returns the resource owner of given access token.
     *
     * @param  AccessToken|null $token
     * @return CongressusResourceOwner
     * @throws IdentityProviderException
     * @throws UnexpectedValueException
     * @throws GuzzleException
     */
    public function getResourceOwner(?AccessToken $token = null): CongressusResourceOwner
    {
        $token = $token ?: $this->getAccessToken();
        $response = $this->fetchResourceOwnerDetails($token);

        return $this->createResourceOwner($response, $token);
    }

    public function authorize(
        array $options = [],
        ?callable $redirectHandler = null
    ) {
        $url = $this->getAuthorizationUrl($options);

        $_SESSION['oauth2state'] = $this->getState();

        if ($redirectHandler) {
            return $redirectHandler($url, $this);
        }

        // @codeCoverageIgnoreStart
        header('Location: ' . $url);
        exit;
        // @codeCoverageIgnoreEnd
    }

    public function getBaseAuthorizationUrl()
    {
        return "https://{$this->getDomain()}/oauth/authorize";
    }

    public function getBaseAccessTokenUrl(array $params)
    {
        return "https://{$this->getDomain()}/oauth/token";
    }

    public function getResourceOwnerDetailsUrl(AccessToken $token)
    {
        return "https://{$this->getDomain()}/oauth/userinfo";
    }

    protected function getDefaultScopes()
    {
        return ['openid'];
    }

    protected function checkResponse(ResponseInterface $response, $data)
    {
        if ($response->getStatusCode() >= 400) {
            throw new IdentityProviderException(
                isset($data['error']) ? $data['error'] : $response->getReasonPhrase(),
                $response->getStatusCode(),
                $response->getBody()
            );
        }
    }

    protected function createResourceOwner(array $response, AccessToken $token)
    {
        return new CongressusResourceOwner($response);
    }

    protected function getDomain(): string
    {
        return $this->domain;
    }

    protected function getScopeSeparator(): string
    {
        return ' ';
    }

    protected function getAccessTokenRequest(array $params)
    {
        $request = parent::getAccessTokenRequest($params);
        $credentials = base64_encode("{$this->clientId}:{$this->clientSecret}");
        $request = $request->withHeader("Authorization", "Basic $credentials");
        return $request;
    }

    protected function createAccessToken(array $response, AbstractGrant $grant)
    {
        return new CongressusAccessToken($response);
    }
}
