<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController
{
    public function login()
    {
        $userRepository = new UserRepository();

        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        try {
            $user = $userRepository->getUser($email);
        } catch (Exception $err) {
            return $this->render('login', ['warnings' => [$err->getMessage()]]);
        }
        if ($user->getPasswordHash() !== $password) {
            return $this->render('login', ['warnings' => ['User with this email or password not exist!']]);
        }

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/dashboard");
    }

    public function signup()
    {
        $this->render('signup');
    }
}