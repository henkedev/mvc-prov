<?php

namespace Core\Data\Sql\Query;

use Core\Data\Sql\QueryBuilder;

class Insert extends QueryBuilder
{
    protected $values;

    public function insert(array $columns = []) : QueryBuilder
    {
        $this->verb = 'INSERT';
        $this->columns = $columns;

        return $this;
    }

    public function into(string $tableName) : QueryBuilder
    {
        $this->tableName = $tableName;
           
        return $this;
    }

    public function values($values) : QueryBuilder
    {
        $this->values = $values;

        return $this;
    }

    public function getSql() : string
    {
        //return "insert into tasks values('test','test description')";

        $sql = $this->verb . ' ';
        $sql .= ' INTO ' . $this->tableName;
        if ($this->columns) {
            $sql .= '(' . implode(',', $this->columns) . ')';
        }

        $sql .= ' VALUES (' . $this->values . ')';

        return $sql;
    }
}
