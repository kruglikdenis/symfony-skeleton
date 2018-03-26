<?php

namespace App\Upload;


use App\Core\Exception\DomainException;

class FileNotValidException extends DomainException
{
    const MESSAGE = 'File is not valid';
}