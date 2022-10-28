<?php

class Invoice
{
    public $list = array();

    public function __construct()
    {
        echo 'Invoice created.<br>';
    }

    public function addPayable($payable)
    {
        $this->list[] = $payable;
    }

    public function totalAmount()
    {
        $total = 0;
        foreach ($this->list as $payable) {
            $total += $payable->cost();
        }
        return $total;
    }

    public function totalTax()
    {
        $total = 0;
        foreach ($this->list as $payable) {
            $total += $payable->cost() * $payable->taxRatePerThousands() / 100;
        }
        return $total;
    }
}
