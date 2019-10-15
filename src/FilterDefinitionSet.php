<?php


namespace Seydu\DataQueryFilter;


class FilterDefinitionSet implements \Iterator, \Countable
{
    private $elements = [];
    private $position = 0;
    private $values;
    public function __construct(array $elements)
    {
        $this->elements = [];
        foreach ($elements as $element) {
            $this->add($element);
        }
        $this->rewind();
    }

    /**
     * @param FilterDefinitionInterface $element
     * @return $this
     */
    private function add(FilterDefinitionInterface $element)
    {
        $id = $element->getId();
        if(isset($this->elements[$id])) {
            throw new \InvalidArgumentException("Filter duplicate filter id '$id'");
        }
        $this->elements[$id] = $element;
        return $this;

    }

    protected function hasKey($key)
    {
        return \array_key_exists($key, $this->elements);
    }

    public function isEmpty()
    {
        return $this->count() == 0;
    }

    public function toArray()
    {
        return $this->elements;
    }

    public function first()
    {
        if(empty($this->elements)) {
            return null;
        }
        return \array_values($this->elements)[0];
    }

    function rewind()
    {
        $this->position = 0;
        $this->values = \array_values($this->elements);
    }

    function current()
    {
        return $this->values[$this->position];
    }

    function key()
    {
        return $this->position;
    }

    function next()
    {
        ++$this->position;
    }

    function valid()
    {
        return isset($this->values[$this->position]);
    }

    public function count()
    {
        return \count($this->elements);
    }
}