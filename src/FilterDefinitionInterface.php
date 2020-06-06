<?php


namespace Seydu\DataQueryFilter;


interface FilterDefinitionInterface
{

    /**
     * @return string
     */
    public function getId();

    /**
     * @return mixed
     */
    public function getMetadata();
}
