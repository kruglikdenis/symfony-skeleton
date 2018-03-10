<?php

namespace App\User\Entity;

use App\User\Entity\Security\Credentials;
use App\User\Entity\Security\Email;
use App\User\Entity\Security\Password;
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
     * @ORM\Embedded(class="App\User\Entity\FullName")
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