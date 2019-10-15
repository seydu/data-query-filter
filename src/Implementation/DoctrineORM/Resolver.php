<?php


namespace Seydu\DataQueryFilter\Implementation\DoctrineORM;


use Seydu\DataQueryFilter\FilterDefinitionInterface;
use Seydu\DataQueryFilter\FilterInterface;
use Seydu\DataQueryFilter\ResolverInterface;
use Seydu\DataQueryFilter\SortDefinitionInterface;
use Seydu\DataQueryFilter\SorterInterface;

class Resolver implements ResolverInterface
{

    private function doResolveFilter(DoctrineORMFilterDefinition $filterDefinition)
    {
        $class = $filterDefinition->getClass();
        return new $class();
    }

    /**
     * @param FilterDefinitionInterface $filterDefinition
     * @return FilterInterface
     */
    public function resolveFilter(FilterDefinitionInterface $filterDefinition)
    {
        /**
         * @var DoctrineORMFilterDefinition $filterDefinition
         */
        return $this->doResolveFilter($filterDefinition);
    }

    private function doResolveSorter(DoctrineORMSortDefinition $sortDefinition)
    {
        return new DoctrineORMSorter($sortDefinition);
    }
    /**
     * @param SortDefinitionInterface $sortDefinition
     * @return SorterInterface
     */
    public function resolveSorter(SortDefinitionInterface $sortDefinition)
    {
        /**
         * @var DoctrineORMSortDefinition $sortDefinition
         */
        return $this->doResolveSorter($sortDefinition);
    }
}