<?php

namespace App\Upload;


use Symfony\Component\HttpFoundation\File\UploadedFile;

interface FileSaver
{
    /**
     * Save file to system
     *
     * @param UploadedFile $file
     * @return File
     */
    public function save(UploadedFile $file): File;
}