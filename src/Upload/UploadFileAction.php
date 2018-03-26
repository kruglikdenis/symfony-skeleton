<?php

namespace App\Upload;


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

    public function __invoke()
    {
        // TODO: Implement __invoke() method.
    }
}