<?php

function show_errors($field){
    session_start();
    $err = @$_SESSION['err'];
    if (isset($err[$field])){
        foreach ($err[$field] as $e){
            echo $e;
        }
        unset($_SESSION['err'][$field]);
    }
}

function flash($msg){
    session_start();
    $_SESSION['err'] = $msg;
}

function dd($what){
    die(var_dump($what));
}

function config($key){
    return \App\Http\Config::config($key);
}