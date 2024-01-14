<?php

namespace App\http;

use App\middleware\Authorize;
use App\routing\Router;

class Kernel extends Router
{
    use Request;

    public function resolve(string $uri): void
    {
        $requestMethod = $this->getMethod();
        if($requestMethod === 'POST' && isset($_POST['_method'])) {
            $requestMethod = strtoupper($_POST['_method']);
        }

        foreach ($this->routes as $route) {
            $uriSegments = explode('/', trim($uri, '/'));

            $routeSegments = explode('/', trim($route['uri'], '/'));
            $match = true;

            //@phpstan-ignore-next-line
            if (count($uriSegments) === count($routeSegments) && strtoupper($route['method'] === $requestMethod)) {
                $params = [];

                // $re = '/{(.+?):(.+)}/';
                for ($i = 0; $i < count($uriSegments) ; $i++) {
                    if ($routeSegments[$i] !== $uriSegments[$i] && !preg_match('/\{(.+?)\}/', $routeSegments[$i], $matches)) {
                        $match = false;
                        break;
                    }

                    if (preg_match('/\{(.+?)\}/', $routeSegments[$i], $matches)) {
                        $params[$matches[1]] = $uriSegments[$i];
                    }
                }

                if ($match) {

                    foreach ($route['middleware'] as $middleware) {
                        (new Authorize())->handle($middleware);
                    }

                    $controller = $route['controller'];
                    $controllerMethod = $route['controllerMethod'];

                    extract($params);
                    $controllerInstance = new $controller();
                    $controllerInstance->$controllerMethod($params);
                    return;
                }
            }
        }
        new Response('404');
        exit();
    }
}
