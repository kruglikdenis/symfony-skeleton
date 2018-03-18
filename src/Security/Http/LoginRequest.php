<?php

namespace App\User\Http;

use App\Common\Http\RequestObject;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class LoginRequest extends RequestObject
{
    public $email;

    public $password;

    public function rules()
    {
        return new Assert\Collection([
            'email' => new Assert\Email(['message' => 'Please fill in valid email']),
            'password' => new Assert\Length(['min' => 4, 'minMessage' => 'Password is to short']),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function map(Request $request): void
    {
        $this->email = $request->get('email');
        $this->password = $request->get('password');
    }
}