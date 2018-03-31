<?php

namespace App\Core\Doctrine\Cursor;


use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

class QueryCursor extends AbstractCursor
{
    /**
     * Query that returns items
     * AbstractQuery is used only for testing purpose, because Query is final class and can't be mocked
     *
     * @var AbstractQuery|Query
     */
    private $itemsQuery;

    /**
     * Query that return total count
     *
     * @var AbstractQuery
     */
    private $countQuery;

    /**
     * @param AbstractQuery|Query $itemsQuery Items query
     * @param AbstractQuery $countQuery Count query
     */
    public function __construct(AbstractQuery $itemsQuery, AbstractQuery $countQuery)
    {
        $this->itemsQuery = $itemsQuery;
        $this->countQuery = $countQuery;
    }

    /**
     * {@inheritdoc}
     */
    protected function doIterate(): \Traversable
    {
        $this->itemsQuery->setFirstResult($this->offset);
        $this->itemsQuery->setMaxResults($this->limit);

        return yield from $this->itemsQuery->execute();
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Doctrine\ORM\NonUniqueResultException If count query returns more than one row
     */
    protected function doCount(): int
    {
        return (int)$this->countQuery->getSingleScalarResult();
    }

    /**
     * Create new query builder with count query
     *
     * @param QueryBuilder $queryBuilder Original query builder
     * @param bool $distinctCount Use COUNT(DISTINCT alias). False by default
     * @param string|null $fromAlias Alias. If null will try to get first root alias from query builder
     *
     * @return QueryBuilder Query builder with count query
     */
    public static function createCountQueryBuilder(
        QueryBuilder $queryBuilder,
        bool $distinctCount = false,
        string $fromAlias = null
    ): QueryBuilder
    {
        if ($distinctCount) {
            $fromAlias = $fromAlias ?? $queryBuilder->getRootAliases()[0];
            $select = "COUNT(DISTINCT {$fromAlias})";
        } else {
            // Dirty trick cause doctrine query builder does not support COUNT(*)
            $select = 'COUNT(1)';
        }
        $countQueryBuilder = clone $queryBuilder;
        $countQueryBuilder->select($select);
        $countQueryBuilder->resetDQLPart('orderBy');
        return $countQueryBuilder;
    }

    /**
     * Create count query from items query builder
     *
     * @param QueryBuilder $queryBuilder Items query builder
     * @param AbstractQuery|null $itemsQuery Custom item query
     * @param bool $distinctCount Use COUNT(DISTINCT alias). False by default
     * @param string|null $fromAlias From table alias for distinct
     *
     * @return static|self
     */
    public static function fromQueryBuilder(
        QueryBuilder $queryBuilder,
        AbstractQuery $itemsQuery = null,
        bool $distinctCount = false,
        string $fromAlias = null
    ): self
    {
        $itemsQuery = $itemsQuery ?? $queryBuilder->getQuery();
        $countQuery = static::createCountQueryBuilder($queryBuilder, $distinctCount, $fromAlias)->getQuery();
        return new static($itemsQuery, $countQuery);
    }

}