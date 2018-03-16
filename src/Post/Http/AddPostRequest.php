<?php

namespace App\Post\Http;

use App\Common\Http\RequestObject;
use App\Post\Entity\Author;
use App\Upload\FileReference;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class AddPostRequest extends RequestObject
{
    public $author;

    public $description;

    public $media;

    public function rules()
    {
        return new Assert\Collection([
            'author' => new Assert\NotBlank(),
            'description' => new Assert\NotBlank(),
            'media' => new Assert\NotBlank(),
        ]);
    }

    public function map(Request $request): void
    {
        $user = $request->attributes->get('author');

        $this->author = new Author($user->id);
        $this->description = $request->get('description');
        $this->media = FileReference::url($request->get('media'));
    }
}