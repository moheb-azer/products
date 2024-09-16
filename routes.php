<?php

use Core\Router;

$router = new Router();
$router->addRoute('GET', '/', 'ProductController@index');
$router->addRoute('GET', '/add-product', 'ProductController@create');
$router->addRoute('POST', '/add-product', 'ProductController@store');
$router->addRoute('POST', '/delete-products', 'ProductController@destroy');

// Dispatch the current request
$uri = $_SERVER['REQUEST_URI'];
$router->dispatch($uri);