<?php

namespace Model;

class Ticket extends Payable
{
    public $reference;
    public $price;
    public $taxRate = 2500;

    public function __construct($reference, $price)
    {
        parent::__construct($reference, $price);
        $this->reference = $reference;
        $this->price = $price;
    }

    public function getReference()
    {
        return $this->reference;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function toString()
    {
        return $this->reference . ': ' . number_format(floatval($this->price / 100), 2) . '€';
    }

    public function taxRatePerThousands()
    {
        return $this->taxRate / 100;
    }
}
