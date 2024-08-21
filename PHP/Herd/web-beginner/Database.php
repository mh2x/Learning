<?php
class Database
{
    private $connection;

    public function __construct($connectionString)
    {

        $this->connection = new PDO($connectionString);
    }

    public function query($query)
    {

        //prepare a new query
        $stmt = $this->connection->prepare($query);
        //run it
        $stmt->execute();
        return $stmt;
    }
}
