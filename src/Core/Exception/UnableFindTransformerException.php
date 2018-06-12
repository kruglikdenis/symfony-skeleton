<?php

namespace App\Core\Exception;


class UnableFindTransformerException extends DomainException
{
    const STATUS_CODE = 500;

    const MESSAGE = "Unable to find transformer";
}