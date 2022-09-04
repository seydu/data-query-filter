<?php


namespace Seydu\DataQueryFilter;


class FilterDefinition implements FilterDefinitionInterface
{
    private $id;
    private $class;
    private $alias;
    private $field;
    public function __construct($id, $class, $field, $alias)
    {
        $this->id = $id;
        $this->class = $class;
        $this->alias = $alias;
        $this->field = $field;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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

    public function getMetadata()
    {

    }
}
