<?php

namespace App\Upload\Http;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadCommand
{
    /**
     * @var UploadedFile
     */
    private $file;

    public function __construct(UploadedFile $file)
    {
        $this->file = $file;
    }

    /**
     * @return UploadedFile
     */
    public function file(): UploadedFile
    {
        return $this->file;
    }
}