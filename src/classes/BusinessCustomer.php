<?php

declare(strict_types=1);

class BusinessCustomer extends Customer{
    private string $businessName;
    public string $vatNum;
    public function __construct(string $firstName, string $lastName, string $address, string $postcode, EmailAddress $email, string $businessName, string $vatNum)
    {
        parent::__construct($firstName, $lastName, $address, $postcode, $email);
        $this->businessName = $businessName;
        $this->vatNum = $vatNum;
    }
    public function getAddress(): string
    {
        return "<p>
                    $this->lastName, $this->firstName<br />
                    $this->businessName<br />
                    $this->address $this->postcode
                </p>";
    }
}