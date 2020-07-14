<?php


namespace Seydu\DataQueryFilter\Implementation\DoctrineORM;


use Seydu\DataQueryFilter\ProxyQueryInterface;
use Seydu\DataQueryFilter\SorterInterface;

class Sorter implements SorterInterface
{
    private $sortDefinition;
    public function __construct(SortDefinition $sortDefinition)
    {
        $this->sortDefinition = $sortDefinition;
    }

    private function doApply(ProxyQuery $proxyQuery)
    {
        $alias = $this->sortDefinition->getAlias();
        $orderField = $this->sortDefinition->getField();
        $orderDirection = $this->sortDefinition->getDirection();
        $proxyQuery->getQueryBuilder()->orderBy("$alias.$orderField", $orderDirection);
        return $proxyQuery;
    }

    /**
     * @param ProxyQueryInterface $proxyQuery
     * @return ProxyQueryInterface
     */
    public function apply(ProxyQueryInterface $proxyQuery)
    {
        /**
         * @var ProxyQuery $proxyQuery
         */
        return $this->doApply($proxyQuery);
    }

    /**
     * @inheritDoc
     */
    public function getJoins()
    {
        return $this->sortDefinition->getJoins();
    }
}
