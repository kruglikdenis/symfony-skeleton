<?php

namespace App\Core\Doctrine;

use Doctrine\ORM\EntityManagerInterface;

class Flush
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function __invoke(): void
    {
        $this->em->flush();
    }
}