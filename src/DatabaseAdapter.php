<?php namespace Acme;
/**
 * Created by PhpStorm.
 * User: levadim
 * Date: 6/8/16
 * Time: 5:41 PM
 */

use PDO;


class DatabaseAdapter
{

    protected $connection;

    function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll($tableName)
    {
        return $this->connection->query('select * from '. $tableName)->fetchAll();
    }

    public function query($sql, $parameters){
        return $this->connection->prepare($sql)->execute($parameters);
    }

}