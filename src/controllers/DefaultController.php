<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function catalog() {
        $this->render('catalog');
    }

    public function index() {
        $this->render('landing', ['message' => 'hello world']);
    }

    public function my_snippets() {
        $this->render('my_snippets');
    }

}