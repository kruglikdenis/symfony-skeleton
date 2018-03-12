<?php

namespace App\Common\Exception;

class DomainException extends \Exception
{
    const STATUS_CODE = 400;

    const MESSAGE = "";

    public function __construct($message = null, $code = null, \Throwable $previous = null)
    {
        $message = $message ?? static::MESSAGE;
        $code = $code ?? static::STATUS_CODE;

        parent::__construct($message, $code, $previous);
    }

    public function getResponseBody(): array
    {
        return [
            'status_code' => $this->getCode(),
            'message' => $this->getMessage()
        ];
    }
}