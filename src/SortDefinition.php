<?php


namespace Seydu\DataQueryFilter;


class SortDefinition implements SortDefinitionInterface
{
    private $class;
    private $field;
    private $direction;
    public function __construct($class, $field, $direction)
    {
        $this->class = $class;
        $this->field = $field;
        $this->direction = $direction;
    }

    /**
     * @return mixed
     */
    public function getClass()
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

    public function isEmpty(): bool
    {
        return empty($this->field);
    }
}