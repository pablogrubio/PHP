<?php

namespace Project\Users;

class User
{
    public $id;
    public $name;
    public $password;
    public $ask;
    public $email;


    public function __construct($id,$name,$password,$email,$ask)
{
    $this->id = $id;
    $this->name = $name;
    $this->password=$password;
    $this->email=$email ;
    $this->ask=$ask;
}
}