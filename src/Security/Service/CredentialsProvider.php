<?php

namespace App\User\Service;

use App\User\Entity\Security\Credential;
use App\User\Entity\Security\Credentials;
use App\User\Entity\Security\Email;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class CredentialsProvider implements UserProviderInterface
{
    /**
     * @var Credential
     */
    private $credentials;

    public function __construct(Credentials $credentials)
    {
        $this->credentials = $credentials;
    }

    public function loadUserByUsername($username)
    {
        return $this->credentials->retrieveByEmail(new Email($username));
    }

    public function refreshUser(UserInterface $user)
    {
        throw new UnsupportedUserException();
    }

    public function supportsClass($class)
    {
        return $class === Credential::class;
    }
}