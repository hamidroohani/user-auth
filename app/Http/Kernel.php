<?php

namespace App\Http;

use App\Http\Router;

class Kernel
{
    protected $middlewares = [];

    public function handle()
    {
        //routes
        $router = new Router();

        $router->add("GET", "", \App\Controllers\HomeController::class, "index");
        $router->add("GET", "login", \App\Controllers\LoginController::class, "index");
        $router->add("POST", "login", \App\Controllers\LoginController::class, "login");
        $router->add("GET", "logout", \App\Controllers\LoginController::class, "logout");
        $router->add("GET", "register", \App\Controllers\RegisterController::class, "show_register_form");
        $router->add("POST", "register", \App\Controllers\RegisterController::class, "register");

        try {
            echo $router->dispatch();
        } catch (\Exception $exception) {
            $errorCode = $exception->getCode();
            $data = [
                "errorMessage" => $exception->getMessage(),
                "errorCode" => $errorCode
            ];
            header('Content-Type: application/json');
            http_response_code($errorCode);
            echo json_encode(["data" => $data], JSON_PRETTY_PRINT);
        }

    }
}

$kernel = new Kernel();
$kernel->handle();