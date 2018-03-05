<?php

namespace App\User\Entity\Security;

use App\Common\InvalidArgumentException;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Email
{
    /**
     * @var string
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    public function __construct(string $email)
    {
        $email = $this->normalize($email);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(sprintf('"%s" is not a valid email', $email));
        }

        $this->email = $email;
    }

    public function __toString(): string
    {
        return $this->email;
    }

    private function normalize($email)
    {
        return strtolower(trim($email));
    }
}