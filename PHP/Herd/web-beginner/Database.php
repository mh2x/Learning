<?php
class Database
{
    private $connection;

    public function __construct($config, $user, $password = '')
    {
        //$dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";
        //or use this function:
        $dsn = 'mysql:' . http_build_query($config, '', ';');


        $this->connection = new PDO(
            $dsn,
            $user,
            $password,
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );
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
