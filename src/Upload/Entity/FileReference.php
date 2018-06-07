<?php

namespace App\Upload\Entity;


use App\Core\Entity\UUIDTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Upload\FileRepository")
 * @ORM\Table(name="files")
 */
class FileReference
{
    use UUIDTrait;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     *
     * @Groups({"api_file"})
     */
    private $path;

    /**
     * @var string
     * @ORM\Column(type="string")
     *
     * @Groups({"api_file"})
     */
    private $originalName;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     *
     * @Groups({"api_file"})
     */
    private $mimeType;

    public function __construct(UploadedFile $file, FileUrlGenerator $urlGenerator)
    {
        $this->id = $this->generateUuid();

        $this->path = $urlGenerator->generate($file, $this->id);
        $this->originalName = $file->getClientOriginalName();
        $this->mimeType = $file->getClientMimeType();
    }

    public function path(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function mimeType(): string
    {
        return $this->mimeType;
    }
}