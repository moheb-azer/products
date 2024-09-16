<?php

namespace Core;

use PDO;
use PDOException;

class Database {
    private PDO $connection;

    public function __construct($config, $username="root", $password="") {
        $dsn = 'mysql:'.http_build_query($config,'',';');
        try {
            $this->connection = new PDO($dsn, $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }

    public function query($query, $params=[])
    {
        $statement = $this->connection->prepare($query);
        $statement->execute($params);
        return $statement;
    }
}