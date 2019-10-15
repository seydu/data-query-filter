<?php

namespace Seydu\DataQueryFilter;

class NoneSorter implements SorterInterface
{

    /**
     * @param ProxyQueryInterface $proxyQuery
     * @return ProxyQueryInterface
     */
    public function apply(ProxyQueryInterface $proxyQuery)
    {
        return $proxyQuery;
    }
}