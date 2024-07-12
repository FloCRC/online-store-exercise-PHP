<?php

declare(strict_types=1);

class EmailAddress{
    private string $email;
    public function __construct(string $email)
    {
        $this->setEmail($email);
    }
    private function setEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            throw new Exception("invalid email address");
        }
        $this->email = $email;
    }
}