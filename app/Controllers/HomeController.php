<?php

namespace App\Controllers;

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