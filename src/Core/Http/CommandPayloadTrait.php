<?php

namespace App\Core\Http;


trait CommandPayloadTrait
{
    /**
     * @var mixed
     */
    private $payload;

    public function withPayload($payload)
    {
        $this->payload = $payload;
    }

    public function payload()
    {
        return $this->payload;
    }
}