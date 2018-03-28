<?php

namespace App\Upload;


use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemInterface;

class UploadFileAfterAttachListener
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    public function __construct(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function __invoke(FileWasAttached $event)
    {
        $file = $event->file();

        $stream = fopen($file->getRealPath(), 'r+');

        $this->filesystem->writeStream($event->name(), $stream);

        fclose($stream);
    }
}