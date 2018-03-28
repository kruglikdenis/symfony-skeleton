<?php

namespace App\Upload\Http;

use App\Core\Http\BaseAction;
use App\Upload\FileNotFoundException;
use League\Flysystem\Adapter\AbstractAdapter;
use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
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
     * @Route("/{path}")
     *
     * @param $path
     * @throws FileNotFoundException
     * @return Response
     */
    public function __invoke(string $path)
    {
        if(!$this->filesystem->has($path)) {
            throw new FileNotFoundException();
        }

        /** @var AbstractAdapter $adapter */
        $adapter = $this->filesystem->getAdapter();
        $path = $adapter->applyPathPrefix($path);

        return new BinaryFileResponse($path);
    }
}