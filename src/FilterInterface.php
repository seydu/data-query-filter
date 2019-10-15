<?php


namespace Seydu\DataQueryFilter;


interface FilterInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @param string $id
     * @return $this
     */
    public function setId($id);

    /**
     * @return JoinInterface[]
     */
    public function getJoins();

    /**
     * @param ProxyQueryInterface $proxyQuery
     * @param FilterQueryBuilderInterface $filterQueryBuilder
     * @param mixed $value
     * @return ProxyQueryInterface
     */
    public function apply(ProxyQueryInterface $proxyQuery, FilterQueryBuilderInterface $filterQueryBuilder, $value);
}