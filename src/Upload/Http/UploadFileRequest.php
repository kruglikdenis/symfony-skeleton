<?php

namespace App\Upload\Http;


use App\Core\Http\RequestDto;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;


class UploadFileRequest implements RequestDto
{
    /**
     * @Assert\File(
     *     maxSize = '10MB',
     *     maxSizeMessage = 'The maximum allowed file size is 50MB.'
     * )
     *
     * @var UploadedFile
     */
    public $file;
}
