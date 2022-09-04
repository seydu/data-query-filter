<?php

namespace Seydu\Tests\DataQueryFilter;

use PHPUnit\Framework\TestCase;
use Seydu\DataQueryFilter\CollectionResolver;
use Seydu\DataQueryFilter\FilterCollection;
use Seydu\DataQueryFilter\FilterDefinition;
use Seydu\DataQueryFilter\FilterInterface;
use Seydu\DataQueryFilter\FilterQueryBuilderInterface;
use Seydu\DataQueryFilter\JoinInterface;
use Seydu\DataQueryFilter\ProxyQueryInterface;
use Seydu\DataQueryFilter\SortDefinition;
use Seydu\DataQueryFilter\SorterCollection;
use Seydu\DataQueryFilter\SorterInterface;

class CollectionResolverSorterTest extends TestCase
{
    public function test_resolve_successfully()
    {
        $sorterCollection = new SorterCollection();
        $sorterCollection->add(new SorterA());
        $resolver = new CollectionResolver(new FilterCollection(), $sorterCollection);
        $definition = new SortDefinition(SorterA::class, 'name', 'alias');
        $sorter = $resolver->resolveSorter($definition);
        $this->assertInstanceOf(SorterA::class, $sorter);
    }
}

class SorterA implements SorterInterface
{

    public function apply(ProxyQueryInterface $proxyQuery)
    {
        // TODO: Implement apply() method.
    }

    public function getJoins()
    {
        // TODO: Implement getJoins() method.
    }

    public function setDefinition(SortDefinition $definition)
    {
        // TODO: Implement setDefinition() method.
    }
}
