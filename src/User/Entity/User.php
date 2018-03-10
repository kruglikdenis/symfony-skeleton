<?php

namespace App\User\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;


/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
{
    const USER_ROLE = 'USER_ROLE';

    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @var FullName
     * @ORM\Embedded(class="App\User\Entity\FullName", columnPrefix="false")
     */
    private $fullName;

    public function __construct(UserBuilder $builder)
    {
        $this->id = Uuid::uuid4();
    }

    public static function builder(): UserBuilder
    {
        return new UserBuilder();
    }
}