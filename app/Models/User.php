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