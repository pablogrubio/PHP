<?php
/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 19/03/2019
 * Time: 9:16
 */
namespace Project\Utils;

use PDO;

class MySqlProject implements ProjectDao{

    private $connection;

    public function __construct(PDO $connection){

        $this->connection=$connection;
    }

    public function execute($sql, $params=null){
        $stm=$this->connection->prepare($sql);
        $stm->execute($params);
    }

    public function fetch($sql, $params = null)
    {
        $stm=$this->connection->prepare($sql);
        $stm->execute($params);
        return $stm->fetch();
    }

    public function fetchAll($sql, $params = null)
    {
        $stm=$this->connection->prepare($sql);
        $stm->execute($params);
        return $stm->fetchAll();
    }

    public function insert($sql,$params=null){
        $stm=$this->connection->prepare($sql);
        $stm->execute($params);
        return $this->connection->lastInsertId();
    }
}