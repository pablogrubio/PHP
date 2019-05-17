<?php

namespace Project\Form;

class Form
{
    public $id;
    public $name;
    public $ask;
    public $email;


    public function __construct($id,$name,$email,$ask)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email=$email ;
        $this->ask=$ask;
    }
}