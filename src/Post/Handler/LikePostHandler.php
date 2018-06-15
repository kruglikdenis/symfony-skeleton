<?php

namespace App\Post\Handler;


use App\Post\Entity\PostRepository;
use App\Post\Entity\User;
use App\Post\Http\Command\LikePostCommand;
use Broadway\CommandHandling\SimpleCommandHandler;

class LikePostHandler extends SimpleCommandHandler
{
    /**
     * @var PostRepository
     */
    private $posts;

    public function __construct(PostRepository $posts)
    {
        $this->posts = $posts;
    }

    public function handleLikePostCommand(LikePostCommand $command)
    {
        $post = $this->posts->retrieveById($command->postId());

        $post->addLike(new User($command->likerId()));

        $command->withPayload($post);
    }
}