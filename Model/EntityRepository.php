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

    public function addItemCart($table, $id)
    {
        $idCart = 1;
        $result = $this->getPdo()->prepare("INSERT INTO cart_items (idCart, idItem,cat) VALUES (:idCart, :idItem, :table)");
        $result->bindValue(':idCart', $idCart);
        $result->bindValue(':idItem', $id);
        $result->bindValue(':table', $table);
        $result->execute();
        $cart = $this->getPdo()->prepare("SELECT * FROM cart_items WHERE idCart = $idCart");
        $cart->execute();
        $cart = $cart->fetch(PDO::FETCH_ASSOC)['*'];
        return $cart;
    }

    public function getCart()
    {
        $idCart = 1;
        $cart = $this->getPdo()->query("SELECT * FROM cart_items WHERE idCart = $idCart");
        $cart = $cart->fetchAll(PDO::FETCH_ASSOC);

        $items = $this->getAllItems();
        $freshItems = $this->getAllFreshItems();
        $tickets = $this->getAllTickets();



        $finalCart = new ShoppingCart();

        foreach ($cart as $cartItem) {
            if ($cartItem['cat'] == 'item') {
                foreach ($items as $i) {
                    if ($i->id == $cartItem['idItem']) {
                        $finalCart->addItem($i);
                    }
                }
            }
            if ($cartItem['cat'] == 'freshitem') {
                foreach ($freshItems as $i) {
                    if ($i->id == $cartItem['idItem']) {
                        $finalCart->addItem($i);
                    }
                }
            }
            if ($cartItem['cat'] == 'ticket') {
                foreach ($tickets as $i) {
                    if ($i->id == $cartItem['idItem']) {
                        $finalCart->addItem($i);
                    }
                }
            }
        }

        return $finalCart;
    }

    public function getAllItems(): array
    {
        $query = $this->getPdo()->query("SELECT * FROM item");
        $items = $query->fetchAll(PDO::FETCH_ASSOC);
        $entityItems = [];
        foreach ($items as $item) {
            $entityItems[] = new Item($item['id'], $item['name'], $item['price'], $item['weight']);
        }
        return $entityItems;
    }

    public function getAllTickets(): array
    {
        $query = $this->getPdo()->query("SELECT * FROM ticket");
        $tickets = $query->fetchAll(PDO::FETCH_ASSOC);
        $entityTickets = [];
        foreach ($tickets as $ticket) {
            $entityTickets[] = new Ticket($ticket['id'], $ticket['reference'], $ticket['price']);
        }
        return $entityTickets;
    }

    public function getAllFreshItems(): array
    {
        $query = $this->getPdo()->query("SELECT * FROM freshitem");
        $freshItems = $query->fetchAll(PDO::FETCH_ASSOC);
        $entityFreshItems = [];
        foreach ($freshItems as $freshItem) {
            $entityFreshItems[] = new FreshItem($freshItem['id'], $freshItem['name'], $freshItem['price'], $freshItem['weight'], $freshItem['dlc']);
        }
        return $entityFreshItems;
    }
}
