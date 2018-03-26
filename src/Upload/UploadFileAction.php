<?php

namespace App\Upload;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/files")
 */
class UploadFileAction
{
    /**
     * @var FileUploader
     */
    private $uploader;

    public function __construct(FileUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    /**
     * @Method({"POST"})
     * @Route("/upload")
     *
     * @param UploadFileRequest $request
     */
    public function __invoke(UploadFileRequest $request)
    {
        $i = 0;
    }
}