<?php

namespace App\Db;

interface UsersDB
{
    public function all(): array;
    public function getOne(int $id): array;
    public function create(array $data): int;
    public function delete(int $id);
}