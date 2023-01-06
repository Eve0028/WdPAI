<?php

require_once 'Repository.php';

class SignupDataRepository extends Repository
{
    public function getUserTypes(): array|false
    {
        $statement = $this->database->connect()->prepare('
            SELECT * FROM user_type
        ');
        $statement->execute();

        $userTypesAll = $statement->fetchAll(PDO::FETCH_ASSOC);
        return array_column($userTypesAll, 'user_type');
    }
}