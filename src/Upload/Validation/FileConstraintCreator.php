<?php

namespace App\Upload\Validation;


use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraint;

interface FileConstraintCreator
{
    /**
     * Get rule for validation
     *
     * @return Constraint
     */
    public function rule(): Constraint;

    /**
     * Is support this type
     *
     * @param UploadedFile $file
     * @return bool
     */
    public function support(UploadedFile $file): bool;
}