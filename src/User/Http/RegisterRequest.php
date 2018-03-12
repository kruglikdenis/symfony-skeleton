<?php

namespace App\User\Http;


use App\Common\Http\RequestObject;
use Fesor\RequestObject\PayloadResolver;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterRequest extends RequestObject implements PayloadResolver
{
    public $email;

    public $password;

    public $firstName;

    public $lastName;

    public $middleName;

    public function rules()
    {
        return new Assert\Collection([
            'email' => new Assert\Email(['message' => 'Please fill in valid email']),
            'password' => new Assert\Length(['min' => 4, 'minMessage' => 'Password is to short']),
            'first_name' => new Assert\NotBlank(),
            'last_name' => new Assert\NotBlank(),
            'middle_name' => new Assert\NotBlank(),
        ]);
    }

    public function resolvePayload(Request $request)
    {
        $this->email = $request->get('email');
        $this->password = $request->get('password');
        $this->firstName = $request->get('first_name');
        $this->lastName = $request->get('last_name');
        $this->middleName = $request->get('middle_name');

        return $request->request->all();
    }
}