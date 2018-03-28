<?php

namespace App\Upload;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Embeddable()
 */
class FileInfo
{
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $originalName;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $extension;

    public function __construct(UploadedFile $file)
    {
        $this->originalName = $file->getClientOriginalName();
        $this->extension = $file->getClientOriginalExtension();
    }

    /**
     * @return string
     */
    public function normalizedExtension(): string
    {
        return $this->extension ? '.' . $this->extension : '';
    }
}