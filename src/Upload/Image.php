<?php

namespace App\Upload;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints as Assert;

class Image extends File
{
    public function validationRule(): Constraint
    {
        return new Assert\Image([
            'maxSize' => '10M',
            'mimeTypes' => [
                'image/jpeg',
                'image/jpg',
                'image/png',
            ],
            'minWidth' => 50,
            'minHeight' => 50,
            'mimeTypesMessage' => "Allowed file extensions *.jpeg, *.jpg, *.png."
        ]);
    }
}