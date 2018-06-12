<?php

namespace App\User\Http;


use App\Core\Http\Annotation\ResponseCode;
use App\Core\Http\Annotation\ResponseGroups;
use App\Core\Service\Dispatcher;
use App\Core\Service\Flusher;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/users")
 */
class RegisterAction extends Controller
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
     */
    public function __invoke(RegisterRequest $request, Dispatcher $dispatcher, Flusher $flusher)
    {
        $dispatcher->dispatch(
            new RegisterCommand($request)
        );

        $flusher->flush();
    }
}