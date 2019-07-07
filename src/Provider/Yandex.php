<?php
/**
 * Date: 07.07.2019
 * Time: 18:54
 */

namespace AI\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\ResponseInterface;

class Yandex extends AbstractProvider
{
    use BearerAuthorizationTrait;

    /**
     * @return string
     */
    public function getBaseAuthorizationUrl()
    {
        return 'https://oauth.yandex.ru/authorize';
    }

    /**
     * @return string
     */
    public function getBaseAccessTokenUrl(array $params)
    {
        return 'https://oauth.yandex.ru/token';
    }

    /**
     * @return string
     */
    public function getResourceOwnerDetailsUrl(AccessToken $token)
    {
        return 'https://login.yandex.ru/info?format=json&oauth_token=' . $token->getToken();
    }

    /**
     * @return array
     */
    protected function getDefaultScopes()
    {
        return [];
    }

    /**
     * @param ResponseInterface $response
     * @param array|string $data
     * @throws IdentityProviderException
     */
    protected function checkResponse(ResponseInterface $response, $data)
    {
        if (isset($data['error'])) {
            throw new IdentityProviderException(
                $data['error'] . ': ' .$data['error_description'],
                $response->getStatusCode(),
                $response
            );
        }
    }

    /**
     * @param array $response
     * @param AccessToken $token
     * @return YandexUser
     */
    protected function createResourceOwner(array $response, AccessToken $token)
    {
        return new YandexUser($response);
    }
}