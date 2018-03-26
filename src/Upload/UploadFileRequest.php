<?php

namespace App\Upload;


use App\Core\Http\RequestObject;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;


class UploadFileRequest extends RequestObject
{
    /**
     * @var File
     */
    public $file;

    private $rules = [];

    public function rules()
    {
        return new Assert\Collection([
            'file' => array_merge([
                new Assert\NotBlank() ],
                $this->rules
            )
        ]);
    }

    public function map(Request $request): void
    {
        $uploadedFile = $request->files->get('file');

        if ($uploadedFile) {
            $this->file = new File($uploadedFile);
            $this->rules = [ $this->file->validationRule() ];
        }
    }
}