<?php

namespace App\Upload\Http;


use App\Upload\UploadedFile;
use App\Upload\FileReference;
use League\Flysystem\FilesystemInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/files")
 */
class UploadFileAction
{
    /**
     * @var FilesystemInterface
     */
    private $filesystem;

    public function __construct(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * @Method({"POST"})
     * @Route("/upload")
     *
     * @param UploadFileRequest $request
     * @return FileReference
     */
    public function __invoke(UploadFileRequest $request): FileReference
    {
        $file = new UploadedFile($request->file);

        return $file->save($this->filesystem);
    }
}