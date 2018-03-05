<?php

namespace App\Common\Exception;


use Throwable;

class EntityNotFoundException extends DomainException
{
    const STATUS_CODE_NOT_FOUND = 404;

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, self::STATUS_CODE_NOT_FOUND, $previous);
    }
}