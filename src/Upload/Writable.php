<?php

namespace App\Upload;


use League\Flysystem\Filesystem;

interface Writable
{
    public function write(Filesystem $filesystem): FileReference;
}