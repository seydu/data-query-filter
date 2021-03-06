<?php


namespace Seydu\DataQueryFilter\Implementation\DoctrineORM;


use Seydu\DataQueryFilter\FilterDefinitionInterface;

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

    /**
     * @return mixed
     */
    public function getMetadata()
    {
        return $this;
    }
}
