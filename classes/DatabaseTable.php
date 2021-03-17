<?php

// TODO
class DatabaseTable
{
    private $columns;
    private $pk;
    private $name;
    private $result;
    private $connection;
    private $insertQuery;

    public function __construct (\mysqli $connection, string $pk, string $name)
    {
        $this->$connection = $connection;
        $this->name = $name;
        $this->pk = $pk;

        $this->settaArrayInserimento();
        $this->connection->autocommit(false);
        $this->settaArrayColonne();
    }

    public function seleziona ($pk) : \mysqli_result
    {
        $query = "SELECT * FROM '$this->name' WHERE '$this->pk' = '$pk'";

        $result = $this->connection->query($query);
        $this->result = $result;

        return $result;
    }

    public function selezionaTutto () : \mysqli_result
    {
        $query = "SELECT * FROM '$this->name'";

        $result = $this->connection->query($query);
        $this->result = $result;

        return $result;
    }

    public function inserisci (array $values) : void
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
                    $stmt->bind_param("d", $value);
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

    public function elimina ($pk) : void
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
    public function aggiorna ($pk) : void
    {

    }

    private function settaArrayColonne () : void
    {
        $query = "SELECT column_name FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$this->name';";

        $this->columns = $this->connection->query($query)->fetch_array();
    }

    private function settaArrayInserimento ()
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
};