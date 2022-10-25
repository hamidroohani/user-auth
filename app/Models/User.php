<?php


namespace App\Models;


use App\Http\Config;

class User extends DB
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "users";
        $this->query = "select * from " . $this->table . " where 1 ";
        return $this;
    }
}