<?php
require "/var/www/vendor/autoload.php";
include "/var/www/admin/auth.php"
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="../../styles/global.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <title>Admin Blog MentalAid - Postagens</title>
</head>
<body>
<?php
include "../header.php";
$route = new \App\core\Route('posts', $_GET);
$route->render();
?>
</body>
</html>
<script type="application/javascript">
    M.AutoInit();
</script>