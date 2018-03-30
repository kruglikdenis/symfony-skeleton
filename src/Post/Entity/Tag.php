<?php

namespace App\Post\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="tags")
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     *
     * @Groups({"api_post"})
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     *
     * @Groups({"api_post"})
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