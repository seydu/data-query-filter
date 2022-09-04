<?php


namespace Seydu\DataQueryFilter;


interface SortDefinitionInterface
{
    public function isEmpty(): bool ;

    public function getClass(): string;
}
