<?php
require_once './libs/Router.php';
require_once './controllers/-api.controller.php';

// crea el router
$router = new Router();

// Productos
$router->addRoute('products', 'GET', 'TaskApiController', 'getTasks');
$router->addRoute('products/:ID', 'GET', 'TaskApiController', 'getTask');
$router->addRoute('products/:ID', 'DELETE', 'TaskApiController', 'deleteTask');
$router->addRoute('products', 'POST', 'TaskApiController', 'insertTask'); 

// Categorias
$router->addRoute('categories', 'GET', 'TaskApiController', 'getTasks');
$router->addRoute('categories/:ID', 'GET', 'TaskApiController', 'getTask');
$router->addRoute('categories/:ID', 'DELETE', 'TaskApiController', 'deleteTask');
$router->addRoute('categories', 'POST', 'TaskApiController', 'insertTask'); 


// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);