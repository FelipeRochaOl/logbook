<?php
require "/var/www/vendor/autoload.php";
session_start();
try {
    $session = new \App\core\Session();
    if (!$session->validate($_POST)) {
        throw new Exception();
    }
    $session->login($_POST['email'], $_POST['password']);
    if (!$_SESSION['isLogged']) {
        throw new Exception();
    }
    header("Location: http://localhost:8080/");
    exit;
} catch (Exception $exception) {
    header("Location: http://localhost:8080/login/?page=login&error=true");
    exit;
}