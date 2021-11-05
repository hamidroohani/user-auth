<?php

use App\Http\BaseController;

class LoginController extends BaseController
{
    public function index()
    {
        $this->view("login/login");
    }

    public function check()
    {
        $request = $_POST;

        // validate
        $validate = $this->validate($request, [
            "username" => "required|min 4",
            "password" => "required|min 4",
        ]);

        if (!empty($validate)) {
            flash($validate);
            $this->redirect('/login');
        }

        // check DB


        // redirect
    }
}