<?php
require_once './libs/Router.php';
require_once './controllers/-api.controller.php';

// crea el router
$router = new Router();

// Productos
$router->addRoute('tasks', 'GET', 'TaskApiController', 'getTasks');
$router->addRoute('tasks/:ID', 'GET', 'TaskApiController', 'getTask');
$router->addRoute('tasks/:ID', 'DELETE', 'TaskApiController', 'deleteTask');
$router->addRoute('tasks', 'POST', 'TaskApiController', 'insertTask'); 

// Categorias
$router->addRoute('tasks', 'GET', 'TaskApiController', 'getTasks');
$router->addRoute('tasks/:ID', 'GET', 'TaskApiController', 'getTask');
$router->addRoute('tasks/:ID', 'DELETE', 'TaskApiController', 'deleteTask');
$router->addRoute('tasks', 'POST', 'TaskApiController', 'insertTask'); 


// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);