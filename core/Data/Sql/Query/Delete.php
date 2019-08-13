<?php

namespace Core\Data\Sql\Query;

use Core\Data\Sql\QueryBuilder;

class Delete extends QueryBuilder
{
    protected $filter;
    
    public function delete() : QueryBuilder
    {
        $this->verb = 'DELETE';
        
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
        $sql = $this->verb;
        $sql .= ' FROM ' . $this->tableName;
        
        if ($this->filter) {
            $sql .= ' WHERE ' . $this->filter;
        }

        return $sql;
    }
}
