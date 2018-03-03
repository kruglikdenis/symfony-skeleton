<?php

namespace App\Users\Entity;


use App\Common\Doctrine\CustomHydrator;
use Doctrine\ORM\EntityManagerInterface;

class UserRepository
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function add(User $user)
    {
        $this->em->persist($user);
    }

    /**
     *
     * @param string $email
     * @return User
     * @throws UserNotFoundException
     */
    public function retrieveByEmail(string $email): User
    {
        $qb = $this->em->createQueryBuilder();
        $expr = $qb->expr();
        $qb->select('u')
            ->from(User::class, 'u')
            ->where($expr->eq(
                $expr->lower('u.email'),
                ':email'
            ))
            ->setParameter('email', $email);

        $user = $qb->getQuery()->getOneOrNullResult(CustomHydrator::NestedArrayHydrator);

        if (null === $user) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}