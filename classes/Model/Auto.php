<?php

namespace Model;

use \mysqli;

class Auto
{
    private $connection;

    public function __construct(mysqli $connection)
    {
        $this->connection = $connection;
    }

    public function prendi (string $formato, string $targa = null) : string
    {        
        $arr = [];

        $query = "";

        if ($targa === null)
        {
            $query = "SELECT * FROM auto";
        }
        else
        {
            $query = "SELECT * FROM auto WHERE targa = '$targa'";
        }

        $result = $this->connection->query($query);

        $i = 0;
        while (($row = $result->fetch_array(MYSQLI_ASSOC)))
        {
            $arr[$i++] = $row;
        }

        if (!is_null($targa))
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