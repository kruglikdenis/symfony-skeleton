<?php

namespace App\Upload\Service;


use App\Upload\Entity\FileReference;
use App\Upload\Entity\FileSaver;
use App\Upload\Entity\FileUrlGenerator;
use League\Flysystem\FilesystemInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FlysystemSaver implements FileSaver
{
    /**
     * @var FilesystemInterface
     */
    private $filesystem;

    /**
     * @var FileUrlGenerator
     */
    private $urlGenerator;

    public function __construct(FilesystemInterface $filesystem, FileUrlGenerator $urlGenerator)
    {
        $this->filesystem = $filesystem;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @inheritdoc
     */
    public function save(UploadedFile $file): FileReference
    {
        $reference = new FileReference($file, $this->urlGenerator);

        $this->deleteExistingFile($reference->path());
        $this->saveUploadedFile($file->getRealPath(), $reference->path(), $reference->mimeType());

        return $reference;
    }

    /**
     * @param string $path
     */
    private function deleteExistingFile(string $path): void
    {
        try {
            $this->filesystem->delete($path);
        } catch (\Exception $exception) {
        }
    }

    /**
     * Save uploaded file to system
     *
     * @param string $realPath
     * @param string $path
     * @param string $mimeType
     */
    private function saveUploadedFile(string $realPath, string $path, string $mimeType): void
    {
        $stream = fopen($realPath, 'r+');
        $this->filesystem->writeStream($path, $stream, [ 'mimetype' => $mimeType ]);
        fclose($stream);
    }
}