<?php

namespace App\User\Http;


use App\Common\Http\Annotation\ResponseCode;
use App\Common\Http\Annotation\ResponseGroups;
use App\User\Entity\Security\Credential;
use App\User\Entity\Security\Credentials;
use App\User\Entity\Security\Email;
use App\User\Service\Authorizer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class LoginAction
{
    /**
     * @var Credentials
     */
    private $credentials;

    /**
     * @var PasswordEncoderInterface
     */
    private $encoder;

    /**
     * @var Authorizer
     */
    private $authorizer;

    public function __construct(Credentials $credentials, UserPasswordEncoderInterface $encoder, Authorizer $authorizer)
    {
        $this->credentials = $credentials;
        $this->encoder = $encoder;
        $this->authorizer = $authorizer;
    }

    /**
     * @Route("/login")
     * @Method({"POST"})
     * @ResponseGroups({"api_login"})
     * @ResponseCode(200)
     *
     * @param LoginRequest $request
     * @return Credential
     */
    public function __invoke(LoginRequest $request)
    {
        $credential = $this->credentials->retrieveByEmail(new Email($request->email));
        $credential->validatePassword($request->password, $this->encoder);

        return $this->authorizer->authorize($credential);
    }
}