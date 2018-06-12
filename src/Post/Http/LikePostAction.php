<?php

namespace App\Post\Http;


use App\Core\Service\Dispatcher;
use App\Core\Service\Flusher;
use App\Post\Http\Command\LikePostCommand;
use App\Security\Entity\Credential;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/posts")
 */
class LikePostAction extends Controller
{
    /**
     * @Route("/{id}/like")
     * @Method({"POST"})
     *
     * @param string $id
     * @param Credential $credential
     * @param Dispatcher $dispatcher
     * @param Flusher $flusher
     */
    public function __invoke(string $id, Credential $credential, Dispatcher $dispatcher, Flusher $flusher)
    {
        $dispatcher->dispatch(
            new LikePostCommand($id, $credential->id())
        );

        $flusher->flush();
    }
}