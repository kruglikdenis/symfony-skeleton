<?php

namespace App\User\Entity\Security;


use App\Common\Doctrine\CustomHydrator;
use App\Common\EntityNotFoundException;
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
                $expr->lower('c.email'),
                ':email'
            ))
            ->setParameter('email', $email);

        $credentials = $qb->getQuery()->getOneOrNullResult(CustomHydrator::NestedArrayHydrator);

        if (null === $credentials) {
            throw new EntityNotFoundException('Wrong email');
        }

        return $credentials;
    }
}