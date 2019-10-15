<?php


namespace Seydu\DataQueryFilter\Implementation\DoctrineORM;


use Seydu\DataQueryFilter\FilterInterface;
use Seydu\DataQueryFilter\FilterQueryBuilderInterface;
use Seydu\DataQueryFilter\ProxyQueryInterface;

abstract class AbstractFilter implements FilterInterface
{

    private $baseParameterName = '__filter_';
    private $id;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getJoins()
    {
        return [];
    }

    protected function createParameterName($name)
    {
        return $this->baseParameterName.$this->getId().'__'.$name;
    }

    protected function isNullValue($value)
    {
        return is_null($value) || $value === '';
    }

    /**
     * @param DoctrineORMProxyQuery $proxyQuery
     * @param FilterQueryBuilderInterface $filterQueryBuilder
     * @param mixed $value
     * @return ProxyQueryInterface|DoctrineORMProxyQuery
     */
    abstract protected function doApply(DoctrineORMProxyQuery $proxyQuery, FilterQueryBuilderInterface $filterQueryBuilder, $value);

    /**
     * @param ProxyQueryInterface|DoctrineORMProxyQuery $proxyQuery
     * @param FilterQueryBuilderInterface $filterQueryBuilder
     * @param mixed $value
     * @return ProxyQueryInterface
     */
    public function apply(ProxyQueryInterface $proxyQuery, FilterQueryBuilderInterface $filterQueryBuilder, $value)
    {
        return $this->doApply($proxyQuery, $filterQueryBuilder, $value);
    }
}