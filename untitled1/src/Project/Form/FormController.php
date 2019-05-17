<?php

namespace Project\Form;

use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class FormController{
    private $dao;

    public function __construct(ContainerInterface $container){
        $dbConnection=$container['dbConnection'];
        $this->dao=new FormDao($dbConnection);
    }

    function getAllForms(Request $request, Response $response , array $args){
        $users=$this->dao->getAllForms();
        return $response->withJson($users);
    }


    function createForm(Request $request, Response $response, array $args)
    {
        $body = $request->getParsedBody();
        $user = $this->dao->createForm($body);
        return $response->withJson($user);
    }

    function getForm(Request $request, Response $response, array $args){

        $user=$this->dao->getForm($args['id']);
        return $response->withJson($user);
    }

    function delete(Request $request, Response $response, array $args)
    {
        $id = $args['id'];
        $this->dao->delete($id);
        return $response->withStatus(201);
    }
}
