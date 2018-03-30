<?php

namespace App\Upload\Http;


use App\Core\Http\Annotation\ResponseGroups;
use App\Core\Http\BaseAction;
use App\Upload\File;
use App\Upload\Files;
use App\Upload\FileSaver;
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

    /**
     * @var FileSaver
     */
    private $saver;

    public function __construct(Files $files, FileSaver $saver)
    {
        $this->files = $files;
        $this->saver = $saver;
    }

    /**
     * @Method({"POST"})
     * @Route("/upload")
     * @ResponseGroups({"api_file"})
     *
     * @param UploadFileRequest $request
     * @return File
     */
    public function __invoke(UploadFileRequest $request): File
    {
        $file = $this->saver->save($request->file);

        $this->files->add($file);

        $this->flushChanges();

        return $file;
    }
}