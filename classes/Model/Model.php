<?php

namespace Model;

use \mysqli;
use \mysqli_result;

abstract class Model
{
    protected \mysqli_result $result;
    protected \mysqli $connection;

    public abstract function prendi (string $pk = null) : void;

    public function xml () : string
    {
        // TODO: implementare xml
        return "";
    }

    public function json () : string
    {
        if ($this->result->num_rows === 1)
        {
            return json_encode($this->result->fetch_assoc());
        }

        return json_encode($this->result->fetch_all(MYSQLI_ASSOC));
    }
};