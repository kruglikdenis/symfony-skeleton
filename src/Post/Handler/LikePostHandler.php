<?php

namespace App\Post\Handler;


use App\Post\Entity\Posts;
use App\Post\Entity\User;
use App\Post\Http\Command\LikePostCommand;
use Broadway\CommandHandling\SimpleCommandHandler;

class LikePostHandler extends SimpleCommandHandler
{
    /**
     * @var Posts
     */
    private $posts;

    public function __construct(Posts $posts)
    {
        $this->posts = $posts;
    }

    public function handleLikePostCommand(LikePostCommand $command)
    {
        $post = $this->posts->retrieveById($command->postId());

        $post->addLike(new User($command->likerId()));
    }
}