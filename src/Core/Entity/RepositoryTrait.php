<?php

namespace App\Core\Entity;


use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

trait RepositoryTrait
{
    /**
     * @var EntityManagerInterface
     */
    public $em;

    /**
     * @var ObjectRepository
     */
    public $repository;

    /**
     * Init references
     *
     * @param EntityManagerInterface $em
     * @param string $class
     */
    public function construct(EntityManagerInterface $em, string $class): void
    {
        $this->em = $em;
        $this->repository = $em->getRepository($class);
    }
}