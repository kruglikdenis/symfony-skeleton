<?php

namespace App\Upload;


use Symfony\Component\HttpFoundation\File\File;

interface FileUploader
{
    public function upload(File $file);
}