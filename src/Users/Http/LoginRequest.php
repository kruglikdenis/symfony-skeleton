<?php

namespace App\Users\Action;

use Fesor\RequestObject\ErrorResponseProvider;
use Fesor\RequestObject\PayloadResolver;
use Fesor\RequestObject\RequestObject;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class LoginRequest extends RequestObject implements ErrorResponseProvider, PayloadResolver
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
    }

    /**
     * {@inheritdoc}
     */
    public function getErrorResponse(ConstraintViolationListInterface $errors)
    {
        return new JsonResponse([
            'message' => 'Please check your data',
            'errors' => array_map(function (ConstraintViolation $violation) {
                return [
                    'path' => $violation->getPropertyPath(),
                    'message' => $violation->getMessage(),
                ];
            }, iterator_to_array($errors)),
        ], 400);
    }
}