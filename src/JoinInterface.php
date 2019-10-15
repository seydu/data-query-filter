<?php


namespace Seydu\DataQueryFilter;


interface JoinInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @return bool
     */
    public function isOptional();

    /**
     * @param ProxyQueryInterface $proxyQuery
     * @return ProxyQueryInterface
     */
    public function apply(ProxyQueryInterface $proxyQuery);
}