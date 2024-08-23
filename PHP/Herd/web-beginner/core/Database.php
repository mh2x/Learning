<?php
class Database
{
    private $connection;
    private $statement;

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

    public function query($query, $params = [])
    {

        //prepare a new query
        $this->statement = $this->connection->prepare($query);
        //run it
        $this->statement->execute($params);
        return $this;
    }

    //or you can name it all
    public function get()
    {
        $result = $this->statement->fetchAll();
        return $result;
    }

    public function find()
    {
        $result = $this->statement->fetch();
        return $result;
    }

    public function findOrFail()
    {
        $result = $this->find();
        if (! $result) {
            abort();
        }
        return $result;
    }
}
