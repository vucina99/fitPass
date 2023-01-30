<?php

namespace Mkshao\Web\Database;
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class Db
{
    // todo make this class to be folow singleton pattern.

    public $connection;
    private string $host;
    private string $username;
    private string $password;
    public string $dbName;

    //set true if you want databse , or false if you dont't want
    public bool $DBconnection = true;

    public function __construct()
    {
        if ($this->DBconnection) {

            // $this->host = $_ENV["DB_HOST"];
            // $this->username = $_ENV["DB_USERNAME"];
            // $this->password = $_ENV["DB_PASSWORD"];
            // $this->dbName = $_ENV["DB_NAME"];
            // $this->connection = new \PDO("mysql:host=$this->host;dbname=$this->dbName" , $this->username,  $this->password);


            //.env funkcionise,ali zbog nacina rutiranja(ocitavanje fajlova),ne moze da funkcionise na testovima  :)

            $this->connection = new \PDO("mysql:host=localhost;dbname=c1laraveldb", "root", "");
        }


    }

    public function create($table, $data)
    {
        $updated_at = date("Y-m-d H:i:s");
        $data["updated_at"] = $updated_at;
        $data["created_at"] = $updated_at;
        if ($this->DBconnection) {
            $keys = array_keys($data);
            $values = array_values($data);
            $sql = "INSERT INTO $table (" . implode(', ', $keys) . ") VALUES ('" . implode("', '", $values) . "')";
            $this->connection->exec($sql);
        } else {
            // Generate a unique id for the user
            $id = self::getUsers() + 1;
            $data["id"] = $id;
            $_SESSION['users'][$id] = $data;
            return $id;
        }

    }

    public static function getUsers()
    {
        if (!isset($_SESSION['users'])) {
            return 0;
        } else {
            return count($_SESSION['users']);
        }
    }

    public function read($table)
    {
        if ($this->DBconnection) {
            $sql = "SELECT * FROM $table";
            $stmt = $this->connection->query($sql);
            return $stmt->fetchAll();
        } else {
            if (isset($_SESSION['users'])) {
                return $_SESSION['users'];
            }
        }
    }

    public function readById($table, $id = null)
    {
        if ($this->DBconnection) {
            $sql = "SELECT * FROM $table WHERE id = $id";
            $stmt = $this->connection->query($sql);
            return $stmt->fetch();
        } else {
            if (!isset($_SESSION['users'])) {
                return [];
            } else {
                if (isset($_SESSION['users'][$id])) {
                    return $_SESSION['users'][$id];
                } else {
                    header("Location: index.php");
                }
            }
        }
    }

    public function update($table, $data, $id)
    {
        $updated_at = date("Y-m-d H:i:s");
        $data["updated_at"] = $updated_at;
        if ($this->DBconnection) {
            $set = '';
            foreach ($data as $key => $value) {
                if ($key !== "page") {
                    $set .= "$key = '$value',";
                }
            }
            $set = rtrim($set, ',');
            $sql = "UPDATE $table SET $set WHERE id = $id";

            $this->connection->exec($sql);
        } else {
            if (isset($_SESSION['users']) && $_SESSION['users'][$id]) {

                $data['created_at'] = $_SESSION['users'][$id]['created_at'];
                $data['id'] = $_SESSION['users'][$id]['id'];
                $_SESSION['users'][$id] = $data;
            }


        }
    }


}