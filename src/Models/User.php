<?php

namespace Mkshao\Web\Models;

use Mkshao\Web\Database\Db;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class User
{
    public $id;
    public $name;
    public $year_of_birth;
    public $created_at;
    public $updated_at;

    public $newDb;

    public function __construct()
    {
        $this->newDb = new Db();
    }

    public function showUser()
    {
        $showUser = $this->newDb->read("users");
        return $showUser;
    }

    public function showUserById($id)
    {
        $showUser = $this->newDb->readById("users", $id);
        return $showUser;

    }

    public function createUser($data)
    {
        $data = $this->newDb->create("users", $data);
        if ($this->newDb->DBconnection) {
            return $this->newDb->connection->lastInsertId();
        } else {
            return $data;
        }

    }

    public function updateUser($data, $id)
    {
        $this->newDb->update("users", $data, $id);
    }

    public function deleteUser($id)
    {
        $this->newDb->delete("users", $id);
    }
}