<?php

use App\Http\BaseController;
use App\Models\User;

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

        // username or email exists
        $user = new User();
        $user = $user->where("name","=",$request['username'])->orWhere("email","=",$request['username'])->first();

        if (!$user){
            flash(['username' => ["Username or Password is incorrect"]]);
            $this->redirect('/login');
        }

        // password is correct
        $user_id = $user['id'];
        $user = new User();
        $user = $user->where("id","=",$user_id)->where("password","=",md5($request['password']))->first();

        if (!$user){
            flash(['username' => ["Username or Password is incorrect"]]);
            $this->redirect('/login');
        }

        dd($user);

        // redirect
    }
}