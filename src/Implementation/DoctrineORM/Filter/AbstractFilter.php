<?php


namespace Seydu\DataQueryFilter\Implementation\DoctrineORM\Filter;


use Seydu\DataQueryFilter\FilterInterface;
use Seydu\DataQueryFilter\FilterQueryBuilderInterface;
use Seydu\DataQueryFilter\Implementation\DoctrineORM\FilterDefinition;
use Seydu\DataQueryFilter\Implementation\DoctrineORM\ProxyQuery;
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
     * @param ProxyQuery $proxyQuery
     * @param FilterQueryBuilderInterface $filterQueryBuilder
     * @param FilterDefinition $metadata
     * @param mixed $value
     * @return ProxyQueryInterface|ProxyQuery
     */
    abstract protected function doApply(ProxyQuery $proxyQuery, FilterQueryBuilderInterface $filterQueryBuilder, FilterDefinition $metadata, $value);

    /**
     * @param ProxyQueryInterface|ProxyQuery $proxyQuery
     * @param FilterQueryBuilderInterface $filterQueryBuilder
     * @param FilterDefinition $metadata
     * @param mixed $value
     * @return ProxyQueryInterface
     */
    public function apply(ProxyQueryInterface $proxyQuery, FilterQueryBuilderInterface $filterQueryBuilder, $metadata, $value)
    {
        return $this->doApply($proxyQuery, $filterQueryBuilder, $metadata, $value);
    }
}
