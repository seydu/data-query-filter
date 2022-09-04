<?php

namespace Seydu\DataQueryFilter;

class CollectionResolver implements ResolverInterface
{

    private $filterCollection;

    public function __construct(FilterCollection $filterCollection)
    {
        $this->filterCollection = $filterCollection;
    }

    public function resolveFilter(FilterDefinitionInterface $filterDefinition)
    {
        $filter = $this->filterCollection->require($filterDefinition->getClass());
        $filter->setId($filterDefinition->getId());
        return $filter;
    }

    public function resolveSorter(SortDefinitionInterface $sortDefinition)
    {
        // TODO: Implement resolveSorter() method.
    }
}
