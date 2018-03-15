<?php

namespace App\Post\Entity;


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

    public function add(Post $post): void
    {
        $this->em->persist($post);
    }
}