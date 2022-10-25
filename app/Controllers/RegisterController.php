<?php

namespace App\Controllers;

use App\Http\BaseController;
use App\Models\Response;
use App\Models\Token;
use App\Models\User;

class RegisterController extends BaseController
{
    public function show_register_form()
    {
        $this->view("login/register");
    }

    public function register()
    {
        $request = $_POST;

        // validate
        $validate = $this->validate($request, [
            "name" => "required|min 4",
            "email" => "required|min 4",
            "password" => "required|min 4|confirm",
        ]);

        if (!empty($validate)) {
            flash($validate);
            $this->redirect('/register');
        }
    }

    public function login()
    {
        if (!isset($_POST['email']) || !isset($_POST['password']))
        {
            Response::require_parameter("email and password");
        }
        $username = $_POST['email'];
        $password = md5($_POST['password']);

        $user = new User();
        $user = $user->select('users')->where('email',"=",$username)->where("password","=",$password)->get();
        if (count($user)){
            $token = generateRandomString(30);
            $token_user = new Token();
            $token_user->insert(['user_id','token','created_at','expire_date'],[$user[0]['id'],$token,date("Y-m-d H:i:s"),date("Y-m-d H:i:s",strtotime('tomorrow'))],$user[0]['id']);
            Response::success_token($token);
        }
    }
}