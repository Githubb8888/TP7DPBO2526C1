<?php

class Database
{
    private $host = 'localhost';
    private $dbname = 'db_catalog';
    private $username = 'root';
    private $password = '';

    public function connect()
    {
        $pdo = new PDO(
            "mysql:host=$this->host;dbname=$this->dbname;charset=utf8mb4",
            $this->username,
            $this->password
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $pdo;
    }
}
