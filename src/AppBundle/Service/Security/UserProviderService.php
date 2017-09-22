<?php
/**
 * Created by PhpStorm.
 * User: pierrick
 * Date: 20/06/2017
 * Time: 11:03
 */

namespace AppBundle\Service\Security;


use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Component\Security\Core\User\UserProviderInterface;

use AppBundle\Entity\User\User;

/**
 * Class UserProviderService
 * @package AppBundle\Service\Security
 */
class UserProviderService implements UserProviderInterface
{
    /** @var EntityManager */
    private $em;

    /**
     * UserProvider constructor.
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Fetch User by Phone
     *
     * @param string $username
     * @return null|object
     */
    public function loadUserByUsername($username)
    {
        $user = $this->em->getRepository(User::class)->findOneByPhone($username);
        if (!$user) {
            throw new AuthenticationException();
        }

        return $user;
    }

    /**
     * Fetch User/ProUser by given UserInterface
     *
     * @param UserInterface $user
     * @return mixed
     */
    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new AuthenticationException();
        }

        return $this->em->getRepository(User::class)->findOneByPhone($user->getUsername());
    }

    /**
     * If class supported
     *
     * @param string $class
     * @return bool
     */
    public function supportsClass($class)
    {
        return is_subclass_of($class, User::class);
    }
}