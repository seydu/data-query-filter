<?php


namespace Seydu\DataQueryFilter;


interface SorterInterface
{
    /**
     * @param ProxyQueryInterface $proxyQuery
     * @return ProxyQueryInterface
     */
    public function apply(ProxyQueryInterface $proxyQuery);
    /**
     * @return JoinInterface[]
     */
    public function getJoins();
}
