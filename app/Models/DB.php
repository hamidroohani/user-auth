<?php

namespace App\Models;

use App\Http\Config;

abstract class DB
{
    public $connstr = null;
    public $table = "users";
    public $query = null;

    public $hostname = null;

    public function __construct()
    {
        $this->connstr = mysqli_connect(Config::HOSTNAME, Config::USERNAME, Config::PASSWORD, Config::DBNAME);
    }

    public function check_table_exists()
    {
        if (!$this->connstr){
            Response::db_connection_not_exists();
        }

        $this->query = mysqli_query($this->connstr, "SHOW TABLES LIKE '" . $this->table ."';");
        $result = [];
        while ($res=mysqli_fetch_assoc($this->query)) {
            array_push($result, $res);
        }
        if (!count($result)){
            Response::db_connection_not_exists();
        }
    }


    public function where($field, $opr, $val)
    {
        $this->query .= " and {$field} {$opr} '{$val}'";

        return $this;
    }

    public function orWhere($field, $opr, $val)
    {
        $this->query .= " or {$field} {$opr} '{$val}'";

        return $this;
    }

    public function get()
    {
        $result = $this->fetch();

        return $result;
    }

    public function first()
    {
        $result = $this->fetch();

        return $result[0];
    }

    /**
     * @return array
     */
    public function fetch(): array
    {
        $this->query = mysqli_query($this->connstr, $this->query);
        $result = [];
        while ($res = mysqli_fetch_assoc($this->query)) {
            array_push($result, $res);
        }
        return $result;
    }
}