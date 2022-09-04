<?php


namespace Seydu\DataQueryFilter\Implementation\DoctrineORM;


use Seydu\DataQueryFilter\SortDefinitionInterface;

class SortDefinition implements SortDefinitionInterface
{
    private $class;
    private $field;
    private $direction;
    private $alias;
    private $joins;
    public function __construct($class, $field, $direction, $alias, array $joins)
    {
        $this->class = $class;
        $this->field = $field;
        $this->direction = $direction;
        $this->alias = $alias;
        $this->joins = $joins;
    }

    /**
     * @return mixed
     */
    public function getClass(): string
    {
        return $this->class;
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

    /**
     * @return mixed
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @return array
     */
    public function getJoins(): array
    {
        return $this->joins;
    }

    public function isEmpty(): bool
    {
        return empty($this->class);
    }
}
