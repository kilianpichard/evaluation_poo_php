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

        $item1 = new Model\Item('Bread', 100, 500);
        $item2 = new Model\Item('Milk', 200, 1000);
        $item3 = new Model\Item('Butter', 300, 250);
        $item4 = new Model\Item('Eggs', 400, 100);
        $item5 = new Model\Item('Cheese', 500, 500);

        $freshItem1 = new Model\FreshItem('Salmon', 600, 1000, '2019-12-31');
        $freshItem2 = new Model\FreshItem('Tuna', 700, 1000, '2019-12-31');
        $freshItem3 = new Model\FreshItem('Sardines', 800, 1000, '2019-12-31');
        $freshItem4 = new Model\FreshItem('Sausages', 900, 1000, '2019-12-31');

        $shoppingCart->addItem($item1);
        $shoppingCart->addItem($item2);
        $shoppingCart->addItem($item3);
        $shoppingCart->addItem($item4);
        $shoppingCart->addItem($item5);

        $shoppingCart->addItem($freshItem1);
        $shoppingCart->addItem($freshItem2);
        $shoppingCart->addItem($freshItem3);
        $shoppingCart->addItem($freshItem4);

        $shoppingCart->removeItems($item2);



        $ticket1 = new Model\Ticket('Coldplay Concert', 7900);


        $shoppingCart->addItem($ticket1);

        $invoice1 = new Model\Invoice();

        $cartItems = $shoppingCart->getItems();
        foreach ($cartItems as $item) {
            $invoice1->addPayable($item);
        }

        $this->shoppingCart = $shoppingCart;
        $this->invoice = $invoice1;
    }

    public function handleRequest()
    {
        $action = $_GET['action'] ?? NULL;

        try {
            switch ($action) {
                case 'add':
                    $this->addItem($_GET['item']);
                    break;
                case 'update':
                    return $this->save($action);
                    break;
                case 'select':
                    return $this->select();
                    break;
                case 'delete':
                    return $this->delete();
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

    public function addItem($name)
    {
        echo "ok";
        $items = $this->dbEntityRepository->getAllItems();
        foreach ($items as $item) {
            if ($item->getName() == $name) {
                $this->shoppingCart->addItem($item);
            }
        }
        // get id from item 
        $result = $this->dbEntityRepository->addItemCart($name);
        echo $result;
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
                'cart' => $this->shoppingCart,
            ]
        );
    }

    public function save($userChoice)
    {
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        $data = ($userChoice === 'update') ? $this->dbEntityRepository->getFields() : NULL;
        if ($_POST) {
            $this->dbEntityRepository->saveEntityRepo($id);
            header('Location: index.php');
            exit;
        }

        $this->render(
            'layout.php',
            'contact_form.php',
            [
                'title' => 'Manage employees',
                'data' => $data,
                'fields' => $this->dbEntityRepository->getFields(),
                'id' => 'id' . ucfirst($this->dbEntityRepository->table),
            ]
        );
    }

    public function select()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;

        $this->render(
            'layout.php',
            'employee.php',
            [
                'title' => 'Personnnal informations of ',
                'data' => $this->dbEntityRepository->getEmployeeById($id),
            ]
        );
    }

    public function delete(): string
    {
        return "Delete an employee";
    }
}
