<?php

namespace App\User\Entity\Security;


use Symfony\Component\Serializer\Annotation\Groups;

class AuthToken
{
    /**
     * @var string
     * @Groups({"api_login"})
     */
    private $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function token()
    {
        return $this->token;
    }
}