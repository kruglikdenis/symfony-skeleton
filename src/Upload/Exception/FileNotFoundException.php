<?php

namespace App\Upload\Exception;


use App\Core\Exception\DomainException;

class FileNotFoundException extends DomainException
{
    const STATUS_CODE = 404;

    const MESSAGE = 'File not found!';
}