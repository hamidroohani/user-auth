<?php

function show_errors($field){
    session_start();
    $err = @$_SESSION['err'];
    if (isset($err[$field])){
        foreach ($err[$field] as $e){
            echo $e;
        }
    }
}

function flash($msg){
    session_start();
    $_SESSION['err'] = $msg;
}