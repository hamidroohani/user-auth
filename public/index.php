<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Http\Router;

$router = new Router();

//"ProductController::class"
$router->add("GET", "", App\Controllers\HomeController::class, "index");
$router->add("GET", "login", App\Controllers\LoginController::class, "index");
$router->add("POST", "login", App\Controllers\LoginController::class, "login");
$router->add("GET", "logout", App\Controllers\LoginController::class, "logout");
$router->add("GET", "register", \App\Controllers\RegisterController::class, "show_register_form");
$router->add("POST", "register", \App\Controllers\RegisterController::class, "register");

try {
    echo $router->dispatch();
} catch (Exception $exception) {
    $errorCode = $exception->getCode();
        $errorCode = 500;
    $data = [
        "errorMessage" => $exception->getMessage(),
        "errorCode" => $errorCode
    ];
    header('Content-Type: application/json');
    http_response_code($errorCode);
    echo json_encode(["data" => $data], JSON_PRETTY_PRINT);
}