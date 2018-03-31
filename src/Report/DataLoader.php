<?php

namespace App\Report;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\ResultSetMapping;

abstract class DataLoader
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

        $this->rsm = new ResultSetMapping();
        $this->configureMapping();
    }

    /**
     * Load data
     *
     * @return array
     */
    abstract public function load(): array;

    /**
     * Configure result set mapping
     */
    abstract protected function configureMapping(): void;
}