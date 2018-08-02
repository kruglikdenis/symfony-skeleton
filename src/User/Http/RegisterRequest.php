<?php

namespace App\User\Http;


use App\Core\Http\RequestDto;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterRequest implements RequestDto
{
    /**
     * @Assert\Email(message = "Please fill in valid email")
     * @Assert\NotBlank()
     */
    public $email;

    /**
     * @Assert\Length(min = 4, minMessage = "Password is to short")
     * @Assert\NotBlank()
     */
    public $password;

    /**
     * @Assert\NotBlank()
     */
    public $firstName;

    /**
     * @Assert\NotBlank()
     */
    public $lastName;

    /**
     * @Assert\NotBlank()
     */
    public $middleName;
}
