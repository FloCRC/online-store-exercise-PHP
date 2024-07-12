<?php

declare(strict_types=1);

class ShoppingBasket implements Displayable {
    private array $basket = [];
    private Customer $customer;
    private float $basketTotal = 0;
    private float $shippingCostTotal = 0;
    private float $basketPlusShippingTotal = 0;
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }
    public function addToBasket(Product $product): void
    {
        $this->basket[] = $product;
    }
    public function display(): string
    {
        $result = "<div><h3>This is your basket: {$this->customer->firstName}<ul>";
        foreach ($this->basket as $product){
            if ($product->canDiscount){
                $result .= "<li>$product->title - $product->discountedPrice</li>";
            }
            else {
                $result .= "<li>$product->title - $product->price</li>";
            }
        }
        $result .= "<ul></div>";
        return $result;
    }
    public function getBasketTotal(): float
    {
        $this->basketTotal = 0;
        foreach ($this->basket as $product){
            if($product->canDiscount) {
                $this->basketTotal += $product->discountedPrice;
            }
            else {
                $this->basketTotal += $product->price;
            }
        }
        $paysVAT = !isset($this->customer->vatNum);
        if ($paysVAT) {
            $this->basketTotal *= 1.2;
        }
        return $this->basketTotal;
    }
    public function getShippingCostTotal(): float
    {
        $this->shippingCostTotal = 0;
        foreach ($this->basket as $product){
            $this->shippingCostTotal += $product->shippingCosts();
        }
        $paysVAT = !isset($this->customer->vatNum);
        if ($paysVAT) {
            $this->shippingCostTotal *= 1.2;
        }
        return $this->shippingCostTotal;
    }
    public function getBasketPlusShippingTotal(): float
    {
        $basketTotal = $this->getBasketTotal();
        $shippingTotal = $this->getShippingCostTotal();
        $this->basketPlusShippingTotal = $basketTotal + $shippingTotal;
        $paysVAT = !isset($this->customer->vatNum);
        if ($paysVAT) {
            $this->basketPlusShippingTotal *= 1.2;
        }
        return $this->basketPlusShippingTotal;
    }
}