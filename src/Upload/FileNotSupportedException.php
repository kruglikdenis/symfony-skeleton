<?php

namespace App\Upload;


use App\Core\Exception\DomainException;

class FileNotSupportedException extends DomainException
{
    const MESSAGE = 'File is not supported';
}