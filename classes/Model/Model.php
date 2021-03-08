<?php

abstract class Model
{
    private \mysqli_result $result;
    private \mysqli $connection;

    public function __construct (\mysqli $connection)
    {
        $this->connection = $connection;
    }

    public abstract function prendi (string $pk = null) : void;

    public function html () : string
    {
        return "";
    }

    public function xml () : string
    {
        return "";
    }

    public function json () : string
    {
        return "";
    }
};