<?php

namespace App\User\Http;


use App\Common\Annotation\ResponseCode;
use App\Common\Annotation\ResponseGroup;
use App\User\Entity\Security\Credential;
use App\User\Entity\Security\Credentials;
use App\User\Entity\Security\Email;
use App\User\Service\Authorizer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class LoginAction
{
    /**
     * @var Credentials
     */
    private $credentials;

    /**
     * @var Authorizer
     */
    private $authorizer;

    public function __construct(Credentials $credentials, Authorizer $authorizer)
    {
        $this->credentials = $credentials;
        $this->authorizer = $authorizer;
    }

    /**
     * @Route("/login")
     * @Method({"POST"})
     * @ResponseGroup({"api_login"})
     * @ResponseCode(200)
     *
     * @param LoginRequest $request
     * @return Credential
     */
    public function __invoke(LoginRequest $request)
    {
        $credentials = $this->credentials->retrieveByEmail(new Email($request->email));

        return $this->authorizer->authorize($credentials);
    }
}