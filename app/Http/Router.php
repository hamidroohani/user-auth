<?php

namespace App\Http;

class Router
{
    protected $routes = [];
    protected $middlewares = [
        'json' => \App\Http\Middleware\JsonResponse::class
    ];

    public function add(string $method, string $path, string $controllerName, string $action, array $middleware = [])
    {
        $this->routes[] = array("method" => $method, "path" => $path, "controller" => $controllerName, "action" => $action, 'middleware' => $middleware);
    }

    public function dispatch()
    {
        $id = null;
        $route = $this->findRoute();
        $path = $route['path'];
        $controller = $route['controller'];
        $action = $route['action'];
        $middleware = $route['middleware'];

        if (preg_match("/[\d]+/", $path, $matches)) {
            $digitsFromPath = (int)implode(" ", $matches);
            $id = $digitsFromPath;
        }

        $this->run_middlewares($middleware);
        $controller = new $controller;
        return $controller->$action($id);
    }

    public function findRoute()
    {
        $requestURI = trim(filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL), "/");

        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {

            //In case there is an ID
            if (preg_match("/[\d]+/", $requestURI)) {
                $str = preg_replace("/[\d]+/", '{$0}', $requestURI); //people/show/9
                $route['method'] = $requestMethod;
                $route['path'] = $str;
                preg_match("/^[a-zA-Z]+\/([a-zA-Z]+)\/[\d]+$/", $requestURI, $matches);
                $action = $matches[1];
                $route['action'] = $action;
                echo " there is an id, so this is the new route";
                print_r($route);
                return $route;
            }

            if ($route['method'] === $requestMethod && $route['path'] === $requestURI) {
                return $route;
            }
        }

        throw new \Exception('Route not found', 404);
    }

    public function run_middlewares(array $middlewares)
    {
        if (!count($middlewares)) return null;

        foreach ($middlewares as $key => $middleware) {
            $current = new $this->middlewares[$middleware];
            if (isset($middlewares[$key + 1])) {
                $next = $middlewares[$key + 1];
                $current->setNext(new $this->middlewares[$next]);
            }
            if ($key === 0) {
                $first_middleware = $current;
            }
        }

        $first_middleware->handle($_REQUEST);
    }
}