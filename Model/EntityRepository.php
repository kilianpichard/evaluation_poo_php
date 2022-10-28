<?php

namespace Model;

use PDO;
use PDOException;
use Exception;

class EntityRepository
{
    private $pdo;
    public $table;

    public function getPdo()
    {
        if (!$this->pdo) {
            try {
                $xml = simplexml_load_file('./App/config.xml');
                $this->table = $xml->table;

                try {
                    $this->pdo = new PDO(
                        "mysql:host=$xml->host;port=$xml->port;dbname=$xml->dbname",
                        "$xml->user",
                        "$xml->password",
                        [
                            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                            PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8'
                        ]
                    );
                } catch (PDOException $err) {
                    echo '<pre>';
                    print_r($err);
                    echo '</pre>';
                }
            } catch (Exception $erreur) {
                echo "An error occured during config.xml loading. Please try again later. \n Erreur " . $err->getMessage() . '\n Il y a une erreur ligne ' . $err->getLine() . ' dans le fichier ' . $erreur->getFile() . '\n';
            }
        }

        return $this->pdo;
    }

    public function getAllEmployees(): array
    {
        $query = $this->getPdo()->query("SELECT * FROM $this->table");
        $employees = $query->fetchAll(PDO::FETCH_ASSOC);
        return $employees;
    }

    public function getEmployeeById($id): array
    {
        $query = $this->getPdo()->query("SELECT * FROM $this->table WHERE id" . ucfirst($this->table) . "=" . (int) $id);
        $employee = $query->fetch(\PDO::FETCH_ASSOC);
        return $employee;
    }

    public function saveEntityRepo()
    {
    }

    public function select(): string
    {
        return "Select one employee";
    }

    public function delete(): string
    {
        return "Delete an employee";
    }

    public function getFields(): array
    {
        $query = $this->getPdo()->query("DESC $this->table");
        $fields = $query->fetchAll(PDO::FETCH_ASSOC);
        return $fields;
    }
}
