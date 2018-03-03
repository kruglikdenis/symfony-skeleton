<?php

namespace App\Users\Action;


use App\Users\Entity\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;

class LoginAction
{
    /**
     * @var UserRepository
     */
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
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
        $user = $this->users->retrieveByEmail($request->email);

        return new JsonResponse($request->all(), 201);
    }
}