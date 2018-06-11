<?php

namespace App\Post\Http;


class AddPostCommand
{
    /**
     * @var AddPostRequest
     */
    private $request;

    private $authorId;

    public function __construct(AddPostRequest $request, string $authorId)
    {
        $this->request = $request;
        $this->authorId = $authorId;
    }

    /**
     * @return AddPostRequest
     */
    public function request(): AddPostRequest
    {
        return $this->request;
    }

    /**
     * @return string
     */
    public function authorId(): string
    {
        return $this->authorId;
    }
}