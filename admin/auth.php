<?php
session_start();
$session = new \App\core\Session();
if (!$session->sessionValid()) {
    header("Location: http://localhost:8080/login/");
    exit;
}