<?php

namespace App\Upload;


use App\Core\Exception\DomainException;

class FileNotFoundException extends DomainException
{
    const STATUS_CODE = 404;
}