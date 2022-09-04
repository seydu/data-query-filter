<?php

namespace Seydu\DataQueryFilter;

class FilterCollection
{
    private $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function add(FilterInterface $filter)
    {
        $this->items[\get_class($filter)] = $filter;
    }

    public function get($name): ?FilterInterface
    {
        return $this->items[$name] ?? null;
    }

    public function require($name): FilterInterface
    {
        $item = $this->get($name);
        if($item === null) {
            throw new \LogicException("Cannot find filter '$name");
        }
        return $item;
    }
}
