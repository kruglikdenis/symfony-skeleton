<?php

namespace App\Upload\Exception;


use App\Core\Exception\DomainException;

class FileNotValidException extends DomainException
{
    const MESSAGE = 'File is not valid';
}