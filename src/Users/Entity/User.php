<?php

namespace App\Users\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @var FullName
     * @ORM\Embedded(class="App\Users\Entity\FullName", columnPrefix = false)
     */
    private $fullName;

    /**
     * @var Credentials
     * @ORM\Embedded(class="App\Users\Entity\Credentials", columnPrefix = false)
     */
    private $credentials;
}