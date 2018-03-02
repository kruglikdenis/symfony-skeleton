<?php

namespace App\Users\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Salt
{
    const CHARS = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+?";

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $salt;

    public function __construct(int $length)
    {
        $this->salt = substr(str_shuffle(self::CHARS), 0, $length);
    }

    public function __toString()
    {
        return $this->salt;
    }
}