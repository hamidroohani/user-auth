<?php

namespace App\Http\Middleware;

use App\Http\Middleware\Core\AbstractHandler;

class JsonResponse extends AbstractHandler
{
    public function handle(array $request)
    {
        header('Content-Type: application/json');
        return $this->next($request);
    }
}