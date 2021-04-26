<?php


namespace Seydu\DataQueryFilter\Implementation\DoctrineORM\Filter;


use Seydu\DataQueryFilter\FilterQueryBuilderInterface;
use Seydu\DataQueryFilter\Implementation\DoctrineORM\Condition\EqualCondition;
use Seydu\DataQueryFilter\Implementation\DoctrineORM\Condition\InCondition;
use Seydu\DataQueryFilter\Implementation\DoctrineORM\Exception\UnexpectedDataType;
use Seydu\DataQueryFilter\Implementation\DoctrineORM\FilterDefinition;
use Seydu\DataQueryFilter\Implementation\DoctrineORM\ProxyQuery;
use Seydu\DataQueryFilter\ProxyQueryInterface;

class InFilter extends AbstractFilter
{
    private $inCondition;
    public function __construct()
    {
        $this->inCondition = new InCondition();
    }

    private function convertToScalarValue($value)
    {
        if(!is_object($value)) {
            return $value;
        }
        if(method_exists($value, 'getId')) {
            return $value->getId();
        }
        if(property_exists($value, 'id')) {
            return $value->id;
        }
        return "$value";
    }
    private function convertToScalarValues($values)
    {
        $result = [];
        foreach ($values as $key => $value) {
            $scalarValue = $this->convertToScalarValue($value);
            if($scalarValue !== null) {
                $result[] = $scalarValue;
            }
        }
        return $result;
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
        if(!is_iterable($value)) {
            throw new UnexpectedDataType(sprintf("Condition %s expects value parameter to be iterable", __CLASS__));
        }
        $values = $this->convertToScalarValues($value);
        if(empty($values)) {
            $values = [null];
        }
        $paramName = $this->createParameterName($metadata->getField());
        return $this->inCondition->apply($proxyQuery, $metadata->getAlias(), $metadata->getField(), $paramName, $values);
    }
}
