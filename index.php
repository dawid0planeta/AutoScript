<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('index', 'DefaultController');
Routing::get('catalog', 'SnippetController');
Routing::get('my_snippets', 'SnippetController');
Routing::get('logout', 'SecurityController');
Routing::get('snippet', 'SnippetController');
Routing::get('download_snippet', 'SnippetController');
Routing::get('delete_snippet', 'SnippetController');
Routing::post('add_snippet', 'SnippetController');
Routing::post('register', 'SecurityController');
Routing::post('login', 'SecurityController');
Routing::post('search', 'SnippetController');

session_start();

if (isset($_COOKIE['user_id'])) {
    $_SESSION['user_id'] = $_COOKIE['user_id'];
}

Routing::run($path, $method);