<?php

namespace App\Upload\Entity;


use Symfony\Component\HttpFoundation\File\UploadedFile;

interface FileSaver
{
    /**
     * Save file to system
     *
     * @param UploadedFile $file
     * @return FileReference
     */
    public function save(UploadedFile $file): FileReference;
}