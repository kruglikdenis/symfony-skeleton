<?php

namespace App\Post\Http\Transformer;


use App\Core\Http\Transformer;
use App\Post\Entity\Post;

class PostTransformer extends Transformer
{
    /**
     * @param Post $payload
     * @return array
     */
    public function transform($payload): array
    {
        return [
            'id' => $payload->id(),
            'title' => $this->get('title', $payload),
            'description' => $this->get('description', $payload),
            'count_likes' => $payload->countLikes()
        ];
    }
}