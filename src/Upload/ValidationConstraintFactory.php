<?php

namespace App\Upload;


use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraint;

class ValidationConstraintFactory
{
    /**
     * Build file
     *
     * @param UploadedFile $file
     * @return Constraint
     */
    public static function create(UploadedFile $file): Constraint
    {
        foreach (static::supportedTypes() as $type) {
            if ($type::support($file)) {
                return $type::validationRule();
            }
        }

        return File::validationRule();
    }

    private static function supportedTypes(): array
    {
        return [
            Image::class
        ];
    }
}