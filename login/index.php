<?php
require "/var/www/vendor/autoload.php";
session_start();
$session = new \App\core\Session();
if ($session->sessionValid()) {
    header("Location: http://localhost:8080/admin/");
    exit;
}
?>
<!doctype html>
<html lang="pt-br">
<?php
include "/var/www/views/head.php";
?>
<body>
<?php
include "/var/www/views/header.php";
include "./login.php";
include "/var/www/views/preload.php";
include "/var/www/views/footer.php";
?>
</body>
</html>
