<?php

namespace App\Post\Entity;

class Post
{
    public function __construct(PostBuilder $builder)
    {
    }

    public static function builder(): PostBuilder
    {
        return new PostBuilder();
    }
}