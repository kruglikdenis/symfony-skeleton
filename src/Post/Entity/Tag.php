<?php

namespace App\Post\Entity;

use App\Core\Entity\UUIDTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="tags")
 */
class Tag
{
    use UUIDTrait;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $tag;

    public function __construct(string $tag)
    {
        $this->id = $this->generateUuid();

        $this->tag = $tag;
    }
}