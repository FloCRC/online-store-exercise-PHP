<?php

declare(strict_types=1);

class Customer{
    public string $firstName;
    protected string $lastName;
    protected string $address;
    protected string $postcode;
    protected EmailAddress $email;
    public function __construct(string $firstName, string $lastName, string $address, string $postcode, EmailAddress $email)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->address = $address;
        $this->postcode = $postcode;
        $this->email = $email;
    }
    public function getAddress(): string
    {
        return "<p>
                    $this->lastName, $this->firstName<br />
                    $this->address $this->postcode
                </p>";
    }
}