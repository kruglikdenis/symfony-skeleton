<?php

namespace App\Users\Entity;

use App\Users\Entity\Security\Identifiable;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;


/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User implements Identifiable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @var FullName
     * @ORM\Embedded(class="App\Users\Entity\FullName")
     */
    private $fullName;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $email;

    public function __construct()
    {
        $this->id = Uuid::uuid4();
    }

    public function identity(): string
    {
        return $this->email;
    }
}