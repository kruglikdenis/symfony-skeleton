<?php

namespace App\User\Http;


use App\Core\Http\CommandPayloadTrait;

class RegisterCommand
{
    use CommandPayloadTrait;

    /**
     * @var RegisterRequest
     */
    private $request;

    public function __construct(RegisterRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @return RegisterRequest
     */
    public function request(): RegisterRequest
    {
        return $this->request;
    }
}