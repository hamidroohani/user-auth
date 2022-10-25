<?php

namespace App\Controllers;

use App\Http\Config;

class BaseController
{
    public function view(string $path, array $data = [])
    {
        foreach ($data as $key => $value) ${$key} = $value;
        ob_start();
        require_once Config::RESOURCES_PATH . $path . ".php";
        $content = ob_get_clean();
        $this->template($content);
    }

    public function template($content = "")
    {
        $template = file_get_contents(Config::LAYOUT_PATH);
        print str_replace("{{content}}", $content, $template);
    }

    public function validate($request, $validation)
    {
        $err = [];
        foreach ($validation as $key => $value) {
            $roles = explode("|", $value);
            foreach ($roles as $role) {
                $explode_role = explode(" ", $role);
                $v = null;
                if (isset($explode_role[1])) $v = $explode_role[1];
                $func = call_user_func("App\\Http\\ValidationController::" . $explode_role[0], $request, $key, $v);
                if ($func){
                    foreach ($func as $err_key => $err_value){
                        $err[$err_key][] = $err_value;
                    }
                }
            }
        }
        unset($_POST);
        return $err;
    }

    public function redirect($route)
    {
        header("location:" . $route);
        die();
    }
}