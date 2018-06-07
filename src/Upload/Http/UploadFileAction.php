<?php

namespace App\Upload\Http;


use App\Core\Doctrine\Flush;
use App\Core\Http\Annotation\ResponseGroups;
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
     * @param Flush $flush
     * @return FileReference
     */
    public function __invoke(UploadFileRequest $request, Files $files, FileSaver $saver, Flush $flush): FileReference
    {
        $file = $saver->save($request->file);

        $files->add($file);
        $flush();

        return $file;
    }
}