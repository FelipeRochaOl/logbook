<?php
require "/var/www/vendor/autoload.php";
include "/var/www/admin/auth.php";
try {
    $user = new \App\core\Users();
    if (!$user->validate($_POST)) {
        throw new Exception('POST is invalid');
    }
    if (!empty($_FILES['avatar']['name'])) {
        $file = new \App\core\File($_FILES['avatar']);
        $file->setDestinationPath('/var/www/public/images/users');
        $file->save();
    }
    $user->setName($_POST['name']);
    $user->setEmail($_POST['email']);
    $user->setPassword($_POST['password']);
    $user->setAvatar($_POST['avatar']);
    $response = $user->create();
    if (!$response->success) {
        header("Location: http://localhost:8080/admin/users/?page=create&validate=false");
        exit;
    }
    header("Location: http://localhost:8080/admin/users/?success=create");
    exit;
} catch (Exception $exception) {
    header("Location: http://localhost:8080/admin/users/?page=create&error=true");
}