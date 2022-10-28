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
