<?php

namespace App\Core\Exception;


use Symfony\Component\Validator\ConstraintViolation;

class ValidationException extends DomainException
{
    private $errors;

    public function __construct(\Traversable $errors, string $message = 'Invalid data in request body', int $code = 400)
    {
        parent::__construct($message, $code);

        $this->errors = $errors;
    }

    public function getResponseBody(): array
    {
        return [
            'status_code' => $this->code,
            'message' => $this->message,
            'errors' => array_map(function (ConstraintViolation $violation) {
                return [
                    'path' => $violation->getPropertyPath(),
                    'message' => $violation->getMessage(),
                ];
            }, iterator_to_array($this->errors)),
        ];
    }
}