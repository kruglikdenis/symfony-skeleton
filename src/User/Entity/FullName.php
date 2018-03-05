<?php

namespace App\User\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class FullName
{
    /**
     * @var string
     * @ORM\Column(type="string", length=64)
     */
    private $firstName;

    /**
     * @var string
     * @ORM\Column(type="string", length=64)
     */
    private $lastName;

    /**
     * @var string
     * @ORM\Column(type="string", length=64)
     */
    private $middleName;

    public function __construct(string $firstName, string $lastName, string $middleName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->middleName = $middleName;
    }
}