<?php

namespace App\Upload;


use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraint;

class ValidationConstraintFactory
{
    /**
     * @var FileConstraint[]
     */
    private $supportedTypes;

    /**
     * Build file
     *
     * @param UploadedFile $file
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
     * @param FileConstraint $constraint
     * @return ValidationConstraintFactory
     */
    public function add(FileConstraint $constraint): self
    {
        $this->supportedTypes[] = $constraint;

        return $this;
    }
}