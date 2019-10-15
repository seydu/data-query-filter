<?php


namespace Seydu\DataQueryFilter;


interface ResolverInterface
{
    /**
     * @param FilterDefinitionInterface $filterDefinition
     * @return FilterInterface
     */
    public function resolveFilter(FilterDefinitionInterface $filterDefinition);

    /**
     * @param SortDefinitionInterface $sortDefinition
     * @return SorterInterface
     */
    public function resolveSorter(SortDefinitionInterface $sortDefinition);
}