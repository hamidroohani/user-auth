<?php

namespace App\Controllers;

use App\Http\BaseController;
use App\Models\Response;

class HomeController extends BaseController
{
    public function index()
    {
        session_start();
        $name = '';
        if (isset($_SESSION['user_name'])){
            $name = $_SESSION['user_name'];
        }
        $this->view("home",['name' => $name]);
    }
}