<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . '/../repository/SignupDataRepository.php';

class SecurityController extends AppController
{
    private UserRepository $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function login()
    {
        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        try {
            $user = $this->userRepository->getUser($email);
        } catch (Exception $err) {
            return $this->render('login', ['warnings' => [$err->getMessage()]]);
        }
        if (!password_verify($password, $user->getPasswordHash())) {
            return $this->render('login', ['warnings' => ['User not found']]);
        }

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/dashboard");
    }

    public function signup()
    {
        if (!$this->isPost()) {
            $signupDataRepo = new SignupDataRepository();
            return $this->render('signup', ['userTypes' => $signupDataRepo->getUserTypes()]);
        }

        $userType = $_POST['userType'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmedPassword = $_POST['confirmedPassword'];

        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $pesel = $_POST['pesel'];
        $dateOfBirth = $_POST['dateOfBirth'];
        $placeOfBirth = $_POST['placeOfBirth'];

        $postalCode = $_POST['postalCode'];
        $street = $_POST['street'];
        $locality = $_POST['locality'];
        $houseNumber = $_POST['houseNumber'];

        $phoneNumber = $_POST['phoneNumber'];
        $gender = $_POST['gender'];

        if ($password !== $confirmedPassword) {
            return $this->render('register', ['messages' => ['Please provide proper password']]);
        }

        // Validate password strength
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8 || strlen($password) > 72) {
            return $this->render('register', ['messages' => [
                'Password should be between 8 and 72 characters in length and should include at least one upper case letter, one number, and one special character.'
            ]]);
        }

        $address = new Address($postalCode, $street, $locality, $houseNumber);
        $user = new User($email, password_hash($password, PASSWORD_BCRYPT), $userType,
            $name, $surname, $pesel, $dateOfBirth, $placeOfBirth, $address, $phoneNumber, $gender,
            true
        );

        $this->userRepository->addUser($user);

        return $this->render('login', ['messages' => ['You\'ve been succesfully registrated!']]);
    }
}