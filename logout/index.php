<?php
require "/var/www/vendor/autoload.php";
session_start();
$session = new \App\core\Session();
$session->logout();
header("Location: http://localhost:8080");
exit;