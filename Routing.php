<?php

require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/SecurityController.php';

class Routing {
    public static $get_routes;
    public static $post_routes;

    public static function get($url, $controller) {
        self::$get_routes[$url] = $controller;
    }

    public static function post($url, $controller) {
        self::$post_routes[$url] = $controller;
    }

    public static function run($url, $method) {
        $action = explode('/', $url)[0];
        if ($method == "GET") {
            $routes = self::$get_routes;
        } else if ($method == "POST") {
            $routes = self::$post_routes;
        }
        if (!array_key_exists($action, $routes)) {
            die("URL doesn't exist");
        }
        $controller = $routes[$action];
        $object = new $controller();
        $action = $action ?: 'index';
        $object->$action();
    }
}