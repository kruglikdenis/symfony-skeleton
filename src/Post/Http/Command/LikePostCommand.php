<?php

namespace App\Post\Http\Command;


use App\Core\Http\CommandPayloadTrait;

class LikePostCommand
{
    use CommandPayloadTrait;

    /**
     * @var string
     */
    private $postId;

    /**
     * @var string
     */
    private $likerId;

    public function __construct(string $postId, string $likerId)
    {
        $this->postId = $postId;
        $this->likerId = $likerId;
    }

    /**
     * @return string
     */
    public function postId(): string
    {
        return $this->postId;
    }

    /**
     * @return string
     */
    public function likerId(): string
    {
        return $this->likerId;
    }
}