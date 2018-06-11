<?php

namespace App\Upload\Handler;


use App\Upload\Entity\Files;
use App\Upload\Entity\FileSaver;
use App\Upload\Http\UploadCommand;
use Broadway\CommandHandling\SimpleCommandHandler;

class UploadHandler extends SimpleCommandHandler
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

    public function handleUploadCommand(UploadCommand $command): void
    {
        $file = $this->saver->save($command->file());

        $this->files->add($file);
    }
}