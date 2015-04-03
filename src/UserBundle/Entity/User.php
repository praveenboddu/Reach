<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class User implements UserInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=45)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $salt;

    /**
     * @var string ApiKey
     *
     * @ORM\Column(name="api_key", type="string", length=128, nullable=true)
     */
    private $apiKey;

    /**
     * @var string ApiKey
     *
     * @ORM\Column(name="api_key_expires", type="datetime", nullable=true)
     */
    private $apiKeyExpires;

    public function __construct()
    {
        $this->isActive = true;
        $this->salt = md5(uniqid(null, true));
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->salt;
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    //Roles if need be
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function eraseCredentials()
    {

    }

    public function refreshToken()
    {
        if ($this->isApiKeyExpired()) {
            $this->generateApiKey();
        } else {
            $this->prolongApiKeyExpiration();
        }
    }


    private function generateApiKey()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $apikey = '';
        for ($i = 0; $i < 64; $i++) {
            $apikey .= $characters[rand(0, strlen($characters) - 1)];
        }
        $apikey = base64_encode(sha1(uniqid('ue' . rand(rand(), rand())) . $apikey));
        $this->apiKey = $apikey;
        $this->apiKeyExpires = (new \DateTime())->modify("+1 hour");
    }

    private function isApiKeyExpired()
    {
        if ($this->apiKeyExpires == null
            || $this->apiKeyExpires->getTimestamp()-time() > 3600
        ) {
            return true;
        }

        return false;
    }

    private function prolongApiKeyExpiration()
    {
        $this->apiKeyExpires->modify("+1 hour");
    }
}
