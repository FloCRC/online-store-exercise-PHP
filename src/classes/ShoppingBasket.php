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
        $firstName = $this->customer->getFirstName();
        $result = "<div><h3>This is your basket: $firstName<ul>";
        foreach ($this->basket as $product){
            $title = $product->getTitle();
            $price = $product->getPrice();
            $discountedPrice = $product->getDiscountedPrice();
            if ($product->isCanDiscount()){
                $result .= "<li>$title - $discountedPrice</li>";
            }
            else {
                $result .= "<li>$title - $price</li>";
            }
        }
        $result .= "<ul></div>";
        return $result;
    }
    public function getBasketTotal(): float
    {
        $this->basketTotal = 0;
        foreach ($this->basket as $product){
            $price = $product->getPrice();
            $discountedPrice = $product->getDiscountedPrice();
            $canDiscount = $product->isCanDiscount();
            if($canDiscount) {
                $this->basketTotal += $discountedPrice;
            }
            else {
                $this->basketTotal += $price;
            }
        }
        $paysVAT = !method_exists($this->customer, 'getVatNum');
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
        $paysVAT = !method_exists($this->customer, 'getVatNum');
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
        $paysVAT = !method_exists($this->customer, 'getVatNum');
        if ($paysVAT) {
            $this->basketPlusShippingTotal *= 1.2;
        }
        return $this->basketPlusShippingTotal;
    }
}