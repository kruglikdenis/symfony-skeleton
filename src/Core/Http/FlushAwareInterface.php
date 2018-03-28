<?php

namespace App\Core\Http;


use Doctrine\ORM\EntityManagerInterface;

interface FlushAwareInterface
{
    /**
     * @param EntityManagerInterface $em
     */
    public function setEntityManager(EntityManagerInterface $em): void;

    /**
     * Flush changes
     */
    public function flushChanges(): void;
}