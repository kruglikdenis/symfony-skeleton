<?php

namespace App\Upload;


use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints as Assert;

class Image extends File
{
    public const UPLOAD_PATH = 'images';

    public const MIME_TYPES = [
        'image/jpeg',
        'image/jpg',
        'image/png'
    ];

    public static function validationRule(): Constraint
    {
        return new Assert\Image([
            'maxSize' => '10M',
            'mimeTypes' => static::MIME_TYPES,
            'minWidth' => 50,
            'minHeight' => 50,
            'mimeTypesMessage' => "Allowed file extensions *.jpeg, *.jpg, *.png."
        ]);
    }

    public static function support(UploadedFile $file): bool
    {
        return in_array($file->getMimeType(), static::MIME_TYPES);
    }
}