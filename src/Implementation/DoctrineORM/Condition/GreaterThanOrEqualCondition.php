<?php


namespace Seydu\DataQueryFilter\Implementation\DoctrineORM\Condition;


use Seydu\DataQueryFilter\Implementation\DoctrineORM\ProxyQuery;

class GreaterThanOrEqualCondition
{
    public function apply(ProxyQuery $proxyQuery, $alias, $field, $parameterName, $value)
    {
        $proxyQuery->getQueryBuilder()->andWhere(sprintf("%s.%s >= :%s", $alias, $field, $parameterName))
            ->setParameter($parameterName, $value);
        return $proxyQuery;
    }
}
