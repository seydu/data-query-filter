<?php

namespace Seydu\Tests\DataQueryFilter;

use PHPUnit\Framework\TestCase;
use Seydu\DataQueryFilter\CollectionResolver;
use Seydu\DataQueryFilter\FilterCollection;
use Seydu\DataQueryFilter\FilterDefinition;
use Seydu\DataQueryFilter\FilterInterface;
use Seydu\DataQueryFilter\FilterQueryBuilderInterface;
use Seydu\DataQueryFilter\ProxyQueryInterface;

class CollectionResolverTest extends TestCase
{
    public function test_resolve_successfully()
    {
        $filterCollection = new FilterCollection();
        $filterCollection->add(new FilterA());
        $resolver = new CollectionResolver($filterCollection);
        $definition = new FilterDefinition('a1', FilterA::class, 'name', 'alias');
        $filter = $resolver->resolveFilter($definition);
        $this->assertInstanceOf(FilterA::class, $filter);
        $this->assertEquals($definition->getId(), $filter->getId());
    }
}

class FilterA implements FilterInterface
{
    private $id;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getJoins()
    {
        return [];
    }

    public function apply(ProxyQueryInterface $proxyQuery, FilterQueryBuilderInterface $filterQueryBuilder, $metadata, $value)
    {

    }
}
