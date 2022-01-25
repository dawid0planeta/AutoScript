<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';

class SecurityController extends AppController {

    public function login() {
        $user = new User('ab@gmail.com', 'admin', 'John', 'Snow');
        var_dump($_POST);
        die();
    }

    public function register() {
        var_dump($_POST);
        die();
    }

}