<?php

namespace App\Upload;


use League\Flysystem\FilesystemInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile as HttpUploadedFile;

class UploadedFile
{
    /**
     * @var HttpUploadedFile
     */
    private $file;

    /**
     * @var string|null
     */
    private $name;

    public function __construct(HttpUploadedFile $file)
    {
        if (!$file->isValid()) {
            throw new FileNotValidException();
        }

        $this->file = $file;
    }

    /**
     * Save file
     *
     * @param FilesystemInterface $filesystem
     * @return FileReference
     */
    public function save(FilesystemInterface $filesystem): FileReference
    {
        $stream = fopen($this->file->getRealPath(), 'r+');
        $this->name = $this->generateName();
        $filesystem->writeStream($this->name, $stream);
        fclose($stream);

        return FileReference::url($this->name);
    }

    /**
     * Get file name
     *
     * @return string
     */
    private function generateName(): string
    {
        $ext = $this->extension();
        $filename = sha1(uniqid(mt_rand(), true));

        return $filename . ($ext ? '.' . $ext : '');
    }


    /**
     * Get extension
     *
     * @return null|string
     */
    private function extension(): ?string
    {
        return $this->file->getClientOriginalExtension();
    }
}