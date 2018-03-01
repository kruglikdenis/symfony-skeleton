<?php

namespace App\Users\Entity;


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