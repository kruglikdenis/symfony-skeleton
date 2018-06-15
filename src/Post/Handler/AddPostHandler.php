<?php

namespace App\Post\Handler;


use App\Post\Entity\Post;
use App\Post\Entity\PostRepository;
use App\Post\Entity\TagExtractor;
use App\Post\Http\Command\AddPostCommand;
use Broadway\CommandHandling\SimpleCommandHandler;

class AddPostHandler extends SimpleCommandHandler
{
    /**
     * @var PostRepository
     */
    private $posts;

    /**
     * @var TagExtractor
     */
    private $tagExtractor;

    public function __construct(PostRepository $posts, TagExtractor $tagExtractor)
    {
        $this->posts = $posts;
        $this->tagExtractor = $tagExtractor;
    }

    public function handleAddPostCommand(AddPostCommand $command)
    {
        $request = $command->request();
        $post = Post::builder()
            ->setAuthor($command->authorId())
            ->withTitle($request->title)
            ->setDescription($request->description, $this->tagExtractor)
            ->setMedia($request->media)
            ->build();

        $this->posts->add($post);
    }
}