<?php

declare(strict_types=1);

class LargeProduct extends Product{
    private float $height;
    private float $depth;
    public function __construct(string $title, string $description, float $price, bool $canDiscount, float $weight, float $height, float $depth)
    {
        parent::__construct($title, $description, $price, $canDiscount, $weight);
        $this->height = $height;
        $this->depth = $depth;
    }
    public function shippingCosts(): float
    {
        if ($this->price > 10000){
            return 0;
        }
        if ($this->height > 500 || $this->depth > 500){
            return 600;
        }
        if ($this->height > 200 || $this->depth > 200){
            return 200;
        }
        return 150;
    }
}