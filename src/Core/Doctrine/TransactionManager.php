<?php

namespace App\Core\Doctrine;


use Doctrine\ORM\EntityManagerInterface;

class TransactionManager
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
     * @return void
     */
    public function beginTransaction(): void
    {
        $this->em->beginTransaction();
    }

    /**
     * @return void
     */
    public function commit(): void
    {
        $this->em->commit();
    }

    /**
     * @return void
     */
    public function rollback(): void
    {
        $this->em->rollback();
    }

    /**
     * @param \Closure $callback
     *
     * @return void
     */
    public function transactional(\Closure $callback): void
    {
        $this->em->transactional($callback);
    }
}