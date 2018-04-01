<?php

namespace App\Report;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\ResultSetMapping;

class UserLikeReportLoader
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var ResultSetMapping
     */
    protected $rsm;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->rsm = $this->configureMapping();
    }

    public function load(): array
    {
    }

    private function configureMapping(): ResultSetMapping
    {
        return (new ResultSetMapping())
            ->addScalarResult('id', 'id');
    }
}