<?php

namespace Seydu\DataQueryFilter;

class NoneSorter implements SorterInterface
{
    /**
     * @param ProxyQueryInterface $proxyQuery
     * @return ProxyQueryInterface
     */
    public function apply(ProxyQueryInterface $proxyQuery)
    {
        return $proxyQuery;
    }

    /**
     * @inheritDoc
     */
    public function getJoins()
    {
        return [];
    }

    public function setDefinition(SortDefinitionInterface $definition)
    {
    }
}
