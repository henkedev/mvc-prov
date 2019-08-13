<?php

namespace Core\Data;

use Core\Data\Sql\QueryBuilder;

interface ResourceInterface
{
    /**
     * Get all rows for a table
     *
     * @param  QueryBuilder $builder
     *
     * @return array
     */
    function fetchAll(QueryBuilder $builder) : array;

     /**
     * Get a specific row from a table
     *
     * @param  QueryBuilder $builder
     * @param  mixed $bindings
     *
     * @return array
     */
    function fetchOne(QueryBuilder $builder, $bindings) : array;

    /**
     * Insert a new row in the table
     *
     * @param  QueryBuilder $builder
     * @param  mixed $bindings
     *
     * @return bool
     */
    function insert(QueryBuilder $builder, $bindings) : bool;

    /**
     * Update a table row
     *
     * @param  QueryBuilder $builder
     * @param  mixed $bindings
     *
     * @return bool
     */
    function update(QueryBuilder $builder, $bindings) : bool;

    /**
     * Delete a table row
     *
     * @param  QueryBuilder $builder
     * @param  mixed $bindings
     *
     * @return bool
     */
    function delete(QueryBuilder $builder, $bindings) : bool;
}