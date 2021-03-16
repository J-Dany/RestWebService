<?php

namespace Model;

use \mysqli;
use \mysqli_result;
use \SimpleXMLElement;

abstract class Model
{
    protected \mysqli_result $result;
    protected \mysqli $connection;

    public abstract function prendi (string $pk = null) : void;

    public function xml () : string
    {
        if ($this->result->num_rows === 1)
        {
            $xml = new \SimpleXMLElement("<temperatura />");

            foreach ($this->result->fetch_assoc() as $key => $value)
            {
                $xml->addChild($key, $value);
            }
        }
        else
        {
            $xml = new \SimpleXMLElement("<temperature />");

            foreach ($this->result->fetch_all(MYSQLI_ASSOC) as $key => $value)
            {
                $child = $xml->addChild("temperatura");
                foreach ($value as $k => $v)
                {
                    $child->addChild($k, $v);
                }
            }
        }

        return $xml->asXML();
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