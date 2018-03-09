<?php

namespace App\User\Service;

use App\User\Entity\Security\Credentials;
use App\User\Entity\Security\Email;
use App\User\Entity\Security\EmailResolver;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class CredentialsProvider implements UserProviderInterface
{
    /**
     * @var Credentials
     */
    private $provider;

    public function __construct(EmailResolver $provider)
    {
        $this->provider = $provider;
    }

    public function loadUserByUsername($username)
    {
        return $this->provider->retrieveByEmail(new Email($username));
    }

    public function refreshUser(UserInterface $user)
    {
        throw new UnsupportedUserException();
    }

    public function supportsClass($class)
    {
        return $class === Credentials::class;
    }
}