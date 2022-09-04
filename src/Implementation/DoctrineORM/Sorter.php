<?php


namespace Seydu\DataQueryFilter\Implementation\DoctrineORM;


use Seydu\DataQueryFilter\ProxyQueryInterface;
use Seydu\DataQueryFilter\SortDefinitionInterface;
use Seydu\DataQueryFilter\SorterInterface;

class Sorter implements SorterInterface
{
    private $sortDefinition;

    public function setDefinition(SortDefinitionInterface $definition)
    {
        $this->sortDefinition = $definition;
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
