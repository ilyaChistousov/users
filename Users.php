<?php

class Users
{
    private DbParody $db;

    public function __construct()
    {
        $this->db = new DbParody();
    }

    public function all(): void
    {
        var_dump($this->db->getAll());
    }

    public function getOne(int $id): void
    {
        try{
            $user = $this->db->findById($id);
            echo "User id=$id name=" . $user['name'] . "\n";
        } catch (Exception $e) {
            echo 'User not found' . "\n";
        }
    }

    public function delete(int $id): void
    {
        try{
            $id =$this->db->remove($id);
            echo 'User with id = ' . $id . ' deleted' . "\n";
        } catch (Exception $e) {
            echo "User with id = $id not found \n";
        }
    }

    public function create(string $name): void
    {
        $this->db->add([
            'name' => $name,
        ]);

        echo 'User created' . "\n";
    }
}