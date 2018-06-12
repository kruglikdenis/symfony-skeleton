<?php

namespace App\User\Http\Transformer;


use App\Core\Http\Transformer;
use App\User\Entity\User;

class UserTransformer extends Transformer
{
    /**
     * @param User $payload
     * @return array
     */
    public function transform($payload): array
    {
        return [
            'id' => $payload->id()
        ];
    }
}