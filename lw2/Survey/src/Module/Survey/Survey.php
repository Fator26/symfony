<?php

namespace App\Module\Survey;

class Survey
{
    private ?string $firstName;
    private ?string $lastName;
    private ?string $email;
    private ?string $age;

    public function __construct(?string $firstName, ?string $lastName, ?string $email, ?string $age)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->age = $age;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getAge(): ?string
    {
        return $this->age;
    }
}
