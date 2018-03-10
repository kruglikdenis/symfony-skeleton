<?php

namespace App\User\Service;


use App\User\Entity\Security\AuthToken;
use App\User\Entity\Security\Credential;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Events;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class JwtAuthorizer implements Authorizer
{
    /**
     * @var JWTTokenManagerInterface
     */
    private $jwtManager;

    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    public function __construct(JWTTokenManagerInterface $jwtManager, EventDispatcherInterface $dispatcher)
    {
        $this->jwtManager = $jwtManager;
        $this->dispatcher = $dispatcher;
    }

    public function authorize(Credential $credentials): AuthToken
    {
        $jwt = $this->jwtManager->create($credentials);

        $response = new JsonResponse();
        $event = new AuthenticationSuccessEvent([ 'token' => $jwt ], $credentials, $response);
        $this->dispatcher->dispatch(Events::AUTHENTICATION_SUCCESS, $event);

        return new AuthToken($jwt);
    }
}