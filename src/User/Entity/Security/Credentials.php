<?php

namespace App\User\Entity\Security;

use App\User\Entity\User;
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
     * @ORM\Embedded(class="App\User\Entity\Security\Email", columnPrefix=false)
     */
    private $email;

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


    public function __construct(Email $email, Password $password, array $roles)
    {
        $this->id = Uuid::uuid4();
        $this->email = $email;
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