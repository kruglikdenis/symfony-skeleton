<?php

namespace App\User\Entity\Security;


use App\Common\Exception\EntityNotFoundException;
use Doctrine\ORM\EntityManagerInterface;

class CredentialsRepository
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param string $email
     * @return Credentials
     * @throws EntityNotFoundException
     */
    public function retrieveByEmail(string $email): Credentials
    {
        $qb = $this->em->createQueryBuilder();
        $expr = $qb->expr();
        $qb->select('c')
            ->from(Credentials::class, 'c')
            ->where($expr->eq(
                $expr->lower('c.email.email'),
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