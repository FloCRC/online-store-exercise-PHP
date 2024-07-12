<?php

declare(strict_types=1);

class SmallProduct extends Product{
    public function shippingCosts(): float
    {
        if ($this->price > 100){
            return 0;
        }
        if ($this->weight > 50){
            return 7.99;
        }
        if ($this->weight > 10){
            return 4.99;
        }
        return 1.99;
    }
}