<?php

namespace App\Users\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;


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

}