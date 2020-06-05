<?php


namespace Seydu\DataQueryFilter\Implementation\DoctrineORM\Condition;


use Seydu\DataQueryFilter\Implementation\DoctrineORM\ProxyQuery;

class LikeCondition
{
    public function apply(ProxyQuery $proxyQuery, $alias, $field, $parameterName, $value)
    {
        $proxyQuery->getQueryBuilder()->andWhere(\sprintf('lower(%s.%s) LIKE :%s', $alias, $field, $parameterName))
            ->setParameter($parameterName, '%' . strtolower($value) . '%');
        return $proxyQuery;
    }
}
