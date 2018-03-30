<?php

namespace App\Post\Entity;


interface Posts
{
    /**
     * Retrieve post by id
     *
     * @param string $id
     * @return Post
     */
    public function retrieveById(string $id): Post;

    /**
     * Add post
     *
     * @param Post $post
     */
    public function add(Post $post): void;
}