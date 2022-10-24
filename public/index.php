<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Http\Router;

$router = new Router();

//"ProductController::class"
$router->add("GET", "", HomeController::class, "index");
$router->add("GET", "login", LoginController::class, "index");
$router->add("GET", "register", LoginController::class, "index");

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