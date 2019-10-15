<?php


namespace Seydu\DataQueryFilter\Implementation\DoctrineORM;


use Seydu\DataQueryFilter\JoinInterface;
use Seydu\DataQueryFilter\ProxyQueryInterface;


class CallableJoin implements JoinInterface
{
    private $callable;
    private $id;
    private $optional;
    public function __construct($callable, $id, $optional)
    {
        $this->callable = $callable;
        $this->id = $id;
        $this->optional = $optional;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param ProxyQueryInterface $proxyQuery
     * @return ProxyQueryInterface
     */
    public function apply(ProxyQueryInterface $proxyQuery)
    {
        $callable = $this->callable;
        return $callable($proxyQuery);
    }

    /**
     * @return bool
     */
    public function isOptional()
    {
        return $this->optional;
    }
}