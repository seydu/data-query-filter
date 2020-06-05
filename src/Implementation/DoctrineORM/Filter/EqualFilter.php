<?php


namespace Seydu\DataQueryFilter\Implementation\DoctrineORM\Filter;


use Seydu\DataQueryFilter\FilterQueryBuilderInterface;
use Seydu\DataQueryFilter\Implementation\DoctrineORM\Condition\EqualCondition;
use Seydu\DataQueryFilter\Implementation\DoctrineORM\FilterDefinition;
use Seydu\DataQueryFilter\Implementation\DoctrineORM\ProxyQuery;
use Seydu\DataQueryFilter\ProxyQueryInterface;

class EqualFilter extends AbstractFilter
{
    private $equalCondition;
    public function __construct()
    {
        $this->equalCondition = new EqualCondition();
    }

    /**
     * @param ProxyQuery $proxyQuery
     * @param FilterQueryBuilderInterface $filterQueryBuilder
     * @param mixed $metadata
     * @param mixed $value
     * @return ProxyQueryInterface|ProxyQuery
     */
    protected function doApply(ProxyQuery $proxyQuery, FilterQueryBuilderInterface $filterQueryBuilder, FilterDefinition $metadata, $value)
    {
        if($this->isNullValue($value)) {
            return $proxyQuery;
        }
        $paramName = $this->createParameterName($metadata->getField());
        return $this->equalCondition->apply($proxyQuery, $metadata->getAlias(), $metadata->getField(), $paramName, $value);
    }
}
