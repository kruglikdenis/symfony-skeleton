<?php

namespace App\Upload;


use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints as Assert;

class File
{
    /**
     * @var UploadedFile
     */
    private $file;

    public function __construct(UploadedFile $file)
    {
        $this->file = $file;
    }

    /**
     * Get uploaded file
     *
     * @return UploadedFile
     */
    public function uploadedFile(): UploadedFile
    {
        return $this->file;
    }

    /**
     * Get rule for validation
     *
     * @return Constraint
     */
    public function validationRule(): Constraint
    {
        return new Assert\File([
            'maxSize' => '50M',
            'maxSizeMessage' => "The maximum allowed file size is 50MB.",
        ]);
    }
}