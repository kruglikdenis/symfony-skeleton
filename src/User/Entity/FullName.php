<?php

namespace App\User\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Embeddable
 */
class FullName
{
    /**
     * @var string
     * @ORM\Column(type="string", length=64)
     *
     * @Groups({"api_user_register"})
     */
    private $firstName;

    /**
     * @var string
     * @ORM\Column(type="string", length=64)
     *
     * @Groups({"api_user_register"})
     */
    private $lastName;

    /**
     * @var string
     * @ORM\Column(type="string", length=64)
     *
     * @Groups({"api_user_register"})
     */
    private $middleName;

    public function __construct(string $firstName, string $lastName, string $middleName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->middleName = $middleName;
    }
}