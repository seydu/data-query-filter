<?php


namespace Seydu\DataQueryFilter;


class EmptySortDefinition implements SortDefinitionInterface
{

    public function isEmpty(): bool
    {
        return true;
    }
}