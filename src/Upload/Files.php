<?php

namespace App\Upload;


interface Files
{
    /**
     * Add file
     *
     * @param File $file
     */
    public function add(File $file): void;
}