<?php
/**
 * Date: 07.07.2019
 * Time: 19:01
 */

namespace AI\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class YandexUser implements ResourceOwnerInterface
{
    /**
     * @var array
     */
    private $response;

    /**
     * Creates a new instance of YandexResourceOwner class.
     *
     * @param array $response
     */
    public function __construct(array $response)
    {
        $this->response = $response;
    }

    /**
     * Gets user Id
     *
     * @return mixed|null
     */
    public function getId()
    {
        return $this->response['id'] ?: null;
    }

    /**
     * Gets user nickname.
     *
     * @return string|null
     */
    public function getNickname()
    {
        return $this->response['login'] ?: null;
    }

    /**
     * Gets user email.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->response['default_email'] ?: null;
    }

    /**
     * Gets display name.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->response['display_name'] ?: null;
    }

    /**
     * Gets first name.
     *
     * @return string|null
     */
    public function getFirstName()
    {
        return $this->response['first_name'] ?: null;
    }

    /**
     * Gets last name.
     *
     * @return string|null
     */
    public function getLastName()
    {
        return $this->response['last_name'] ?: null;
    }

    /**
     * Gets the gender.
     *
     * @return string|null
     */
    public function getGender()
    {
        return $this->response['sex'] ?: null;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->response;
    }
}