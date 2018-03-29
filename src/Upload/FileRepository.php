<?php

namespace App\Upload;


use App\Upload\Exception\FileNotFoundException;
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
    public function retrieveById(string $id): File
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('f')
            ->from(File::class, 'f')
            ->where('f.id = :id')
            ->setParameter('id', $id);

        $file = $qb->getQuery()->getOneOrNullResult();

        if (null === $file) {
            throw new FileNotFoundException();
        }

        return $file;
    }

    /**
     * @inheritdoc
     */
    public function add(File $file): void
    {
        $this->em->persist($file);
    }
}