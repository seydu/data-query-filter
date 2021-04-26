<?php


namespace Seydu\DataQueryFilter\Implementation\DoctrineORM\Filter;


use Seydu\DataQueryFilter\FilterQueryBuilderInterface;
use Seydu\DataQueryFilter\Implementation\DoctrineORM\Condition\GreaterThanOrEqualCondition;
use Seydu\DataQueryFilter\Implementation\DoctrineORM\Condition\LessThanOrEqualCondition;
use Seydu\DataQueryFilter\Implementation\DoctrineORM\Exception\UnexpectedDataType;
use Seydu\DataQueryFilter\Implementation\DoctrineORM\FilterDefinition;
use Seydu\DataQueryFilter\Implementation\DoctrineORM\ProxyQuery;
use Seydu\DataQueryFilter\ProxyQueryInterface;

class BetweenFilter extends AbstractFilter
{
    private $greaterThanOrEqualCondition;
    private $lessThanOrEqualCondition;
    public function __construct()
    {
        $this->greaterThanOrEqualCondition = new GreaterThanOrEqualCondition();
        $this->lessThanOrEqualCondition = new LessThanOrEqualCondition();
    }

    /**
     * @param ProxyQuery $proxyQuery
     * @param FilterQueryBuilderInterface $filterQueryBuilder
     * @param mixed $metadata
     * @param mixed $value
     * @return ProxyQueryInterface|ProxyQuery
     * @throws UnexpectedDataType
     */
    protected function doApply(
        ProxyQuery $proxyQuery,
        FilterQueryBuilderInterface $filterQueryBuilder,
        FilterDefinition $metadata,
        $value
    )
    {
        if($this->isNullValue($value)) {
            return $proxyQuery;
        }
        if(!is_array($value)) {
            throw new UnexpectedDataType(__CLASS__.' expects filter value to be null or of type array');
        }
        $lowerBound = $value['lower'] ?? null;
        $upperBound = $value['upper'] ?? null;
        if(!$this->isNullValue($lowerBound)) {
            $paramName = $this->createParameterName($metadata->getField().'__lower');
            $proxyQuery = $this->greaterThanOrEqualCondition->apply(
                $proxyQuery,
                $metadata->getAlias(),
                $metadata->getField(),
                $paramName,
                $lowerBound
            );
        }
        if(!$this->isNullValue($upperBound)) {
            $paramName = $this->createParameterName($metadata->getField().'__upper');
            $proxyQuery = $this->lessThanOrEqualCondition->apply(
                $proxyQuery,
                $metadata->getAlias(),
                $metadata->getField(),
                $paramName,
                $upperBound
            );
        }
        return $proxyQuery;
    }
}
