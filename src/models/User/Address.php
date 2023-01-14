<?php

class Address
{
    private $postalCode;
    private $street;
    private $locality;
    private $number;

    public function __construct(string $postalCode, string $street, string $locality, int $number)
    {
        $this->postalCode = $postalCode;
        $this->street = $street;
        $this->locality = $locality;
        $this->number = $number;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    public function getLocality(): string
    {
        return $this->locality;
    }

    public function setLocality(string $locality): void
    {
        $this->locality = $locality;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function setNumber(int $number): void
    {
        $this->number = $number;
    }
}