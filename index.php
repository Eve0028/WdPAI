<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

Routing::get('', 'DefaultController');
Routing::get('index', 'DefaultController');
Routing::post('login', 'SecurityController');
Routing::get('signup', 'SecurityController');
Routing::get('logout', 'SecurityController');

Routing::get('dashboard', 'DefaultController');
Routing::get('grades', 'GradesController');
//Routing::get('grades', 'DefaultController');

Routing::run($path);
