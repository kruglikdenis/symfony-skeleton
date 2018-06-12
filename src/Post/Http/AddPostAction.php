<?php

namespace App\Post\Http;


use App\Core\Http\Annotation\ResponseCode;
use App\Core\Http\Annotation\ResponseGroups;
use App\Core\Service\Dispatcher;
use App\Core\Service\Flusher;
use App\Post\Http\Command\AddPostCommand;
use App\Security\Entity\Credential;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/posts")
 */
class AddPostAction extends Controller
{
    /**
     * @Method({"POST"})
     * @ResponseGroups({"api_post"})
     * @ResponseCode(201)
     *
     * @param AddPostRequest $request
     * @param Credential $credential
     * @param Flusher $flusher
     * @param Dispatcher $dispatcher
     */
    public function __invoke(AddPostRequest $request, Credential $credential, Dispatcher $dispatcher, Flusher $flusher)
    {
        $dispatcher->dispatch(
            new AddPostCommand($request, $credential->id())
        );

        $flusher->flush();
    }
}