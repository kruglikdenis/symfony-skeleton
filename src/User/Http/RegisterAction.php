<?php

namespace App\User\Http;


use App\Core\Http\Annotation\ResponseCode;
use App\Core\Service\Dispatcher;
use App\Core\Service\Flusher;
use App\User\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Core\Http\Annotation\ResponseTransformer;
use App\User\Http\Transformer\UserTransformer;

/**
 * @Route("/users")
 */
class RegisterAction extends Controller
{
    /**
     * @Method({"POST"})
     * @Route("/register")
     * @ResponseCode(201)
     * @ResponseTransformer(UserTransformer::class)
     *
     * @param RegisterRequest $request
     * @param Dispatcher $dispatcher
     * @param Flusher $flusher
     *
     * @return User
     */
    public function __invoke(RegisterRequest $request, Dispatcher $dispatcher, Flusher $flusher)
    {
        $command = new RegisterCommand($request);
        $dispatcher->dispatch($command);

        $flusher->flush();

        return $command->payload();
    }
}