<?php
class AuthView {
    private $user = null;

    public function showLogin($error = '') {
        require 'templates/login.phtml';
    }

    public function showSignup($error = '') {
        require 'templates/form_signup.phtml';
    }
}
