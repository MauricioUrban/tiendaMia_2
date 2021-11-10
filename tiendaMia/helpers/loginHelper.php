<?php

class LoginHelper {
    
    function __construct() {
        if (session_status() != PHP_SESSION_ACTIVE) { 
            session_start();
        }
    }

    public function login($user) {
        $_SESSION['USER_ID'] = $user->id;
        $_SESSION['USER_EMAIL'] = $user->email;
        header("Location: " . BASE_URL . "/admin"); 
    }


    public function checkLoggedIn() { 
        if (empty($_SESSION['USER_ID'])) {
            header("Location: " . BASE_URL ."/login");
            die();
        }
    }

    function logout() {
        session_destroy();
        header("Location: " . BASE_URL ."/home");   
    } 
}