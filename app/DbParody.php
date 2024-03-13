<?php

namespace App;

use Exception;

class DbParody
{
    private array $data;
    private int $id = 0;

    public function __construct()
    {
        $this->data = $this->getData();
        $lastElement = end($this->data);
        if ($lastElement['id'] !== null) {
            $this->id = $lastElement['id'];
        }
    }

    public function getAll(): array
    {
        return $this->data;
    }

    public function add(array $data): int
    {
        $this->id++;
        $newElement = [
            'id' => $this->id,
            ...$data
        ];
        $this->data[] = $newElement;

        $this->save();

        return $this->id;
    }

    public function remove(int $id): int
    {
        $foundElement = $this->findById($id);

        array_splice($this->data, array_search($foundElement, $this->data), 1);

        $this->save();

        return $id;
    }

    public function findById(int $id): array
    {
        $foundElement = $this->data[array_search($id, array_column($this->data, 'id'))];
        if ($foundElement['id'] !== $id) {
            throw new Exception('User not found');
        }
        return $foundElement;
    }

    private function save(): void
    {
        $data = [
            'users' => $this->data
        ];

        file_put_contents('db.json', json_encode($data));
    }

    private function getData(): array
    {
        return json_decode(file_get_contents('db.json'), true)['users'];
    }
}
