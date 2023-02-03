<?php

require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/GradesController.php';

class Routing
{
    public static $routes;

    public static function get($url, $controller): void
    {
        self::$routes[$url] = $controller;
    }

    public static function post($url, $controller): void
    {
        self::$routes[$url] = $controller;
    }

    public static function run($url): void
    {
        $action = explode("/", $url)[0];

        if (!array_key_exists($action, self::$routes)) {
            die("Wrong url!");
        }
        if(empty($action)){
            $action = 'login';
        }

        $controller = self::$routes[$action];
        $object = new $controller;
        $object->$action();
    }
}