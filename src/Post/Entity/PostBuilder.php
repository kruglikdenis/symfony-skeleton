<?php

namespace App\Post\Entity;


class PostBuilder
{
    /**
     * Build post
     *
     * @return Post
     */
    public function build(): Post
    {
        return new Post($this);
    }
}