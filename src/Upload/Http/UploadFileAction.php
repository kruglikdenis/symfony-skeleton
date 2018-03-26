<?php

namespace App\Upload\Http;


use App\Upload\File;
use App\Upload\FileReference;
use League\Flysystem\Filesystem;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/files")
 */
class UploadFileAction
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    public function __construct(Filesystem $filesystem)
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
        $file = new File($request->file);

        return $file->write($this->filesystem);
    }
}