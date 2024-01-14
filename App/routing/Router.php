<?php

namespace App\routing;

use Exception;

class Router
{
    public array $routes = [];
    public function registerRoute(string $method, string $uri, array $action, array $middleware = []): void
    {
        list($controller, $controllerMethod) = $action;

        if (!class_exists($controller)) {
            throw new Exception("No class {$controller} exits");
        }        

        if (!method_exists($controller, $controllerMethod)) {
            throw new Exception("No method {$controllerMethod} exits");
        }
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'controllerMethod' => $controllerMethod,
            'middleware' => $middleware,
        ];

    }
    public function get($uri, $controller, $middleware = []): void
    {
        $this->registerRoute('GET', $uri, $controller, $middleware);
    }

    public function post($uri, $controller, $middleware = []): void
    {
        $this->registerRoute('POST', $uri, $controller, $middleware);
    }

    public function put($uri, $controller, $middleware = []): void
    {
        $this->registerRoute('PUT', $uri, $controller, $middleware);
    }

    public function patch($uri, $controller, $middleware = []): void
    {
        $this->registerRoute('PATCH', $uri, $controller, $middleware);
    }


    public function delete($uri, $controller, $middleware = []): void
    {
        $this->registerRoute('DELETE', $uri, $controller, $middleware);
    }
}
