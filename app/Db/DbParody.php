<?php

namespace App\Db;

use Exception;

class DbParody implements UsersDB
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

    public function all(): array
    {
        return $this->data;
    }

    public function create(array $data): int
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

    public function delete(int $id): void
    {
        $foundElement = $this->getOne($id)[0];

        array_splice($this->data, array_search($foundElement, $this->data), 1);

        $this->save();

    }

    public function getOne(int $id): array
    {
        $foundElement = $this->data[array_search($id, array_column($this->data, 'id'))];
        if ($foundElement['id'] !== $id) {
            throw new Exception('User not found');
        }
        // TODO ля какой костыль
        $result = ['0' => [...$foundElement]];

        return $result;
    }

    private function save(): int
    {
        $data = [
            'users' => $this->data
        ];

        file_put_contents(__DIR__ . '/../../db.json', json_encode($data));

        return $this->id;
    }

    private function getData(): array
    {
        return json_decode(file_get_contents(__DIR__ . '/../../db.json'), true)['users'];
    }
}
