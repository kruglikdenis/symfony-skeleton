<?php

namespace App\Upload\Http;


use App\Core\Http\RequestObject;
use App\Upload\DefaultConstraint;
use App\Upload\ImageConstraint;
use App\Upload\ValidationConstraintFactory;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;


class UploadFileRequest extends RequestObject
{
    /**
     * @var UploadedFile
     */
    public $file;

    /**
     * @var ValidationConstraintFactory
     */
    private $validationFactory;

    public function __construct()
    {
        $this->validationFactory = new ValidationConstraintFactory();
        $this->validationFactory
            ->add(new ImageConstraint())
            ->add(new DefaultConstraint());
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = [ new Assert\NotBlank() ];
        if (null !== $this->file) {
            $rules[] = $this->validationFactory->create($this->file);
        }

        return new Assert\Collection([
            'file' => $rules
        ]);
    }

    /**
     * @inheritdoc
     */
    public function map(Request $request): void
    {
        $this->file = $request->files->get('file');
    }
}