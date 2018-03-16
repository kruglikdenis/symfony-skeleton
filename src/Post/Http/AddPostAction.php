<?php

namespace App\Post\Http;


use App\Post\Entity\Post;
use App\Post\Entity\Posts;
use App\Post\Entity\TagExtractor;

class AddPostAction
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

    public function __invoke(AddPostRequest $request)
    {
        $post = Post::builder()
            ->setAuthor($request->author)
            ->setMedia($request->media)
            ->setDescription($request->description, $this->tagExtractor)
            ->build();

        $this->posts->add($post);

        return $post;
    }
}