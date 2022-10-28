<?php

require('Model/item.php');
require('Model/freshItem.php');
require('Model/ticket.php');
require('Model/shoppingCart.php');
require('Model/invoice.php');

class View
{

    public function __construct()
    {
        echo 'View created.<br>';
    }

    public function render($layout, $template, $parameters = array())
    {
        extract($parameters);
        ob_start();
        require("Views/$template");
        $content = ob_get_clean();
        require("Views/$layout");

        return ob_end_flush();
    }
}




$shoppingCart = new ShoppingCart();

$item1 = new Item('Bread', 100, 500);
$item2 = new Item('Milk', 200, 1000);
$item3 = new Item('Butter', 300, 250);
$item4 = new Item('Eggs', 400, 100);
$item5 = new Item('Cheese', 500, 500);

$freshItem1 = new FreshItem('Salmon', 600, 1000, '2019-12-31');
$freshItem2 = new FreshItem('Tuna', 700, 1000, '2019-12-31');
$freshItem3 = new FreshItem('Sardines', 800, 1000, '2019-12-31');
$freshItem4 = new FreshItem('Sausages', 900, 1000, '2019-12-31');

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



$ticket1 = new Ticket('Coldplay Concert', 7900);


$shoppingCart->addItem($ticket1);

$invoice1 = new Invoice();

$cartItems = $shoppingCart->getItems();
foreach ($cartItems as $item) {
    $invoice1->addPayable($item);
}

$view = new View();

$view->render(
    'layout.php',
    'Shopping.php',
    [
        'title' => 'Shopping',
        'cart' => $shoppingCart,
    ]
);
