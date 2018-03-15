<?php

namespace App\Post\Http;


use App\Post\Entity\Posts;

class AddPostAction
{
    /**
     * @var Posts
     */
    private $posts;

    public function __construct(Posts $posts)
    {
        $this->posts = $posts;
    }

    public function __invoke(AddPostRequest $request)
    {
    }
}