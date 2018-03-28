<?php

namespace App\Upload\Http;


use App\Core\Http\BaseAction;
use App\Upload\File;
use App\Upload\Files;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/files")
 */
class UploadFileAction extends BaseAction
{
    /**
     * @var Files
     */
    private $files;

    public function __construct(Files $files)
    {
        $this->files = $files;
    }

    /**
     * @Method({"POST"})
     * @Route("/upload")
     *
     * @param UploadFileRequest $request
     * @return File
     */
    public function __invoke(UploadFileRequest $request): File
    {
        $file = new File($request->file);

        $this->files->add($file);

        $this->flushChanges();

        return $file;
    }
}