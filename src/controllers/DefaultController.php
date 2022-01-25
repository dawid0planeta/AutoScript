<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function login() {
        $this->render('login');
    }

    public function register() {
        $this->render('register');
    }

    public function catalog() {
        $this->render('catalog');
    }

    public function index() {
        $this->render('landing', ['message' => 'hello world']);
    }

    public function add_snippet() {
        $this->render('add_snippet');
    }

    public function my_snippets() {
        $this->render('my_snippets');
    }

}