<?php

namespace App\Security\Entity;


use App\Core\Exception\EntityNotFoundException;
use Doctrine\ORM\EntityManagerInterface;

class CredentialRepository implements Credentials
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

        $credential = $qb->getQuery()->getOneOrNullResult();

        if (null === $credential) {
            throw new EntityNotFoundException();
        }

        return $credential;
    }
}