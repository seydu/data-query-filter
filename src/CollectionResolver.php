<?php

namespace Seydu\DataQueryFilter;

class CollectionResolver implements ResolverInterface
{

    private $filterCollection;
    private $sorterCollection;

    public function __construct(FilterCollection $filterCollection, SorterCollection $sorterCollection)
    {
        $this->filterCollection = $filterCollection;
        $this->sorterCollection = $sorterCollection;
    }

    public function resolveFilter(FilterDefinitionInterface $filterDefinition): FilterInterface
    {
        $filter = $this->filterCollection->require($filterDefinition->getClass());
        $filter->setId($filterDefinition->getId());
        return $filter;
    }

    public function resolveSorter(SortDefinitionInterface $sortDefinition): SorterInterface
    {
        if ($sortDefinition->isEmpty()) {
            return $this->sorterCollection->require(NoneSorter::class);
        }
        $sorter = $this->sorterCollection->require($sortDefinition->getClass());
        $sorter->setDefinition($sortDefinition);
        return $sorter;
    }
}
