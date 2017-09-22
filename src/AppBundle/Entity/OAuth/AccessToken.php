<?php
/**
 * Created by PhpStorm.
 * User: pierrick
 * Date: 20/06/2017
 * Time: 10:54
 */

namespace AppBundle\Entity\OAuth;


use Doctrine\ORM\Mapping as ORM;
use FOS\OAuthServerBundle\Model\ClientInterface;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Security\Core\User\UserInterface;

use FOS\OAuthServerBundle\Entity\AccessToken as BaseAccessToken;

/**
 * Class AccessToken
 * @package AppBundle\Entity\OAuth
 *
 * @ORM\Entity
 */
class AccessToken extends BaseAccessToken
{
    use TimestampableEntity;

    /**
     * AccessToken id
     *
     * @ORM\Id
     * @ORM\Column(type="string", nullable=false, unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="AppBundle\Security\IdGenerator")
     */
    protected $id;

    /**
     * AccessToken client
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\OAuth\Client")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    protected $client;

    /**
     * AccessToken user
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * AccessToken refresh
     *
     * @var RefreshToken
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\OAuth\RefreshToken", mappedBy="accessToken", orphanRemoval=true, cascade={"remove", "persist"})
     * @ORM\JoinColumn(name="refresh_token_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $refreshToken;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * @return RefreshToken
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * @param RefreshToken $refreshToken
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;
    }
}