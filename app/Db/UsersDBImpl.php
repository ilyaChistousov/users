<?php

namespace App\Db;

use Exception;

class UsersDBImpl implements UsersDB
{
    private DBConnection $db;
    public function __construct()
    {
        $this->db = DBConnection::getInstance();
    }

    public function all(): array
    {
        $query = "SELECT * FROM users";
        return $this->db->select($query);
    }

    public function getOne(int $id): array
    {
        $query = "SELECT * FROM users WHERE id = :id LIMIT 1";

        $result = $this->db->select($query, ['id' => $id]);
        if (empty($result)) {
            throw new Exception('User not found');
        }
        return $result;
    }

    public function create(array $data): int
    {
        $query = "INSERT INTO users (name) VALUES (:name)";
        $this->db->query($query, $data);

        return $this->db->lastInsertId();
    }

    public function delete(int $id): void
    {
        $this->getOne($id);

        $query = "DELETE FROM users WHERE id = :id";
        $this->db->query($query, ['id' => $id]);
    }
}
