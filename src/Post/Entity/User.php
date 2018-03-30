<?php

namespace App\Post\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class User
{
    /**
     * @ORM\Column(type="guid")
     */
    public $userId;

    public function __construct(string $userId)
    {
        $this->userId = $userId;
    }

    public function __toString(): string
    {
        return $this->userId;
    }
}