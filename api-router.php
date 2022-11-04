<?php
require_once './libs/Router.php';
require_once './controllers/products-api-controller.php';
require_once './controllers/categories-api-controller.php';

// crea el router
$router = new Router();

// Productos
$router->addRoute('products', 'GET', 'ProductApiController', 'getProducts');
$router->addRoute('products/:ID', 'GET', 'ProductApiController', 'getProduct');
$router->addRoute('products/:ID', 'DELETE', 'ProductApiController', 'deleteProduct');
$router->addRoute('products', 'POST', 'ProductApiController', 'insertProduct'); 
$router->addRoute('products/:ID', 'PUT', 'ProductApiController', 'updateProduct'); 
$router->addRoute('products/:ID', 'POST', 'ProductApiController', 'updateVendido'); 

// Categorias

$router->addRoute('categories', 'GET', 'CategoryApiController', 'getCategories');
$router->addRoute('categories/:ID', 'GET', 'CategoryApiController', 'getCategory');
$router->addRoute('categories/:ID', 'DELETE', 'CategoryApiController', 'deleteCategory');
$router->addRoute('categories', 'POST', 'CategoryApiController', 'insertCategory'); 
$router->addRoute('categories/:ID', 'PUT', 'CategoryApiController', 'editCategory'); 

// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);