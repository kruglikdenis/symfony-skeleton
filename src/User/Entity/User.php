<?php

namespace App\User\Entity;

use App\User\Entity\Security\Email;
use App\User\Entity\Security\Identifiable;
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
     * @ORM\Embedded(class="App\User\Entity\FullName")
     */
    private $fullName;

    /**
     * @var Email
     * @ORM\Embedded(class="App\User\Entity\Security\Email", columnPrefix=false)
     */
    private $email;

    public function __construct(UserBuilder $builder)
    {
        $this->id = Uuid::uuid4();
    }

    public static function builder(): UserBuilder
    {
        return new UserBuilder();
    }

    public function uuid(): string
    {
        return $this->id;
    }

    public function identify(): string
    {
        return (string) $this->email;
    }
}