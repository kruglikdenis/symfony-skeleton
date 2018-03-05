<?php

namespace App\User\Http;


use App\User\Entity\Security\CredentialsRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;

class LoginAction
{
    /**
     * @var CredentialsRepository
     */
    private $credentials;

    public function __construct(CredentialsRepository $credentials)
    {
        $this->credentials = $credentials;
    }


    /**
     * @Route("/login")
     * @Method({"POST"})
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function __invoke(LoginRequest $request)
    {
//        $credentials = $this->credentials->retrieveByEmail($request->email);

        return new JsonResponse($request->all(), 201);
    }
}