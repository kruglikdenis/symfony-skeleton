<?php

namespace App\Post\Http;

use App\Core\Http\RequestObject;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class AddPostRequest extends RequestObject
{
    public $description;

    public function rules()
    {
        return new Assert\Collection([
            'description' => new Assert\NotBlank()
        ]);
    }

    public function map(Request $request): void
    {
        $this->description = $request->get('description');
    }
}