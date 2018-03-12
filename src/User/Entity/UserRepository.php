<?php

namespace App\User\Entity;


use Doctrine\ORM\EntityManagerInterface;

class UserRepository implements Users
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public function add(User $user): void
    {
        $this->em->persist($user);
    }
}