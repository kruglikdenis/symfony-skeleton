<?php

namespace App\Post\Entity\Criteria;


use App\Core\Entity\Criteria\LikeCriteria;
use App\Core\Http\Filter;
use App\Core\Http\FilterCollection;
use Happyr\DoctrineSpecification\BaseSpecification;
use Happyr\DoctrineSpecification\Spec;

class SearchCriteria extends BaseSpecification
{
    /**
     * @var FilterCollection
     */
    private $filters;

    /**
     * @var null|string
     */
    private $alias;

    public function __construct(FilterCollection $filters, ?string $alias = null)
    {
        $this->filters = $filters;
        $this->alias = $alias;

        parent::__construct($alias);
    }

    protected function getSpec()
    {
        $spec = Spec::andX();
        foreach ($this->filters as $filter) {
            $criteria = $this->getFilterSpec($filter);

            if (null !== $criteria) {
                $spec->andX($criteria);
            }
        }

        return $spec;
    }

    /**
     * Get specification by filter
     *
     * @param Filter $filter
     * @return BaseSpecification|null
     */
    private function getFilterSpec(Filter $filter): ?BaseSpecification
    {
        switch ($filter->name()) {
            case 'title':
                return new LikeCriteria($filter->name(), $filter->value(), $this->alias);
            default:
                return null;
        }
    }
}