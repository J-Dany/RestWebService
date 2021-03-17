<?php

namespace Model;

abstract class Model
{
    protected $dbtable;
    protected $result;

    public function __construct (\mysqli $connection, string $name, string $pk)
    {
        $this->dbtable = new \DatabaseTable($connection, $name, $pk);
    }

    public abstract function prendi ($pk);

    public abstract function apiPrendi ($pk = null) : void;

    public function xml () : string
    {
        if ($this->result->num_rows === 1)
        {
            $xml = new \SimpleXMLElement($this->name);

            foreach ($this->result->fetch_assoc() as $key => $value)
            {
                $xml->addChild($key, $value);
            }
        }
        else
        {
            $xml = new \SimpleXMLElement($this->name . "s");

            foreach ($this->result->fetch_all(MYSQLI_ASSOC) as $key => $value)
            {
                $child = $xml->addChild($this->name);
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