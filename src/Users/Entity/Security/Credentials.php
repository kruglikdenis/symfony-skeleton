<?php

namespace App\Users\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="credentials")
 */
class Credentials implements UserInterface, \Serializable
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
    private $identity;

    /**
     * @var Password
     * @ORM\Embedded(class="App\Users\Entity\Password")
     */
    private $password;

    /**
     * @var array
     * @ORM\Column(type="json_array", options={"jsonb": true})
     */
    private $roles;

    public function __construct(User $identity, Password $password, array $roles)
    {
        $this->id = Uuid::uuid4();
        $this->identity = $identity;
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
        return $this->identity;
    }

    public function eraseCredentials()
    {
    }

    public function serialize()
    {
        return serialize([
            $this->id,
            $this->identity,
            $this->password,
            $this->roles
        ]);
    }

    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->identity,
            $this->password,
            $this->roles
        ) = unserialize($serialized);
    }
}