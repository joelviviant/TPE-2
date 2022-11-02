<?php
require_once './libs/Router.php';
require_once './controllers/products-api-controller.php';

// crea el router
$router = new Router();

// Productos
$router->addRoute('products', 'GET', 'ProductApiController', 'getProducts');
$router->addRoute('products/:ID', 'GET', 'ProductApiController', 'getProduct');
$router->addRoute('products/:ID', 'DELETE', 'ProductApiController', 'deleteProduct');
$router->addRoute('products', 'POST', 'ProductApiController', 'insertProduct'); 
//
//// Categorias
//$router->addRoute('categories', 'GET', 'TaskApiController', 'getTasks');
//$router->addRoute('categories/:ID', 'GET', 'TaskApiController', 'getTask');
//$router->addRoute('categories/:ID', 'DELETE', 'TaskApiController', 'deleteTask');
//$router->addRoute('categories', 'POST', 'TaskApiController', 'insertTask'); 


// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);