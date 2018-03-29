<?php

namespace App\Upload\Http;

use App\Core\Http\BaseAction;
use App\Upload\File;
use App\Upload\Exception\FileNotFoundException;
use League\Flysystem\Adapter\AbstractAdapter;
use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/files")
 */
class RetrieveFileAction extends BaseAction
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    public function __construct(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * @Method({"GET"})
     * @Route("/{id}")
     * @ParamConverter(
     *     "file",
     *     class="App\Upload\File",
     *     options={
     *         "repository_method" = "retrieveById"
     *     }
     * )
     *
     * @param File $file
     * @throws FileNotFoundException
     * @return Response
     */
    public function __invoke(File $file)
    {
        $path = $file->name();
        if(!$this->filesystem->has($path)) {
            throw new FileNotFoundException();
        }

        /** @var AbstractAdapter $adapter */
        $adapter = $this->filesystem->getAdapter();
        $path = $adapter->applyPathPrefix($path);

        return new BinaryFileResponse($path);
    }
}