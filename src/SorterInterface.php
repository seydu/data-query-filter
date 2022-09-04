<?php


namespace Seydu\DataQueryFilter;


interface SorterInterface
{
    public function setDefinition(SortDefinitionInterface $definition);

    /**
     * @param ProxyQueryInterface $proxyQuery
     * @return ProxyQueryInterface
     */
    public function apply(ProxyQueryInterface $proxyQuery);
    /**
     * @return JoinInterface[]
     */
    public function getJoins();
}
