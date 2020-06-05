<?php


namespace Seydu\DataQueryFilter\Implementation\DoctrineORM\Condition;


use Seydu\DataQueryFilter\Implementation\DoctrineORM\ProxyQuery;

class NullCondition
{
    public function apply(ProxyQuery $proxyQuery, $alias, $field)
    {
        $proxyQuery->getQueryBuilder()->andWhere(sprintf('%s.%s IS NULL', $alias, $field));
        return $proxyQuery;
    }
}
