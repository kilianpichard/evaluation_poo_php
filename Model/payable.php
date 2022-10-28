<?php

abstract class Payable
{
    public $description;
    public $amount;
    abstract public function taxRatePerThousands();

    public function __construct($description, $amount)
    {
        $this->description = $description;
        $this->amount = $amount;
    }

    public function label()
    {
        return $this->description;
    }

    public function cost()
    {
        return $this->amount;
    }

    public function toString()
    {
        return $this->description . ': ' . number_format(floatval($this->amount / 100), 2) . '€';
    }
}
