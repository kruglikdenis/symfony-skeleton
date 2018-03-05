<?php

namespace App\User\Entity\Security;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

/**
 * @ORM\Embeddable
 */
class Password implements \Serializable
{
    const SALT_LENGTH = 32;

    /**
     * @var string
     * @ORM\Column(type="string", length=64)
     */
    private $secret;

    /**
     * @var Salt
     * @ORM\Embedded(class="App\User\Entity\Security\Salt")
     */
    private $salt;

    /**
     * @var string
     */
    private $plainPassword;

    public function __construct(string $password, PasswordEncoderInterface $encoder)
    {
        $this->plainPassword = $password;
        $this->salt = new Salt(self::SALT_LENGTH);
        $this->secret = $encoder->encodePassword($password, $this->salt);
    }

    public function secret(): string
    {
        return $this->secret;
    }

    public function salt(): string
    {
        return (string)$this->salt;
    }

    public function plainPassword(): string
    {
        return $this->plainPassword;
    }

    public function serialize()
    {
        return serialize([
            $this->secret,
            $this->salt
        ]);
    }

    public function unserialize($serialized)
    {
        list (
            $this->secret,
            $this->salt
        ) = unserialize($serialized);
    }
}