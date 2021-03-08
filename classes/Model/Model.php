<?php

abstract class Model
{
    private $connection;

    public function __construct (?\mysqli $connection)
    {
        $this->connection = $connection;
    }

    public abstract function prendi (string $formato, string $pk = null) : string;

    public function to_html (\mysqli_result $result) : string
    {
        return "";
    }

    public function to_xml (\mysqli_result $result) : string
    {
        return "";
    }
};