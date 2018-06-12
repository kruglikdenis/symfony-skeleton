<?php

namespace App\Post\Http\Transformer;


use App\Core\Http\Transformer;
use App\Post\Entity\Post;

class LikeTransformer extends Transformer
{
    /**
     * @param Post $payload
     * @return array
     */
    public function transform($payload): array
    {
        return [
            'count_likes' => $payload->countLikes()
        ];
    }
}