<?php

require_once 'Address.php';

class User
{
    private $email;
    private $passwordHash;
    private $userType;

    private $name;
    private $surname;
    private $pesel;
    private $dateOfBirth;
    private $placeOfBirth;
    private $address;
    private $phoneNumber;
    private $gender;

    private $enabled;

    public function __construct(string $email, string $passwordHash, string $userType,
                                string $name, string $surname, string $pesel,
                                string $dateOfBirth, string $placeOfBirth, Address $address,
                                string $phoneNumber, string $gender,
                                bool   $enabled)
    {
        $this->email = $email;
        $this->passwordHash = $passwordHash;
        $this->userType = $userType;
        $this->name = $name;
        $this->surname = $surname;
        $this->pesel = $pesel;
        $this->dateOfBirth = $dateOfBirth;
        $this->placeOfBirth = $placeOfBirth;
        $this->address = $address;
        $this->phoneNumber = $phoneNumber;
        $this->gender = $gender;

        $this->enabled = $enabled;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function setPasswordHash(string $passwordHash): void
    {
        $this->passwordHash = $passwordHash;
    }

    public function getUserType(): string
    {
        return $this->userType;
    }

    public function setUserType(string $userType): void
    {
        $this->userType = $userType;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function getPesel(): string
    {
        return $this->pesel;
    }

    public function setPesel($pesel): void
    {
        $this->pesel = $pesel;
    }

    public function getDateOfBirth(): string
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth($dateOfBirth): void
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    public function getPlaceOfBirth(): string
    {
        return $this->placeOfBirth;
    }

    public function setPlaceOfBirth($placeOfBirth): void
    {
        $this->placeOfBirth = $placeOfBirth;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): void
    {
        $this->address = $address;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setGender($gender): void
    {
        $this->gender = $gender;
    }

    public function getEnabled()
    {
        return $this->enabled;
    }

    public function setEnabled($enabled): void
    {
        $this->enabled = $enabled;
    }
}