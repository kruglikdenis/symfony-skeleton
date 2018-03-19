<?php

namespace App\Security;

use App\Security\Entity\Credential;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Authentication\Token\JWTUserToken;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

final class CredentialValueResolver implements ArgumentValueResolverInterface
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function supports(Request $request, ArgumentMetadata $argument)
    {
        if (Credential::class !== $argument->getType()) {
            return false;
        }

        /** @var JWTUserToken $token */
        $token = $this->tokenStorage->getToken();

        if (!$token instanceof JWTUserToken) {
            return false;
        }

        return $token->getUser() instanceof Credential;
    }

    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        yield $this->tokenStorage->getToken()->getUser();
    }
}