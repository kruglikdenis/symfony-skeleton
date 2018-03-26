<?php

namespace App\Upload;


use App\Core\Http\RequestObject;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class UploadFileRequest extends RequestObject
{
    private $file;

    public function resolvePayload(Request $request)
    {


        return parent::resolvePayload($request);
    }

    public function getErrorResponse(ConstraintViolationListInterface $errors)
    {
        return parent::getErrorResponse($errors);
    }
}