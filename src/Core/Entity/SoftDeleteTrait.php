<?php

namespace App\Core\Entity;


use Doctrine\ORM\Mapping as ORM;

class SoftDeleteTrait
{
    /**
     * @var bool
     * @ORM\Column(type="boolean", options={"default":false})
     */
    protected $isDeleted = false;


    public function delete(): void
    {
        $this->isDeleted = true;
    }

    public function isDeleted(): bool
    {
        return $this->isDeleted;
    }
}