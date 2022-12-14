<?php

namespace Model;

class Item extends Payable
{
    public $id;
    public $name;
    public $price;
    public $weight;
    public $taxRate = 1000;

    public function __construct($id, $name, $price, $weight)
    {
        parent::__construct($name, $price);
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->weight = $weight;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function toString()
    {
        return $this->name . ': ' . number_format(floatval($this->price / 100), 2) . '€';
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function taxRatePerThousands()
    {
        return $this->taxRate / 100;
    }
}
