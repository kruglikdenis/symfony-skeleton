<?php

namespace App\User\Http;


use App\Core\Http\Annotation\ResponseCode;
use App\Core\Http\Annotation\ResponseGroups;
use App\Core\Service\Dispatcher;
use App\Core\Service\Flusher;
use App\User\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/users")
 */
class RegisterAction
{
    /**
     * @Method({"POST"})
     * @Route("/register")
     * @ResponseGroups({"api_user_register"})
     * @ResponseCode(201)
     *
     * @param RegisterRequest $request
     * @param Dispatcher $dispatcher
     * @param Flusher $flusher
     * @return User
     */
    public function __invoke(RegisterRequest $request, Dispatcher $dispatcher, Flusher $flusher)
    {
        $command = new RegisterCommand($request);

        $dispatcher->dispatch($command);
        $flusher->flush();
    }
}