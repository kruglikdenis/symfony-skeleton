<?php

namespace App\Upload;


use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FlysystemSaver implements FileSaver
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    public function __construct(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * @inheritdoc
     */
    public function save(UploadedFile $file): File
    {
        $info = new FileInfo($file);

        $stream = fopen($file->getRealPath(), 'r+');
        $this->filesystem->writeStream($info->name(), $stream);
        fclose($stream);

        return new File($info);
    }
}