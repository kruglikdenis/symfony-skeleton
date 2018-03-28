<?php

namespace App\Upload;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileWasAttached
{
    /**
     * @var UploadedFile
     */
    private $file;

    /**
     * @var string
     */
    private $name;

    public function __construct(UploadedFile $file, string $name)
    {
        $this->file = $file;
        $this->name = $name;
    }

    /**
     * @return UploadedFile
     */
    public function file(): UploadedFile
    {
        return $this->file;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }
}