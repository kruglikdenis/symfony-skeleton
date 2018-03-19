<?php

namespace App\User\Http;


use App\Core\Http\Annotation\ResponseCode;
use App\Core\Http\Annotation\ResponseGroups;
use App\User\Entity\User;
use App\User\Service\UserRegisterer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/users")
 */
class RegisterAction
{
    /**
     * @var UserRegisterer
     */
    private $registerer;

    public function __construct(UserRegisterer $registerer)
    {
        $this->registerer = $registerer;
    }

    /**
     * @Method({"POST"})
     * @Route("/register")
     * @ResponseGroups({"api_user_register"})
     * @ResponseCode(201)
     *
     * @param RegisterRequest $request
     * @return User
     */
    public function __invoke(RegisterRequest $request)
    {
        return $this->registerer->register($request);
    }
}