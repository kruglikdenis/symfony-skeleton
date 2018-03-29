<?php

namespace App\Upload;


interface Files
{
    /**
     * Retrieve file by id
     *
     * @param string $id
     * @return File
     */
    public function retrieveById(string $id): File;

    /**
     * Add file
     *
     * @param File $file
     */
    public function add(File $file): void;
}