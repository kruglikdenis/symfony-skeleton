<?php

namespace App\Core\Http;


use Doctrine\ORM\EntityManagerInterface;

trait FlushAwareTrait
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * Sets the entity manager.
     *
     * @param EntityManagerInterface $em
     */
    public function setEntityManager(EntityManagerInterface $em): void
    {
        $this->em = $em;
    }

    public function flushChanges(): void
    {
        $this->em->flush();
    }
}