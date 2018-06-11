<?php

namespace App\Upload\Http;


use App\Core\Http\Annotation\ResponseGroups;
use App\Core\Service\Dispatcher;
use App\Core\Service\Flusher;
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
     * @param Dispatcher $dispatcher
     * @param Flusher $flusher
     */
    public function __invoke(UploadFileRequest $request, Dispatcher $dispatcher, Flusher $flusher)
    {
        $dispatcher->dispatch(
            new UploadCommand($request->file)
        );

        $flusher->flush();
    }
}