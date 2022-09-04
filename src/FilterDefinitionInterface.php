<?php


namespace Seydu\DataQueryFilter;


interface FilterDefinitionInterface
{

    /**
     * @return string
     */
    public function getId();

    /**
     * @return string
     */
    public function getClass();

    /**
     * @return mixed
     */
    public function getMetadata();
}
