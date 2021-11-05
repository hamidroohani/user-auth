<?php


namespace App\Models;


use App\Http\Config;

class User extends DB
{
    public function __construct()
    {
        parent::__construct();
    }

    public function select($table)
    {
        $this->table = $table;
        $this->query = "select * from " . $this->table . " where 1 ";
        return $this;
    }

    public function where($field, $opr, $val)
    {
        $this->query .= " and {$field} {$opr} '{$val}'";

        return $this;
    }

    public function get()
    {
        $this->query = mysqli_query($this->connstr, $this->query);
        $result = [];
        while ($res=mysqli_fetch_assoc($this->query)) {
            array_push($result, $res);
        }

        return $result;
    }
}