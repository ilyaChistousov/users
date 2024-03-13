<?php

namespace App\Db;

use PDO;

class DBConnection
{
    private PDO $pdo;
    private static $instance;

    public static function getInstance(): static
    {
        if (static::$instance === null) {
            static::$instance = new DBConnection();
        }
        return static::$instance;
    }

    private function __construct()
    {
        $host = 'mysql';
        $dbname = 'users';
        $user = 'user';
        $password = 'password';

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function select(string $query, array $params = []): ?array
    {
        return $this->query($query, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function query(string $query, array $params = []): \PDOStatement
    {
        $statement = $this->pdo->prepare($query);
        $statement->execute($params);
        return $statement;
    }

    public function lastInsertId(): int
    {
        return $this->pdo->lastInsertId();
    }
}
