<?php

namespace App\Post\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class Media
{
    /**
     * @ORM\Column(type="guid", nullable=true)
     */
    private $fileId;

    public function __construct(string $id)
    {
        $this->fileId = $id;
    }

    public function __toString(): string
    {
        return $this->fileId;
    }
}