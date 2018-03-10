<?php

namespace App\User\Entity\Security;


use App\Common\Exception\EntityNotFoundException;
use Doctrine\ORM\EntityManagerInterface;

class CredentialsRepository implements Credentials
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param Email $email
     * @return Credential
     * @throws EntityNotFoundException
     */
    public function retrieveByEmail(Email $email): Credential
    {
        $qb = $this->em->createQueryBuilder();
        $expr = $qb->expr();
        $qb->select('c')
            ->from(Credential::class, 'c')
            ->where($expr->eq(
                $expr->lower('c.email.email'),
                ':email'
            ))
            ->setParameter('email', (string) $email);

        $credentials = $qb->getQuery()->getOneOrNullResult();

        if (null === $credentials) {
            throw new EntityNotFoundException('No user with this identity');
        }

        return $credentials;
    }
}