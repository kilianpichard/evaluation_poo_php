<?php

namespace Controller;

use Model;


class Controller
{
    private $dbEntityRepository;
    private $invoice;
    private $shoppingCart;

    public function __construct()
    {
        $this->dbEntityRepository = new Model\EntityRepository;

        $shoppingCart = new Model\ShoppingCart();
        $shoppingCart->addItem(new Model\Item(1, 'Bread', 100, 100));

        $this->shoppingCart = $shoppingCart;
    }

    public function handleRequest()
    {
        $action = $_GET['action'] ?? NULL;

        try {
            switch ($action) {
                case 'add':
                    $this->addItem($_GET['table'], $_GET['item']);
                    break;
                case 'panier':
                    return $this->cart();
                    break;
                default:
                    return $this->selectAll();
                    break;
            }
        } catch (\Exception $err) {
            echo 'An error occurred during get form informations. \n';
            echo 'Error: ' . $err->getMessage() . '\n Line: ' . $err->getLine() . ' in ' . $err->getFile() . ' file';
        }
    }

    public function addItem($table, $id)
    {
        $result = $this->dbEntityRepository->addItemCart($table, $id);
        $this->shoppingCart = $result;
        $this->selectAll();
    }

    public function render($layout, $template, $parameters = array())
    {
        extract($parameters);
        ob_start();
        require("Views/$template");
        $content = ob_get_clean();

        ob_start();
        require("Views/$layout");

        return ob_end_flush();
    }

    public function selectAll()
    {
        $this->render(
            'layout.php',
            'Shopping.php',
            [
                'title' => 'Items',
                'items' => $this->dbEntityRepository->getAllItems(),
                'freshItems' => $this->dbEntityRepository->getAllFreshItems(),
                'tickets' => $this->dbEntityRepository->getAllTickets(),
                'cart' => $this->dbEntityRepository->getCart(),
            ]
        );
    }


    public function cart()
    {
        $cart = $this->dbEntityRepository->getCart();

        $this->render(
            'layout.php',
            'ShoppingCart.php',
            [
                'title' => 'Panier',
                'cart' => $cart,
            ]
        );
    }

    public function delete(): string
    {
        return "Delete an employee";
    }
}
