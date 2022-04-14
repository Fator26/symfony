<?php
header("Content-Type: text/plain");

class Survey
{
    private string $first_Name;
    private string $last_Name;
    private string $email;
    private string $age;

    function __construct(string $first_Name = '', string $last_Name = '', string $email = '', string $age = '')
    {
        $this->first_Name = $first_Name;
        $this->last_Name = $last_Name;
        $this->email = $email;
        $this->age = $age;
    }

    public function getFirstName(): string
    {
        return $this->first_Name;
    }

    public function getLastName(): string
    {
        return $this->last_Name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getAge(): string
    {
        return $this->age;
    }
}
