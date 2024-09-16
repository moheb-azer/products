<?php
require __DIR__ . '/../vendor/autoload.php';
const BASE_PATH = __DIR__ . '/../';
require BASE_PATH . 'Core/helper.php';



spl_autoload_register(function ($class) {
    $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
    $file = base_path("{$class}.php");
    if (file_exists($file)) {
        require $file;
    }
});

require base_path('Core/bootstrap.php');

require base_path('routes.php');
require base_path('Core/Router.php');
$router = new \Core\Router();
