<?php

namespace Model;

use \mysqli;

class Noleggi
{
    private $connection;

    public function __construct(mysqli $connection)
    {
        $this->connection = $connection;
    }

    public function prendi (string $formato, string $id = null) : string
    {
        $arr = [];

        $query = "";

        if (is_null($id))
        {
            $query = "SELECT * FROM noleggi";
        }
        else
        {
            $query = "SELECT * FROM noleggi WHERE codice_noleggio = $id";
        }

        $result = $this->connection->query($query);

        $i = 0;
        while (($row = $result->fetch_array(MYSQLI_ASSOC)))
        {
            $arr[$i++] = $row;
        }

        if (!is_null($id))
        {
            $arr = $arr[0];
        }

        switch ($formato)
        {
            case "json":
                return json_encode($arr);
            case "xml":

            break;
            case "html":

            break;
        }

        return "";
    }
};