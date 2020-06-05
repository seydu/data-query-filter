<?php


namespace Seydu\DataQueryFilter\Implementation\DoctrineORM;


use Doctrine\ORM\QueryBuilder;
use Seydu\DataQueryFilter\FilterQueryBuilderInterface;
use Seydu\DataQueryFilter\ProxyQueryInterface;

class ProxyQuery implements ProxyQueryInterface
{
    private $filterQueryBuilder;
    private $queryBuilder;

    public function __construct(FilterQueryBuilderInterface $filterQueryBuilder, QueryBuilder $queryBuilder)
    {
        $this->filterQueryBuilder = $filterQueryBuilder;
        $this->queryBuilder = $queryBuilder;
    }

    /**
     * @return QueryBuilder
     */
    public function getQueryBuilder()
    {
        return $this->queryBuilder;
    }

    /**
     * @param $id
     * @return $this
     */
    public function applyJoin($id)
    {
        return $this->filterQueryBuilder->applyJoin($this, $id);
    }
}
