<?php

namespace App\Report;

use App\Core\Doctrine\NestedArrayHydrator;
use App\Post\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Tools\Pagination\Paginator;

class UserLikeReportQuery
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    private $rsm;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function load()
    {
        $rsm = new ResultSetMapping();
        $query = $this->em->createQueryBuilder()
            ->select('u')
            ->from(\App\User\Entity\User::class, 'u')
            ->setMaxResults(20);

        $paginator = new Paginator($query);

        $a = $query;
    }
}