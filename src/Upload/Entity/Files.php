<?php

namespace App\Upload\Entity;


interface Files
{
    /**
     * Add file
     *
     * @param FileReference $file
     */
    public function add(FileReference $file): void;
}