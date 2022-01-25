<?php

require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/SnippetController.php';

class Routing {
    public static $get_routes;
    public static $post_routes;
    public static $routes;

    public static function get($url, $controller) {
        self::$routes[$url] = $controller;
    }

    public static function post($url, $controller) {
        self::$routes[$url] = $controller;
    }

    public static function run($url, $method) {
        $action = explode('/', $url)[0];
        if (!array_key_exists($action, self::$routes)) {
            die("URL doesn't exist");
        }
        $controller = self::$routes[$action];
        $object = new $controller();
        $action = $action ?: 'index';
        $object->$action();
    }
}