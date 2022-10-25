<?php

namespace App\Http\Middleware\Core;

interface Handler
{
    public function setNext(Handler $handler): Handler;

    public function handle(array $request);
}
