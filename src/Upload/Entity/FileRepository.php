<?php

namespace App\Upload\Entity;


use Doctrine\ORM\EntityManagerInterface;

class FileRepository implements Files
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
    public function add(FileReference $file): void
    {
        $this->em->persist($file);
    }
}