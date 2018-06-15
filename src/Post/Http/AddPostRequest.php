<?php

namespace App\Post\Http;

use App\Core\Http\RequestObject;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class AddPostRequest extends RequestObject
{
    public $title;

    public $media;

    public $description;

    public function rules()
    {
        return new Assert\Collection([
            'title' => new Assert\NotBlank(),
            'media_id' => new Assert\NotBlank(),
            'description' => new Assert\NotBlank()
        ]);
    }

    public function map(Request $request): void
    {
        $this->title = $request->get('title');
        $this->description = $request->get('description');
        $this->media = $request->get('media_id');
    }
}