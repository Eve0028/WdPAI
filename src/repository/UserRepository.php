<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/user/User.php';

class UserRepository extends Repository
{
    /**
     * @throws Exception when User not found
     */
    public function getUser(string $email): ?User
    {
        $statement = $this->database->connect()->prepare('
            SELECT * FROM user_ 
                LEFT JOIN user_type ut ON user_.user_type_id = ut.user_type_id
                LEFT JOIN user_details ud ON user_.user_details_id = ud.user_details_id
                LEFT JOIN address a on ud.address_id = a.address_id
                LEFT JOIN gender g on ud.gender_id = g.gender_id
                WHERE user_.email = :email
        ');
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            throw new Exception('User not found');
        }

        $address = new Address($user['postal_code'], $user['street'], $user['locality'], $user['number']);

        return new User(
            $user['email'],
            $user['password_'],
            $user['user_type'],
            $user['name_'],
            $user['surname'],
            $user['pesel'],
            $user['date_of_birth'],
            $user['place_of_birth'],
            $address,
            $user['phone_number'],
            $user['gender'],

            $user['enabled_']
        );
    }

    public function addUser(User $user)
    {
        $date = new DateTime();

        //TODO
        // Add transaction system - add all or nothing
        // Add exception

        // Add user address
        $statement = $this->database->connect()->prepare('
            INSERT INTO address (postal_code, street, locality, number)
            VALUES (?, ?, ?, ?)
        ');

        $statement->execute([
            $user->getAddress()->getPostalCode(),
            $user->getAddress()->getStreet(),
            $user->getAddress()->getLocality(),
            $user->getAddress()->getNumber()
        ]);


        // Add user_details
        //TODO
        // Add Caps letters (in trigger in database?)
        $statement = $this->database->connect()->prepare('
            INSERT INTO user_details (name_, surname, pesel, date_of_birth, place_of_birth, address_id, phone_number, gender_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ');

        $statement->execute([
            $user->getName(),
            $user->getSurname(),
            $user->getPesel(),
            $user->getDateOfBirth(),
            $user->getPlaceOfBirth(),
            $this->getAddressId($user->getAddress()),
            $user->getPhoneNumber(),
            $this->getGenderId($user)
        ]);


        // Add user
        $statement = $this->database->connect()->prepare('
            INSERT INTO user_ (user_details_id, user_type_id, password_, email, enabled_, created_at)
            VALUES (?, ?, ?, ?, ?, ?)
        ');

        $statement->execute([
            $this->getUserDetailsId($user),
            $this->getUserTypeId($user),
            $user->getPasswordHash(),
            $user->getEmail(),
            (int)$user->getEnabled(),
            $date->format('Y-m-d')
        ]);
    }


    public function getAddressId(Address $address): int
    {
        $statement = $this->database->connect()->prepare('
            SELECT * FROM address 
                     WHERE postal_code = :postal_code AND 
                        street = :street AND
                        locality = :locality AND
                        number = :number
        ');
        $postalCode = $address->getPostalCode();
        $statement->bindParam(':postal_code', $postalCode, PDO::PARAM_STR);
        $street = $address->getStreet();
        $statement->bindParam(':street', $street, PDO::PARAM_STR);
        $locality = $address->getLocality();
        $statement->bindParam(':locality', $locality, PDO::PARAM_STR);
        $number = $address->getNumber();
        $statement->bindParam(':number', $number, PDO::PARAM_STR);
        $statement->execute();

        $data = $statement->fetch(PDO::FETCH_ASSOC);
        return $data['address_id'];
    }

    public function getGenderId(User $user): int
    {
        $statement = $this->database->connect()->prepare('
            SELECT * FROM gender 
                     WHERE gender = :gender
        ');
        $gender = $user->getGender();
        $statement->bindParam(':gender', $gender, PDO::PARAM_STR);
        $statement->execute();

        $data = $statement->fetch(PDO::FETCH_ASSOC);
        return $data['gender_id'];
    }

    public function getUserDetailsId(User $user): int
    {
        $statement = $this->database->connect()->prepare('
            SELECT * FROM user_details 
                     WHERE name_ = :name AND 
                        surname = :surname AND
                        pesel = :pesel AND
                        date_of_birth = :date_of_birth AND
                        place_of_birth = :place_of_birth AND
                        address_id = :address_id AND
                        phone_number = :phone_number AND
                        gender_id = :gender_id
        ');

        $name = $user->getName();
        $statement->bindParam(':name', $name, PDO::PARAM_STR);
        $surname = $user->getSurname();
        $statement->bindParam(':surname', $surname, PDO::PARAM_STR);
        $pesel = $user->getPesel();
        $statement->bindParam(':pesel', $pesel, PDO::PARAM_STR);
        $dateOfBirth = $user->getDateOfBirth();
        $statement->bindParam(':date_of_birth', $dateOfBirth, PDO::PARAM_STR);
        $placeOfBirth = $user->getPlaceOfBirth();
        $statement->bindParam(':place_of_birth', $placeOfBirth, PDO::PARAM_STR);
        $addressId = $this->getAddressId($user->getAddress());
        $statement->bindParam(':address_id', $addressId, PDO::PARAM_STR);
        $phoneNumber = $user->getPhoneNumber();
        $statement->bindParam(':phone_number', $phoneNumber, PDO::PARAM_STR);
        $genderId = $this->getGenderId($user);
        $statement->bindParam(':gender_id', $genderId, PDO::PARAM_STR);

        $statement->execute();

        $data = $statement->fetch(PDO::FETCH_ASSOC);
        return $data['user_details_id'];
    }

    public function getUserTypeId(User $user): int
    {
        $statement = $this->database->connect()->prepare('
            SELECT * FROM user_type 
                     WHERE user_type = :user_type
        ');

        $userType = $user->getUserType();
        $statement->bindParam(':user_type', $userType, PDO::PARAM_STR);

        $statement->execute();

        $data = $statement->fetch(PDO::FETCH_ASSOC);
        return $data['user_type_id'];
    }
}