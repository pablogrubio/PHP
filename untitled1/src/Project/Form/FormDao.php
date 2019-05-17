<?php

namespace Project\Form;

use DateTime;
use Firebase\JWT\JWT;
use PDO;
use Project\Utils\ProjectDao;

class FormDao
{
    private $dbConnection;

    public function __construct(ProjectDao $dbConnection){
        $this->dbConnection=$dbConnection;


    }

    public function getAllForms(){
        $sql="SELECT * FROM formu";
        return $this->dbConnection->fetchAll($sql);
    }

    public function createForm($user){
        $sql="INSERT INTO formu(name,ask,email)VALUES(?,?,?)";
        $id=$this->dbConnection->insert($sql,array($user['name'],$user['ask'],$user['email']));
        $user = $this->getForm($id);
        return $user;
    }

    public function getForm($id)
    {
        $sql="SELECT * FROM formu WHERE Id=?";
        return $this->dbConnection->fetch($sql,array($id));

    }


    public function delete($id){
        $sql="DELETE FROM formu WHERE Id=?";
        $this->dbConnection->execute($sql,array($id));
    }


}