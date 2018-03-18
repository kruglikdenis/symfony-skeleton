<?php

namespace App\User\Entity\Security\Exception;


use App\Common\Exception\DomainException;

class PasswordNotMatchedException extends DomainException
{
    const MESSAGE = 'Password does not match';

    const STATUS_CODE = 401;
}