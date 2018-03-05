<?php

namespace App\Common;


class EntityNotFoundException extends DomainException
{
    const STATUS_CODE_NOT_FOUND = 404;
}