<?php

namespace App\Post\Entity;


use App\Core\Entity\Repository;
use App\Core\Entity\RepositoryTrait;
use App\Core\Exception\EntityNotFoundException;

class Posts implements Repository
{
    use RepositoryTrait;

    /**
     * @inheritdoc
     */
    public function add(Post $post): void
    {
        $this->em->persist($post);
    }

    /**
     * @inheritdoc
     */
    public function retrieveById(string $id): Post
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('p')
            ->from(Post::class, 'p')
            ->where('p.id = :id')
            ->setParameter('id', $id);

        $post = $qb->getQuery()->getOneOrNullResult();

        if (null === $post) {
            throw new EntityNotFoundException();
        }

        return $post;
    }
}