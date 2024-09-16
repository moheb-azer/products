<?php

namespace Core;

class Router
{
    private $routes = [];

    public function addRoute($method, $uri, $action)
    {
        $this->routes[$method][$uri] = $action;
    }
    public function dispatch($uri): void
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $action = $this->routes[$requestMethod][$uri] ?? null;
        if ($action) {
            list($controllerName, $methodName) = explode('@', $action);
            $controllerClass = "App\\Controllers\\" . $controllerName;
            if (class_exists($controllerClass) && method_exists($controllerClass, $methodName)) {
                $controller = new $controllerClass();
                $controller->$methodName();
            } else {
                echo "Controller or method not found.";
            }
        } else {
            echo "No route defined for this URI.";
        }
    }
}
