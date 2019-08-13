<?php

namespace Core\Data\Sql\Query;

use Core\Data\Sql\QueryBuilder;

class Update extends QueryBuilder
{
    protected $values;
    protected $filter;

    public function update(string $tableName) : QueryBuilder
    {
        $this->verb = 'UPDATE';
        $this->tableName = $tableName;

        return $this;
    }

    public function set($values) : QueryBuilder
    {
        $this->values = $values;

        return $this;
    }

    public function where($filter) : QueryBuilder
    {
        $this->filter = $filter;

        return $this;
    }

    public function getSql() : string
    {
        //return "update tasks set";

        $sql = $this->verb . ' ' . $this->tableName;
        $sql .= ' SET ' . $this->values;
        $sql .= ' WHERE ' . $this->filter;

        return $sql;
    }
}
