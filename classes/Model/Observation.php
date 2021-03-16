<?php

namespace Model;

use Model\Model;
use \mysqli;

class Observation extends Model
{
    public function __construct (\mysqli $connection)
    {
        $this->connection = $connection;
    }

    public function prendi(string $pk = null) : void
    {
        $query = "";

        if (is_null($pk))
        {
            $query = "SELECT * FROM OBSERVATIONS";
        }
        else
        {
            $query = "SELECT * FROM OBSERVATIONS WHERE time = '$pk'";
        }

        $this->result = $this->connection->query($query);
    }
};