<?php

namespace App\Core\Entity;


use App\Core\Http\FilterCollection;
use App\Core\Http\Pagination;
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

    public function search(FilterCollection $filters, Pagination $pagination)
    {

    }
}