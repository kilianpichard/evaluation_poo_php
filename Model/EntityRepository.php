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

    public function addItemCart($name)
    {
        echo $name;
        $id = $this->getPdo()->prepare("SELECT id FROM item WHERE name = :name");
        $id->bindValue(':name', $name);
        $id->execute();
        $id = $id->fetch(PDO::FETCH_ASSOC)['id'];
        echo ($id);
    }

    public function getAllItems(): array
    {
        $query = $this->getPdo()->query("SELECT * FROM item");
        $items = $query->fetchAll(PDO::FETCH_ASSOC);
        $entityItems = [];
        foreach ($items as $item) {
            $entityItems[] = new Item($item['name'], $item['price'], $item['weight']);
        }
        return $entityItems;
    }

    public function getAllFreshItems(): array
    {
        $query = $this->getPdo()->query("SELECT * FROM freshitem");
        $freshItems = $query->fetchAll(PDO::FETCH_ASSOC);
        $entityFreshItems = [];
        foreach ($freshItems as $freshItem) {
            $entityFreshItems[] = new FreshItem($freshItem['name'], $freshItem['price'], $freshItem['weight'], $freshItem['dlc']);
        }
        return $entityFreshItems;
    }
}
