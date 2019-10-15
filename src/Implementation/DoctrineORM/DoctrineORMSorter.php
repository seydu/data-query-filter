<?php


namespace Seydu\DataQueryFilter\Implementation\DoctrineORM;


use Seydu\DataQueryFilter\ProxyQueryInterface;
use Seydu\DataQueryFilter\SorterInterface;

class DoctrineORMSorter implements SorterInterface
{

    private $sortDefinition;
    public function __construct(DoctrineORMSortDefinition $sortDefinition)
    {
        $this->sortDefinition = $sortDefinition;
    }

    private function doApply(DoctrineORMProxyQuery $proxyQuery)
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
         * @var DoctrineORMProxyQuery $proxyQuery
         */
        return $this->doApply($proxyQuery);
    }
}