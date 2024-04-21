<?php

namespace database;

class Database
{
    private $databaseName = 'login_register';
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';

    public function connect()
    {
        try {
            $pdo = new \PDO("mysql:host=$this->host;dbname=$this->databaseName;port=3307", $this->username, $this->password);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (\PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            return null;
        }
    }
}
