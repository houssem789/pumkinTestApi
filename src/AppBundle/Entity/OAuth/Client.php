<?php
/**
 * Created by PhpStorm.
 * User: pierrick
 * Date: 20/06/2017
 * Time: 10:52
 */

namespace AppBundle\Entity\OAuth;


use Doctrine\ORM\Mapping as ORM;

use FOS\OAuthServerBundle\Entity\Client as BaseClient;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * Class Client
 * @package AppBundle\Entity\OAuth
 *
 * @ORM\Entity
 */
class Client extends BaseClient
{
    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\Column(type="string", nullable=false, unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="AppBundle\Security\IdGenerator")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @var array
     * @ORM\Column(type="simple_array",nullable=true)
     */
    protected $scopes;

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
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return array
     */
    public function getScopes()
    {
        return $this->scopes;
    }

    /**
     * @param array $scopes
     */
    public function setScopes($scopes)
    {
        $this->scopes = $scopes;
    }
}