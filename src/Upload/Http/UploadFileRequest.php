<?php

namespace App\Upload\Http;


use App\Core\Http\RequestObject;
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

    private $rules = [];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return new Assert\Collection([
            'file' => array_merge(
                [
                    new Assert\NotBlank()
                ],
                $this->rules
            )
        ]);
    }

    /**
     * @inheritdoc
     */
    public function map(Request $request): void
    {
        $this->file = $request->files->get('file');

        if (null !== $this->file) {
            $this->rules = [ ValidationConstraintFactory::create($this->file) ];
        }
    }
}