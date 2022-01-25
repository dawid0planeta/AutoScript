<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';

class SecurityController extends AppController {

    public function login() {
        if (!$this->isPost()) {
            return $this->render('login');
        }
        $user = new User('ab@gmail.com', 'admin', 'John', 'Snow');
        var_dump($_POST);
        die();
    }

    public function register() {
        if (!$this->isPost()) {
            return $this->render('register');
        }
        var_dump($_POST);
        die();
    }

}