<?php

namespace App\Post\Entity;

use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="tags")
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $tag;

    public function __construct(string $tag)
    {
        $this->id = Uuid::uuid4();
        $this->tag = $tag;
    }

    public function __toString()
    {
        return $this->tag;
    }
}