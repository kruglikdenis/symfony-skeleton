<?php

namespace App\User\Http;


use App\Common\Annotation\ResponseCode;
use App\Common\Annotation\ResponseGroup;
use App\User\Entity\Security\Credentials;
use App\User\Entity\Security\CredentialsRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


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
     * @ResponseGroup({"api_login"})
     * @ResponseCode(200)
     *
     * @param LoginRequest $request
     * @return Credentials
     */
    public function __invoke(LoginRequest $request)
    {
        return $this->credentials->retrieveByEmail($request->email);
    }
}