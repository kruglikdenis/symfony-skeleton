<?php

namespace App\Post\Handler;


use App\Post\Entity\Post;
use App\Post\Entity\Posts;
use App\Post\Entity\TagExtractor;
use App\Post\Http\Command\AddPostCommand;
use Broadway\CommandHandling\SimpleCommandHandler;

class AddPostHandler extends SimpleCommandHandler
{
    /**
     * @var Posts
     */
    private $posts;

    /**
     * @var TagExtractor
     */
    private $tagExtractor;

    public function __construct(Posts $posts, TagExtractor $tagExtractor)
    {
        $this->posts = $posts;
        $this->tagExtractor = $tagExtractor;
    }

    public function handleAddPostCommand(AddPostCommand $command)
    {
        $request = $command->request();
        $post = Post::builder()
            ->setAuthor($command->authorId())
            ->setDescription($request->description, $this->tagExtractor)
            ->setMedia($request->media)
            ->build();

        $this->posts->add($post);
    }
}