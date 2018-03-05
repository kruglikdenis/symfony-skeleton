<?php

namespace App\User\Http;

use App\Common\Http\RequestObject;
use Fesor\RequestObject\PayloadResolver;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class LoginRequest extends RequestObject implements PayloadResolver
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

    public function resolvePayload(Request $request)
    {
        $this->email = $request->get('email');
        $this->password = $request->get('password');

        return $request->request->all();
    }
}