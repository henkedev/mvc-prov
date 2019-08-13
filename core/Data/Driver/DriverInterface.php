<?php

namespace Core\Data\Driver;


interface DriverInterface
{
    /**
     * Get a connection objet from the database driver
     *
     * @return mixed
     */
    function connect();
}