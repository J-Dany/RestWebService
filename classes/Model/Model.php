<?php

namespace Model;

abstract class Model
{
    protected array $columns;
    protected string $pk;
    protected string $name;
    protected \mysqli_result $result;
    protected \mysqli $connection;

    private string $insertQuery;

    public function __construct (\mysqli $connection, string $name, string $pk)
    {
        $this->connection = $connection;
        $this->name = $name;
        $this->pk = $pk;

        $this->settaArrayColonne();
        $this->connection->autocommit(false);
        $this->settaQueryInserimento();
    }

    protected function prendi ($pk) : \mysqli_result
    {
        $query = "SELECT * FROM '$this->name' WHERE '$this->pk' = '$pk'";

        $result = $this->connection->query($query);
        $this->result = $result;

        return $result;
    }

    protected function prendiTutto () : \mysqli_result
    {
        $query = "SELECT * FROM '$this->name'";

        $result = $this->connection->query($query);
        $this->result = $result;

        return $result;
    }

    protected function inserisci (array $values) : void
    {
        try
        {
            $stmt = $this->connection->prepare($this->insertQuery);

            foreach ($values as $value)
            {
                if (is_int($value))
                {
                    $stmt->bind_param("i", $value);
                }
                else if (is_string($value))
                {
                    $stmt->bind_param("s", $value);
                }
                else if (is_float($value))
                {

                }
            }

            $stmt->execute();

            $this->connection->commit();
        }
        catch (\Exception $e)
        {
            $this->connection->rollback();
        }
    }

    protected function elimina ($pk) : void
    {
        try
        {
            $query = "DELETE FROM '$this->name' WHERE '$this->pk' = '$pk'";

            $this->connection->query($query);

            $this->connection->commit();
        }
        catch (\Exception $e)
        {
            $this->connection->rollback();
        }
    }

    // TODO
    protected function aggiorna ($pk) : void
    {

    }

    protected function api_prendi ($pk = null) : void
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

    private function settaArrayColonne () : void
    {
        $query = "SELECT column_name FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$this->name';";

        $this->columns = $this->connection->query($query)->fetch_array();
    }

    private function settaQueryInserimento ()
    {
        $query = "INSERT INTO '$this->name'(";

        foreach ($this->columns as $column)
        {
            $query .= "$column,";
        }

        $query = rtrim($query, ",") . ") VALUES (";

        foreach ($this->columns as $column)
        {
            $query .= "?, ";
        }

        $query = rtrim($query, ",") . ")";
        
        $this->insertQuery = $query;
    }

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