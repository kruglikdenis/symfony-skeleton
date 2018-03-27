<?php

namespace App\Upload;


use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints as Assert;

final class DefaultConstraint implements FileConstraint
{
    /**
     * @inheritdoc
     */
    public function rule(): Constraint
    {
        return new Assert\File([
            'maxSize' => '50M',
            'maxSizeMessage' => "The maximum allowed file size is 50MB.",
        ]);
    }

    /**
     * @inheritdoc
     */
    public function support(UploadedFile $file): bool
    {
        return true;
    }
}