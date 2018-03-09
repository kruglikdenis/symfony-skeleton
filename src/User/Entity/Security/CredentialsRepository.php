<?php

namespace App\User\Entity\Security;


use App\Common\Exception\EntityNotFoundException;
use Doctrine\ORM\EntityManagerInterface;

class CredentialsRepository implements EmailResolver
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param Email $email
     * @return Credentials
     * @throws EntityNotFoundException
     */
    public function retrieveByEmail(Email $email): Credentials
    {
        $qb = $this->em->createQueryBuilder();
        $expr = $qb->expr();
        $qb->select('c')
            ->from(Credentials::class, 'c')
            ->where($expr->eq(
                $expr->lower('c.identify'),
                ':email'
            ))
            ->setParameter('email', $email);

        $credentials = $qb->getQuery()->getOneOrNullResult();

        if (null === $credentials) {
            throw new EntityNotFoundException('No user with this identity');
        }

        return $credentials;
    }
}