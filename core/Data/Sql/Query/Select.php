<?php

namespace Core\Data\Sql\Query;

use Core\Data\Sql\QueryBuilder;

class Select extends QueryBuilder
{
    protected $filter;
    
    public function select(array $columns = []) : QueryBuilder
    {
        $this->verb = 'SELECT';
        $this->columns = $columns;

        return $this;
    }

    public function from(string $tableName) : QueryBuilder
    {
        $this->tableName = $tableName;
           
        return $this;
    }

    public function where(string $filter) : QueryBuilder
    {
        $this->filter = $filter;

        return $this;
    }

    public function getSql() : string
    {
        $sql = $this->verb . ' ';
        $sql .= implode(',', $this->columns);
        $sql .= ' FROM ' . $this->tableName;
        
        if ($this->filter) {
            $sql .= ' WHERE ' . $this->filter;
        }

        return $sql;
    }
}
