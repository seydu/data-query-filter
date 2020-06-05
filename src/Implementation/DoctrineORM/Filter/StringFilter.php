<?php


namespace Seydu\DataQueryFilter\Implementation\DoctrineORM\Filter;


use Seydu\DataQueryFilter\FilterQueryBuilderInterface;
use Seydu\DataQueryFilter\Implementation\DoctrineORM\Condition\LikeCondition;
use Seydu\DataQueryFilter\Implementation\DoctrineORM\FilterDefinition;
use Seydu\DataQueryFilter\Implementation\DoctrineORM\ProxyQuery;
use Seydu\DataQueryFilter\ProxyQueryInterface;

class StringFilter extends AbstractFilter
{
    private $likeCondition;
    public function __construct()
    {
        $this->likeCondition = new LikeCondition();
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
        return $this->likeCondition->apply($proxyQuery, $metadata->getAlias(), $metadata->getField(), $paramName, $value);
    }
}
