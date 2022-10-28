<?php

class FreshItem extends Item
{
    public $bestBeforeDate;

    public function __construct($name, $price, $weight, $bestBeforeDate)
    {
        parent::__construct($name, $price, $weight);
        $this->bestBeforeDate = $bestBeforeDate;
    }

    public function getBestBeforeDate()
    {
        return $this->bestBeforeDate;
    }

    public function toString()
    {
        return $this->name . ': ' . number_format(floatval($this->price / 100), 2) . '€ - to be consumed before ' . date("D d M Y", strtotime($this->getBestBeforeDate()));
    }

    public function taxRatePerThousands()
    {
        // remove 0.1 if the weight is more than 1000 and 0.1 for each 1000g more
        $times = floor($this->weight / 1000);
        return parent::taxRatePerThousands() - ($times > 1 ? 0.1 * $times : 0);
    }
}
