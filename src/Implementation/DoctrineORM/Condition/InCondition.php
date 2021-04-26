<?php


namespace Seydu\DataQueryFilter\Implementation\DoctrineORM\Condition;


use Seydu\DataQueryFilter\Implementation\DoctrineORM\Exception\UnexpectedDataType;
use Seydu\DataQueryFilter\Implementation\DoctrineORM\ProxyQuery;

class InCondition
{
    public function apply(ProxyQuery $proxyQuery, $alias, $field, $parameterName, $value)
    {
        if(!is_iterable($value)) {
            throw new UnexpectedDataType(sprintf("Condition %s expects value parameter to be iterable", __CLASS__));
        }
        $proxyQuery->getQueryBuilder()
            ->andWhere($proxyQuery->getQueryBuilder()->expr()->in(sprintf("%s.%s", $alias, $field), $value));
        return $proxyQuery;
    }
}
