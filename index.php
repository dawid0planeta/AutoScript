<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('index', 'DefaultController');
Routing::get('catalog', 'SnippetController');
Routing::get('my_snippets', 'SnippetController');
Routing::post('add_snippet', 'SnippetController');
Routing::post('register', 'SecurityController');
Routing::post('login', 'SecurityController');
Routing::run($path, $method);