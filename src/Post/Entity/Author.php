<?php

namespace App\Post\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class Author
{
    /**
     * @ORM\Column(type="guid")
     */
    public $userId;

    public function __construct(string $userId)
    {
        $this->userId = $userId;
    }
}