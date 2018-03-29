<?php

namespace App\Upload;

use App\Upload\Exception\FileNotValidException;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Embeddable()
 */
class FileInfo
{
    /**
     * @var string
     *
     * @Groups({"api_file"})
     * @ORM\Embedded(class="App\Upload\FileName", columnPrefix=false)
     */
    private $name;

    /**
     * @var string
     *
     * @Groups({"api_file"})
     * @ORM\Column(type="string")
     */
    private $originalName;

    public function __construct(UploadedFile $file)
    {
        if (!$file->isValid()) {
            throw new FileNotValidException();
        }

        $this->name = new FileName($file->getClientOriginalExtension());
        $this->originalName = $file->getClientOriginalName();
    }

    /**
     * Get file name
     *
     * @return FileName
     */
    public function name(): FileName
    {
        return $this->name;
    }
}