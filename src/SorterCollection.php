<?php

namespace Seydu\DataQueryFilter;

class SorterCollection
{
    private $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function add(SorterInterface $item)
    {
        $this->items[\get_class($item)] = $item;
    }

    public function get($name): ?SorterInterface
    {
        return $this->items[$name] ?? null;
    }

    public function require($name): SorterInterface
    {
        $item = $this->get($name);
        if($item === null) {
            throw new \LogicException("Cannot find sorter '$name");
        }
        return $item;
    }
}
