<?php

require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/SnippetController.php';

class Routing {
    public static $routes;

    public static function get($url, $controller) {
        self::$routes[$url] = $controller;
    }

    public static function post($url, $controller) {
        self::$routes[$url] = $controller;
    }

    public static function run($url, $method) {
        $url_elems = explode('/', $url);
        $action = $url_elems[0];
        if (!array_key_exists($action, self::$routes)) {
            die($url_elems);
            // die("URL doesn't exist");
        }

        $controller = self::$routes[$action];
        $object = new $controller();
        $action = $action ?: 'index';
        if ($action == 'snippet' || $action == 'download_snippet' || $action == 'delete_snippet') {
            $snippet_id = $url_elems[1];
            if ($snippet_id) {
                $object->$action($snippet_id);
            } else {
                $object->catalog();
            }
        } else {
            $object->$action();
        }

    }
}