<?php

namespace App\Upload\Http;


use App\Core\Service\Dispatcher;
use App\Core\Service\Flusher;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/files")
 */
class UploadFileAction extends Controller
{
    /**
     * @Method({"POST"})
     * @Route("/upload")
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