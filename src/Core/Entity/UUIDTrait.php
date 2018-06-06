<?php

namespace App\Core\Entity;


use Ramsey\Uuid\Uuid;

trait UUIDTrait
{
    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(type="guid")
     */
    protected $id;

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function generateUuid(): string
    {
        return Uuid::uuid4()->toString();
    }
}