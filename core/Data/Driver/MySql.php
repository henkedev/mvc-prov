<?php

namespace Core\Data\Driver;

use \PDO;
use Core\App;

class MySql implements DriverInterface
{
    /**
     * connect
     *
     * @return PDO
     */
    public function connect()
    {
        $host = App::getConfig()->getData('database/host');
        $db   = App::getConfig()->getData('database/name');
        $user = App::getConfig()->getData('database/user');
        $pass = App::getConfig()->getData('database/pass');
    
        $dsn = "mysql:host=$host;dbname=$db;charset=utf8";
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        
        try {
            $pdo = App::getContainer()->get('PDO', $dsn, $user, $pass, $opt);
            return $pdo;
        } catch (\Exception $e) {
            throw new \Exception('Internal problem - please contact the site administrator');
        }
    }
}