<?php

namespace App\User\Http;


class RegisterCommand
{
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