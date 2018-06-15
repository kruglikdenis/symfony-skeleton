<?php

namespace App\Core\Entity;


use App\Core\Exception\EntityNotFoundException;
use App\Core\Http\Pagination;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Happyr\DoctrineSpecification\BaseSpecification;
use Happyr\DoctrineSpecification\EntitySpecificationRepository;
use Happyr\DoctrineSpecification\Spec;

trait RepositoryTrait
{
    /**
     * @var EntityManagerInterface
     */
    public $em;

    /**
     * @var EntitySpecificationRepository
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

    /**
     * Add entity to collection
     *
     * @param $entity
     */
    public function add($entity): void
    {
        $this->em->persist($entity);
    }

    /**
     * Remove entity
     *
     * @param $entity
     */
    public function remove($entity): void
    {
        if ($entity instanceof SoftDelete) {
            $entity->delete();
            return;
        }

        $this->em->remove($entity);
    }

    /**
     * Search entity by specification
     *
     * @param BaseSpecification|null $criteria
     *
     * @return array
     */
    public function search(?BaseSpecification $criteria = null): array
    {
        $query = $this->prepareQuery($criteria);

        return $query->execute();
    }

    /**
     * @param BaseSpecification $criteria
     * @param Pagination|null $pagination
     *
     * @return Paginator
     */
    public function searchWithPagination(BaseSpecification $criteria, ?Pagination $pagination = null): Paginator
    {
        $query = $this->prepareQuery($criteria);

        if (null !== $pagination) {
            $query->setMaxResults($pagination->limit());
            $query->setFirstResult($pagination->offset());
        }

        return new Paginator($query);
    }

    /**
     * Prepare query for search
     *
     * @param BaseSpecification|null $criteria
     * @return Query
     */
    private function prepareQuery(?BaseSpecification $criteria = null): Query
    {
        $spec = Spec::andX();
        if (null !== $criteria) {
            $spec->andX($criteria);
        }

        return $this->repository->getQuery($criteria);
    }

    /**
     * Find entity by id
     *
     * @param string $id
     * @return null|object
     */
    public function findById(string $id)
    {
        return $this->repository->find($id);
    }

    /**
     * Retrieve entity by id
     *
     * @param string $id
     * @return null|object
     * @throws EntityNotFoundException
     */
    public function retrieveById(string $id)
    {
        $entity = $this->findById($id);

        if (null === $entity) {
            throw new EntityNotFoundException();
        }

        return $entity;
    }
}