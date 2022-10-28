<?php

namespace Model;

class ShoppingCart
{
    private $items = array();
    private static $id = 0;
    private $weight = 0;
    private static $maxWeight = 1000000000;

    public function __construct()
    {
        //create a unique id begein with 1 and increment by 1
        self::$id++;
        $this->id = self::$id;
    }

    public function addItem($item)
    {
        try {
            if ($this->getTotalWeight() + $item->weight <= self::$maxWeight) {
                $this->items[] = $item;
                $this->weight += $item->weight;
            } else {
                throw new \Exception("The weight of the cart is too heavy.");
            }
        } catch (\Exception $e) {
            echo 'Caught exception: ' .  $e->getMessage();
        }
    }

    public function removeItems($item)
    {
        //if item is in the cart, remove it
        if (in_array($item, $this->items)) {
            $this->total -= $item->getPrice();
            $this->weight -= $item->weight;
            unset($this->items[array_search($item, $this->items)]);
            echo 'Item removed from cart<br>';
        } else {
            echo 'Item not in cart<br>';
            return false;
        }
    }

    public function itemCount()
    {
        return count($this->items);
    }

    public function getItems()
    {
        return $this->items;
    }

    public function totalPrice()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->getPrice();
        }
        return number_format(floatval($total / 100), 2) . '€';
    }

    public function getTotalWeight()
    {
        return $this->weight;
    }

    public function toString()
    {
        $output = '';
        $output .= 'Shopping cart ID : ' . $this->getID() . ' - Total Items : ' . $this->itemCount() . '<br>';
        foreach ($this->items as $item) {
            $output .= $item->getName() . ': ' . number_format(floatval($item->getPrice() / 100), 2) . '€<br>';
        }
        return $output . '<br>';
    }

    public function __destruct()
    {
        self::$id--;
    }

    public function getId()
    {
        return $this->id;
    }
}
