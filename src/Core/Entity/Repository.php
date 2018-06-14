<?php

namespace App\Core\Entity;


use Doctrine\ORM\EntityManagerInterface;

interface Repository
{
    /**
     * @param EntityManagerInterface $em
     * @param string $class
     */
    public function construct(EntityManagerInterface $em, string $class): void;
}