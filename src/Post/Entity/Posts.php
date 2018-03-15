<?php

namespace App\Post\Entity;


interface Posts
{
    public function add(Post $post): void;
}