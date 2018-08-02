<?php

namespace App\Post\Http;

use App\Core\Http\RequestDto;
use Symfony\Component\Validator\Constraints as Assert;

class AddPostRequest implements RequestDto
{
    /**
     * @Assert\NotBlank()
     */
    public $title;

    /**
     * @Assert\Uuid()
     * @Assert\NotBlank()
     */
    public $media;

    /**
     * @Assert\NotBlank()
     */
    public $description;
}
