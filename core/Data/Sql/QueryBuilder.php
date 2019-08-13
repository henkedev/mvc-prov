<?php

namespace Core\Data\Sql;

abstract class QueryBuilder
{
    protected $verb;
    protected $columns;
    protected $tableName;

    /**
     * Return the complete SQL string from this builder
     *
     * @return string
     */
    abstract public function getSql() : string;
}