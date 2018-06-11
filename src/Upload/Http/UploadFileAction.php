<?php

namespace App\Upload\Http;


use App\Core\Http\Annotation\ResponseGroups;
use App\Core\Service\Flusher;
use App\Upload\Entity\FileReference;
use App\Upload\Entity\Files;
use App\Upload\Entity\FileSaver;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/files")
 */
class UploadFileAction
{
    /**
     * @Method({"POST"})
     * @Route("/upload")
     * @ResponseGroups({"api_file"})
     *
     * @param UploadFileRequest $request
     * @param Files $files
     * @param FileSaver $saver
     * @param Flusher $flusher
     * @return FileReference
     */
    public function __invoke(UploadFileRequest $request, Files $files, FileSaver $saver, Flusher $flusher): FileReference
    {
        $file = $saver->save($request->file);

        $files->add($file);
        $flusher->flush();

        return $file;
    }
}