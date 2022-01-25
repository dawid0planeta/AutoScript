<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('index', 'DefaultController');
Routing::get('catalog', 'DefaultController');
Routing::get('register', 'DefaultController');
Routing::get('login', 'DefaultController');
Routing::get('add_snippet', 'DefaultController');
Routing::get('my_snippets', 'DefualtController');
Routing::post('register', 'SecurityController');
Routing::post('login', 'SecurityController');
Routing::run($path, $method);