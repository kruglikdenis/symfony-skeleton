<?php

namespace App\User\Entity\Security;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="credentials")
 */
class Credentials implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $identify;

    /**
     * @var Password
     * @ORM\Embedded(class="App\User\Entity\Security\Password", columnPrefix=false)
     */
    private $password;

    /**
     * @var array
     * @ORM\Column(type="json_array", options={"jsonb": true})
     */
    private $roles;


    public function __construct(Identifiable $user, Password $password, array $roles)
    {
        $this->id = $user->uuid();
        $this->identify = $user->identify();
        $this->password = $password;
        $this->roles = $roles;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getPassword()
    {
        return $this->password->secret();
    }

    public function getSalt()
    {
        return $this->password->salt();
    }

    public function getUsername()
    {
        return $this->identify;
    }

    public function eraseCredentials()
    {
    }
}