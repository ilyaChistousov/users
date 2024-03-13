<?php

namespace App\Controller;

use App\Db\UsersDB;
use Exception;

class Users
{
    public function __construct(
        private UsersDB $usersDB
    ) {
    }

    public function all(): void
    {
        var_dump($this->usersDB->all());
    }

    public function getOne(int $id): void
    {
        try {
            $user = $this->usersDB->getOne($id)[0];
            echo "User id=$id name=" . $user['name'] . "\n";
        } catch (Exception $e) {
            echo 'User not found' . "\n";
        }
    }

    public function delete(int $id): void
    {
        try {
            $this->usersDB->delete($id);
            echo 'User deleted' . "\n";
        } catch (Exception $e) {
            echo "User with id = $id not found \n";
        }
    }

    public function create(?string $name): void
    {
        if (!$name) {
            throw new Exception('Name is empty');
        }
        $this->usersDB->create([
            'name' => $name,
        ]);

        echo 'User created' . "\n";
    }
}
