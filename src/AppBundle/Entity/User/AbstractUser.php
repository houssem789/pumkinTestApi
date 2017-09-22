<?php
/**
 * Created by PhpStorm.
 * User: pierrick
 * Date: 20/06/2017
 * Time: 11:56
 */

namespace AppBundle\Entity\User;


use Doctrine\ORM\Mapping as ORM;

use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class AbstractUser
 * @package AppBundle\Entity\User
 *
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({
 *     "user" = "AppBundle\Entity\User\User",
 * })
 */
abstract class AbstractUser implements UserInterface
{
    use TimestampableEntity;

    use SoftDeleteableEntity;

    /**
     * AbstractUser Id
     *
     * @ORM\Id
     * @ORM\Column(type="string", nullable=false, unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="AppBundle\Security\IdGenerator")
     */
    protected $id;

    /**
     * AbstractUser civility (nullable)
     *
     * @var int
     * @ORM\Column(type="smallint", nullable=true)
     */
    protected $civility;

    /**
     * AbstractUser firstname (nullable)
     *
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $firstName;

    /**
     * AbstractUser lastname (nullable)
     *
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $lastName;

    /**
     * AbstractUser birthdate (nullable)
     *
     * @var \DateTime
     * @ORM\Column(type="date", nullable=true)
     */
    protected $birthDate;

    /**
     * AbstractUser phone (nullable)
     *
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $phone;

    /**
     * AbstractUser email (nullable)
     *
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $email;

    /**
     * AbstractUser array of roles
     *
     * @var array
     * @ORM\Column(type="simple_array")
     */
    protected $roles;

    /**
     * AbstractUser constructor.
     */
    public function __construct()
    {
        $this->civility = 0;
        $this->roles = array();
    }

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
     * @return int
     */
    public function getCivility()
    {
        return $this->civility;
    }

    /**
     * @param int $civility
     */
    public function setCivility($civility)
    {
        $this->civility = $civility;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param \DateTime $birthDate
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->phone;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * Checks whether the user's account has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw an AccountExpiredException and prevent login.
     *
     * @return bool true if the user's account is non expired, false otherwise
     *
     * @see AccountExpiredException
     */
    public function isAccountNonExpired()
    {
        return true;
    }

    /**
     * Checks whether the user is locked.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a LockedException and prevent login.
     *
     * @return bool true if the user is not locked, false otherwise
     *
     * @see LockedException
     */
    public function isAccountNonLocked()
    {
        return false;
    }

    /**
     * Checks whether the user's credentials (password) has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a CredentialsExpiredException and prevent login.
     *
     * @return bool true if the user's credentials are non expired, false otherwise
     *
     * @see CredentialsExpiredException
     */
    public function isCredentialsNonExpired()
    {
        return true;
    }

    /**
     * Checks whether the user is enabled.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a DisabledException and prevent login.
     *
     * @return bool true if the user is enabled, false otherwise
     *
     * @see DisabledException
     */
    public function isEnabled()
    {
        return true;
    }
}