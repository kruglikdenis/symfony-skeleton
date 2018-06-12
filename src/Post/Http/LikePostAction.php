<?php

namespace App\Post\Http;


use App\Core\Service\Dispatcher;
use App\Core\Service\Flusher;
use App\Post\Entity\Post;
use App\Post\Http\Command\LikePostCommand;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Core\Http\Annotation\ResponseTransformer;
use App\Post\Http\Transformer\LikeTransformer;

/**
 * @Route("/posts")
 */
class LikePostAction extends Controller
{
    /**
     * @Route("/{id}/like")
     * @Method({"POST"})
     * @ResponseTransformer(LikeTransformer::class)
     *
     * @param string $id
     * @param Dispatcher $dispatcher
     * @param Flusher $flusher
     *
     * @return Post
     */
    public function __invoke(string $id, Dispatcher $dispatcher, Flusher $flusher)
    {
        $command = new LikePostCommand($id, $this->getUser()->id());
        $dispatcher->dispatch($command);

        $flusher->flush();

        return $command->payload();
    }
}