<?php

namespace App\Security\Entity;

use App\Core\Entity\UUIDTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="credentials")
 */
class Credential implements UserInterface
{
    use UUIDTrait;

    /**
     * @var string
     * @ORM\Embedded(class="App\Security\Entity\Email", columnPrefix=false)
     */
    private $email;

    /**
     * @var Password
     * @ORM\Embedded(class="App\Security\Entity\Password", columnPrefix=false)
     */
    private $password;

    /**
     * @var array
     * @ORM\Column(type="json_array", options={"jsonb": true})
     */
    private $roles;

    public function __construct(string $id, Email $email, Password $password, array $roles)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->roles = $roles;
    }

    /**
     * @return Email
     */
    public function email(): Email
    {
        return $this->email;
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
        return (string) $this->email;
    }

    public function eraseCredentials()
    {
    }
}