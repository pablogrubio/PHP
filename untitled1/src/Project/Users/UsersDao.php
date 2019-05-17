<?php

namespace Project\Users;

use DateTime;
use Firebase\JWT\JWT;
use PDO;
use Project\Utils\ProjectDao;

class UsersDao
{
    private $dbConnection;

    public function __construct(ProjectDao $dbConnection){
        $this->dbConnection=$dbConnection;


    }

    public function getAll()
    {
      $sql="SELECT * FROM users";
          return  $this->dbConnection->fetchAll($sql);

    }

    public function getAllForms(){
        $sql="SELECT * FROM formu";
        return $this->dbConnection->fetchAll($sql);
    }

    public function getUser($id)
    {
     $sql="SELECT * FROM users WHERE Id=?";
       return $this->dbConnection->fetch($sql,array($id));

    }

    public function updateUser($userId,$user){
        $sql="UPDATE users SET nombre=?, email=?,token=? WHERE Id=?";
        $this->dbConnection->execute($sql,array($user['nombre'],$user['email'],$user['token'],$userId));
        return $this->getUser($userId);

    }

    public function createUser($user)
    {

        $sql="INSERT INTO users(nombre,email,password)VALUES(?,?,?)";
        $password=password_hash($user['password'],PASSWORD_DEFAULT);
        $id=$this->dbConnection->insert($sql,array($user['nombre'],$user['email'],$password));
        $user = $this->getUser($id);
        $user->token = $this->generateToken($user->Id);
        return $user;
    }



    public function loginUser($body){
        $email=$body['email'];
        $password=$body['password'];
        $sql="SELECT * FROM users WHERE email=?";
        $user=$this->dbConnection->fetch($sql,array($email));
        if(password_verify($password,$user->password)){
            $user->token=$this->generateToken($user->Id);
            return $user;
        }
        else{
            return false;
        }
    }



    public function generateToken($username)
    {
        $now = new DateTime();
        $future = new DateTime("now +1 year");

        $payload = [
            "iat" => $now->getTimeStamp(),
            "exp" => $future->getTimeStamp(),
            "jti" => base64_encode(random_bytes(16)),
            'iss' => 'localhost:80', // Issuer
            "id" => $username,
        ];

        $secret = 'mysecret';
        $token = JWT::encode($payload, $secret, "HS256");

        return $token;
    }


}