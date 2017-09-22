<?php
/**
 * Created by PhpStorm.
 * User: pierrick
 * Date: 20/06/2017
 * Time: 11:03
 */

namespace AppBundle\Service\Security;


use OAuth2\Model\IOAuth2Client;
use FOS\OAuthServerBundle\Model\ClientInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\InvalidArgumentException;

use FOS\OAuthServerBundle\Storage\OAuthStorage as BaseStorage;

/**
 * Class OAuthStorageService
 * @package AppBundle\Service\Security
 */
class OAuthStorageService extends BaseStorage
{
    /** @var UserProviderService */
    protected $userProvider;

    /**
     * Check OAuth Login credentials
     * Throws InvalidArgumentException if scopes are not defined in request
     *
     * @param IOAuth2Client $client
     * @param string $username
     * @param string $password
     * @return array|bool
     * @throws \InvalidArgumentException
     */
    public function checkUserCredentials(IOAuth2Client $client, $username, $password)
    {
        if (!$client instanceof ClientInterface) {
            throw new InvalidArgumentException();
        }

        try {
            $user = $this->userProvider->loadUserByUsername($username);
        } catch (AuthenticationException $e) {
            return false;
        }

        if (null !== $user) {
            $encoder = $this->encoderFactory->getEncoder($user);

            if ($encoder->isPasswordValid($user->getPassword(), $password, $user->getSalt())) {
                return array('data' => $user);
            }

            throw new BadRequestHttpException();
        }

        return false;
    }
}