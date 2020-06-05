<?php


namespace Seydu\DataQueryFilter\Implementation\DoctrineORM;


use Seydu\DataQueryFilter\SortDefinitionInterface;

class SortDefinition implements SortDefinitionInterface
{
    private $field;
    private $direction;
    private $alias;
    public function __construct($field, $direction, $alias)
    {
        $this->field = $field;
        $this->direction = $direction;
        $this->alias = $alias;
    }

    /**
     * @return mixed
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @return mixed
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return mixed
     */
    public function getDirection()
    {
        return $this->direction;
    }

    public function isEmpty(): bool
    {
        return empty($this->field);
    }
}
