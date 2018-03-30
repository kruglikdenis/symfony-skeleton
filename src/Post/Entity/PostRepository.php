<?php

namespace App\Post\Entity;


use App\Core\Exception\EntityNotFoundException;
use Doctrine\ORM\EntityManagerInterface;

class PostRepository implements Posts
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

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