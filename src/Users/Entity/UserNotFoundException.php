<?php

namespace App\Users\Entity;


use App\Common\EntityNotFoundException;
use Throwable;

class UserNotFoundException extends EntityNotFoundException
{
    const USER_NOT_FOUND_MESSAGE = 'User not found!';

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct(self::USER_NOT_FOUND_MESSAGE, self::STATUS_CODE_NOT_FOUND, $previous);
    }
}