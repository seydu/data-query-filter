<?php


namespace Seydu\DataQueryFilter;


class FilterQueryBuilder implements FilterQueryBuilderInterface
{
    private $resolver;
    /**
     * @var JoinInterface[]
     */
    private $joins;
    private $appliedJoins;

    public function __construct(ResolverInterface $resolver)
    {
        $this->resolver = $resolver;
        $this->joins = [];
        $this->appliedJoins = [];
    }

    private function isDefinedJoin($id)
    {
        return isset($this->joins[$id]);
    }

    private function addJoinDefinition(JoinInterface $join)
    {
        if(isset($this->joins[$join->getId()])) {
            throw new \LogicException(sprintf(
                "A join with id=%s has already been defined with class=%s",
                $join->getId(),
                get_class($this->joins[$join->getId()])
            ));
        }
        $this->joins[$join->getId()] = $join;
        return $this;

    }

    public function addJoinDefinitions($joinDefinitions)
    {
        foreach ($joinDefinitions as $joinDefinition) {
            $this->addJoinDefinition($joinDefinition);
        }
        return $this;
    }

    /**
     * @param JoinInterface[] $joins
     */
    private function addJoinsIfUndefined($joins)
    {
        foreach ($joins as $join) {
            if(!$this->isDefinedJoin($join->getId())) {
                $this->addJoinDefinition($join);
            }
        }
    }

    public function applyJoin(ProxyQueryInterface $proxyQuery, $id)
    {
        if(!isset($this->joins[$id])) {
            throw new \LogicException(sprintf(
                "No join with id=%s found, possible ids are %s",
                $id,
                \implode(' ', array_keys($this->joins))
            ));
        }
        if(isset($this->appliedJoins[$id])) {
            return $proxyQuery;
        }
        $join = $this->joins[$id];
        $this->appliedJoins[$id] = true;
        return $join->apply($proxyQuery);
    }

    /**
     * @param ProxyQueryInterface $proxyQuery
     * @param JoinInterface $join
     * @return ProxyQueryInterface
     */
    private function applyPendingJoin(ProxyQueryInterface $proxyQuery, JoinInterface $join)
    {
        if($join->isOptional()) {
            return $proxyQuery;
        }
        return $this->applyJoin($proxyQuery, $join->getId());
    }

    private function applyPendingJoins(ProxyQueryInterface $proxyQuery)
    {
        foreach ($this->joins as $joinId => $join) {
            if(empty($this->appliedJoins[$joinId])) {
                $proxyQuery = $this->applyPendingJoin($proxyQuery, $join);
            }
        }
        return $proxyQuery;
    }

    /**
     * @param FilterDefinitionInterface $filterDefinition
     * @return FilterInterface
     */
    private function resolveFilterService(FilterDefinitionInterface $filterDefinition)
    {
        return $this->resolver->resolveFilter($filterDefinition);
    }

    /**
     * @param FilterDefinitionSet|FilterDefinitionInterface[] $filterDefinitions
     * @return FilterInterface[]
     */
    private function resolveFilterDefinitions(FilterDefinitionSet $filterDefinitions)
    {
        $filterServices = [];
        foreach ($filterDefinitions as $definition) {
            $filterId = $definition->getId();
            $filterService = $this->resolveFilterService($definition);
            $filterService->setId($filterId);
            $filterServices[$filterId] = $filterService;
        }
        return $filterServices;
    }

    private function resolveSortService(SortDefinitionInterface $sortDefinition)
    {
        if ($sortDefinition->isEmpty()) {
            return new NoneSorter();
        }
        return $this->resolver->resolveSorter($sortDefinition);
    }

    public function apply(ProxyQueryInterface $proxyQuery, FilterDefinitionSet $filterDefinitions, SortDefinitionInterface $sortDefinition, array $filterData)
    {
        $resolvedFilterServices = $this->resolveFilterDefinitions($filterDefinitions);

        foreach ($resolvedFilterServices as $filterService) {
            $this->addJoinsIfUndefined($filterService->getJoins());
        }

        foreach ($resolvedFilterServices as $filterService) {
            $filterId = $filterService->getId();
            if(!array_key_exists($filterId, $filterData)) {
                continue;
            }
            $proxyQuery = $filterService->apply($proxyQuery, $this, $filterData[$filterId]);
        }

        $sortService = $this->resolveSortService($sortDefinition);
        $sortService->apply($proxyQuery);
        return $this->applyPendingJoins($proxyQuery);
    }
}