<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/user/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . '/../repository/SignupDataRepository.php';
require_once __DIR__ . '/../repository/ClassRepository.php';

class SecurityController extends AppController
{
    private UserRepository $userRepository;
    private ClassRepository $classRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->classRepository = new ClassRepository();
    }

    public function login()
    {
        if (!$this->isPost()) {
            if (isset($_SESSION['email'])) {
                return $this->render('dashboard');
            }
            return $this->render('login');
        }

        if (!isset($_POST['email']) || !isset($_POST['password'])) {
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

        // session_start();
        setcookie(session_name(), session_id(), time() + 3600);
        $_SESSION['email'] = $email;
        $_SESSION['whole_name'] = $user->getName() . " " . $user->getSurname();
        $_SESSION['user_type'] = $user->getUserType();
        if($_SESSION['user_type'] === "student"){
            $studentClass = $this->classRepository->getStudentClass($email);
            $_SESSION['student_class'] = $studentClass->getClassName();
        }

        return $this->render('dashboard');
    }

    public function signup()
    {
        if (!$this->isPost()) {
            if (isset($_SESSION['email'])) {
                return $this->render('dashboard');
            }

            $signupDataRepo = new SignupDataRepository();
            return $this->render('signup',
                ['userTypes' => $signupDataRepo->getUserTypes(),
                    'genderTypes' => $signupDataRepo->getGenderTypes()]);
        }

        if (!isset($_POST['email']) || !isset($_POST['password'])) {
            return $this->render('signup');
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
            return $this->render('signup', ['messages' => ['Please provide proper password']]);
        }

        // Validate password strength
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8 || strlen($password) > 72) {
            return $this->render('signup', ['messages' => [
                'Password should be between 8 and 72 characters in length and should include at least one upper case letter, one number, and one special character.'
            ]]);
        }

        $address = new Address($postalCode, $street, $locality, $houseNumber);
        $user = new User($email, password_hash($password, PASSWORD_BCRYPT), $userType,
            $name, $surname, $pesel, $dateOfBirth, $placeOfBirth, $address, $phoneNumber, $gender,
            false
        );

        try{
            $this->userRepository->addUser($user);
        } catch (PDOException $err) {
            return $this->render('signup', ['messages' => ['Something went wrong. Please try again later.']]);
        }

        return $this->render('login', ['messages' => ['You\'ve been succesfully registrated!']]);
    }

    public function logout()
    {
        // session_start();

        // Unset all of the session variables.
        $_SESSION = array();

        // If it's desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();

        return $this->render('login');
    }
}