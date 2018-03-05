<?php

namespace App\User\Entity;


use App\Common\Doctrine\CustomHydrator;
use Doctrine\ORM\EntityManagerInterface;

class UserRepository
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function add(User $user)
    {
        $this->em->persist($user);
    }
}