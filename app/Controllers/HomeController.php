<?php

use App\Http\BaseController;
use App\Models\Response;

class HomeController extends BaseController
{
    public function index()
    {
        $this->view("home");
    }
}