<?php

declare(strict_types=1);

abstract class Product implements Displayable {
    protected string $title;
    private string $description;
    protected float $price;
    private float $discountedPrice;
    private bool $canDiscount = false;
    protected float $weight;
    public function __construct(string $title, string $description, float $price, bool $canDiscount, float $weight)
    {
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->canDiscount = $canDiscount;
        $this->discountedPrice = $price;
        $this->weight = $weight;
    }
    public function display(): string
    {
        if ($this->discountedPrice !== $this->price) {
            return "<div class='product'>
                    <h3>$this->title</h3>
                    <span class='old-price'>£$this->price, </span>
                    <span class='discount'>NOW with 10% discount - £$this->discountedPrice! Limited time only!</span>
                    <p>$this->description</p>
                </div>";
        }
        return "<div class='product'>
                    <h3>$this->title</h3>
                    <span>£$this->price</span>
                    <p>$this->description</p>
                </div>";
    }
    public function discountProduct(): void
    {
        if ($this->canDiscount){
            $this->discountedPrice *= 0.9;
        }
    }
    abstract public function shippingCosts(): float;
    public function getTitle(): string
    {
        return $this->title;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
    public function getPrice(): float
    {
        return $this->price;
    }
    public function getDiscountedPrice(): float
    {
        return $this->discountedPrice;
    }
    public function isCanDiscount(): bool
    {
        return $this->canDiscount;
    }
    public function getWeight(): float
    {
        return $this->weight;
    }
}