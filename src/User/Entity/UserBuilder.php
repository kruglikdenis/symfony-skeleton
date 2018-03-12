<?php

namespace App\User\Entity;


use App\User\Entity\Security\Credential;
use App\User\Entity\Security\Email;
use App\User\Entity\Security\Password;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class UserBuilder
{
    /**
     * @var FullName
     */
    private $fullName;

    /**
     * @var Email
     */
    private $email;

    /**
     * @var Password
     */
    private $password;

    public function build(): User
    {
        return new User($this);
    }

    public function setEmail(string $email): self
    {
        $this->email = new Email($email);

        return $this;
    }

    public function setPassword(string $password, EncoderFactoryInterface $encoder): self
    {
        $this->password = new Password($password, $encoder->getEncoder(Credential::class));

        return $this;
    }

    public function setFullName(string $firstName, string $lastName, string $middleName): self
    {
        $this->fullName = new FullName($firstName, $lastName, $middleName);

        return $this;
    }

    public function fullName(): FullName
    {
        return $this->fullName;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function password(): Password
    {
        return $this->password;
    }
}