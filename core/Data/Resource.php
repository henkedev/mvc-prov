<?php

namespace Core\Data;

use \PDO;
use Core\App;
use Core\Data\Sql\QueryBuilder;

class Resource implements ResourceInterface
{
    private $driver;

    /**
     * Initialize the Resource class with an appropriate driver
     *
     * @return void
     */
    public function __construct() 
    {
        $this->driver = App::getContainer()->get('MySqlDriver');
    }

    /**
     * Get a connection objet from the database driver
     *
     * @return PDO
     */
    public function connect()
    {
        return $this->driver->connect();
    }

    /**
     * Get all rows for a table
     *
     * @param  QueryBuilder $builder
     *
     * @return array
     */
    public function fetchAll(QueryBuilder $builder) : array
    {
        try {
            $pdo = $this->connect();
            $stmt = $pdo->prepare($builder->getSql());
        
            if ($stmt->execute()) {            
                $result = $stmt->fetchAll();
            } else {
                $result = [];
            }
        
            return $result;
        } catch (\Exception $e) {
            throw new \Exception('There was an error with the request. Contact the administrator');
        }
    }

    /**
     * fetchOne
     *
     * @param  QueryBuilder $builder
     * @param  mixed $bindings
     *
     * @return array
     */
    public function fetchOne(QueryBuilder $builder, $bindings = null) : array
    {
        try {
            $pdo = $this->connect();
            $stmt = $pdo->prepare($builder->getSql());
    
            if ($bindings !== null) {
                foreach ($bindings as $key => $value) {            
                    $stmt->bindValue($key, $value, PDO::PARAM_STR);
                }        
            }
        
            if ($stmt->execute()) {            
                $result = $stmt->fetch();
            } else {
                $result = [];
            }
        
            return $result;    
        } catch (\Exception $e) {
            throw new \Exception('There was an error with the request. Contact the administrator');
        }
    }

    /**
     * Insert a new row in the table
     *
     * @param  QueryBuilder $builder
     * @param  mixed $bindings
     *
     * @return bool
     */
    public function insert(QueryBuilder $builder, $bindings) : bool
    {
        return $this->executeStatement($builder, $bindings);
    }

    /**
     * Update a table row
     *
     * @param  QueryBuilder $builder
     * @param  mixed $bindings
     *
     * @return bool
     */
    public function update(QueryBuilder $builder, $bindings) : bool
    {
        return $this->executeStatement($builder, $bindings);
    }

    /**
     * Delete a table row
     *
     * @param  QueryBuilder $builder
     * @param  mixed $bindings
     *
     * @return bool
     */
    public function delete(QueryBuilder $builder, $bindings) : bool
    {
        return $this->executeStatement($builder, $bindings);
    }

    /**
     * Execute a prepared statement using a specific query builder
     *
     * @param  QueryBuilder $builder
     * @param  mixed $bindings
     *
     * @return bool
     */
    private function executeStatement(QueryBuilder $builder, $bindings) : bool
    {
        try {
            $pdo = $this->connect();
            $stmt = $pdo->prepare($builder->getSql());
        
            if ($stmt->execute($bindings)) {
                return true;
            } else {
                return false;
            }    
        } catch (\Exception $e) {
            throw new \Exception('There was an error with the request. Contact the administrator');
        }
    }
}