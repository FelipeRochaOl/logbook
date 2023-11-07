<?php
require "/var/www/vendor/autoload.php";
session_start();
?>
<!doctype html>
<html lang="pt-br">
<?php
include "views/head.php";
?>
<body>
<?php
include "views/header.php";
include "views/home.php";
include "views/preload.php";
include "views/footer.php";
?>
</body>
</html>
