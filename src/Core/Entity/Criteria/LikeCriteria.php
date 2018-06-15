<?php

namespace App\Core\Entity\Criteria;


use Doctrine\ORM\QueryBuilder;
use Happyr\DoctrineSpecification\BaseSpecification;

class LikeCriteria extends BaseSpecification
{
    /**
     * @var string
     */
    private $field;

    /**
     * @var string
     */
    private $query;

    public function __construct(string $field, ?string $query, ?string $dqlAlias)
    {
        $this->field = $field;
        $this->query = (null !== $query) ? strtolower($query) : null;

        parent::__construct($dqlAlias);
    }

    public function getFilter(QueryBuilder $qb, $dqlAlias)
    {
        if (null === $this->query) {
            return null;
        }

        $alias = sprintf("%s.$this->field", $dqlAlias);
        $qb->setParameter('q', "%$this->query%");

        return (string) $qb->expr()->andX("lower($alias) like :q");
    }
}