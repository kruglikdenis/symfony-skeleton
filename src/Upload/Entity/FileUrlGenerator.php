<?php

namespace App\Upload\Entity;


use Symfony\Component\HttpFoundation\File\UploadedFile;

interface FileUrlGenerator
{
    /**
     * @param UploadedFile $file
     * @param null|string $name
     * @return string
     */
    public function generate(UploadedFile $file, ?string $name = null): string;
}