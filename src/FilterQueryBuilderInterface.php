<?php


namespace Seydu\DataQueryFilter;



interface FilterQueryBuilderInterface
{
    /**
     * @param ProxyQueryInterface $proxyQuery
     * @param FilterDefinitionSet $filterDefinitions
     * @param SortDefinitionInterface $sortDefinition
     * @param array $filterData
     * @return ProxyQueryInterface
     */
    public function apply(ProxyQueryInterface $proxyQuery, FilterDefinitionSet $filterDefinitions, SortDefinitionInterface $sortDefinition, array $filterData);
}