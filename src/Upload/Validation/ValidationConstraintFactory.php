<?php

namespace App\Upload\Validation;


use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraint;

class ValidationConstraintFactory
{
    /**
     * @var FileConstraintCreator[]
     */
    private $supportedTypes;

    /**
     * Build file
     *
     * @param File $file
     * @return Constraint
     */
    public function create(UploadedFile $file): ?Constraint
    {
        foreach ($this->supportedTypes as $type) {
            if ($type->support($file)) {
                return $type->rule();
            }
        }

        return null;
    }

    /**
     * Add validation rule
     *
     * @param FileConstraintCreator $constraint
     * @return ValidationConstraintFactory
     */
    public function add(FileConstraintCreator $constraint): self
    {
        $this->supportedTypes[] = $constraint;

        return $this;
    }
}