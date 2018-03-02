<?php

namespace App\Users\Action;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\ConstraintViolationList;

class LoginAction
{
    public function __construct()
    {
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
        return new JsonResponse($request->all(), 201);
    }
}