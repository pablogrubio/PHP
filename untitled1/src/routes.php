<?php

use Project\Users\UsersController;
use Project\Form\FormController;
use Slim\Http\Request;
use Slim\Http\Response;

// Routes
$authentication = $app->getContainer()->get('authentication');
$app->get('/users', UsersController::class . ':getAll');
//obtener un usuario por id
$app->get('/user/{id}', UsersController::class .':getUser');
//crear un usuario
$app->post('/user', UsersController:: class .':createUser');
//actualizar un usuario
$app->put('/user/{id}', UsersController:: class . ':updateUser')->add($authentication);
//borrar un usuario
$app->delete('/form/{id}', FormController::class. ':delete');
//crear un formulario
$app->post('/form', FormController:: class .':createForm');
//obtener un formulario
$app->get('/form/{id}', FormController::class .':getForm');
//obtener todos los formularios
$app->get('/forms', FormController::class .':getAllForms');
//hacer el login
$app->post('/login', UsersController::class . ':loginUser');