<?php


namespace Seydu\DataQueryFilter\Implementation\DoctrineORM\Filter;


use Seydu\DataQueryFilter\FilterQueryBuilderInterface;
use Seydu\DataQueryFilter\Implementation\DoctrineORM\Condition\EqualCondition;
use Seydu\DataQueryFilter\Implementation\DoctrineORM\Condition\NullCondition;
use Seydu\DataQueryFilter\Implementation\DoctrineORM\FilterDefinition;
use Seydu\DataQueryFilter\Implementation\DoctrineORM\ProxyQuery;
use Seydu\DataQueryFilter\ProxyQueryInterface;

class EqualOrNullFilter extends AbstractFilter
{
    private $nullCondition;
    private $equalCondition;
    public function __construct()
    {
        $this->nullCondition = new NullCondition();
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
            $this->nullCondition->apply($proxyQuery, $metadata->getAlias(), $metadata->getField());
        }
        $paramName = $this->createParameterName($metadata->getField());
        return $this->equalCondition->apply($proxyQuery, $metadata->getAlias(), $metadata->getField(), $paramName, $value);
    }
}
