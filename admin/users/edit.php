<?php
require "/var/www/vendor/autoload.php";
include "/var/www/admin/auth.php";
$id = $_GET['id'];
try {
    $user = new \App\core\Users();
    if (!$user->validate($_POST)) {
        throw new Exception('POST is invalid');
    }
    if (!array_key_exists('id', $_GET)) {
        throw new Exception('ID is required');
    }
    $imageName = $_POST['avatar'];
    if (!empty($_FILES['avatar']['name'])) {
        $file = new \App\core\File($_FILES['avatar']);
        $file->setDestinationPath('/var/www/public/images/users');
        $file->save();
        $imageName = $file->getName();
    }
    $user->setID($id);
    $user->setName($_POST['name']);
    $user->setEmail($_POST['email']);
    $user->setPassword($_POST['password']);
    $user->setAvatar($imageName);
    $response = $user->edit();
    if (!$response->success) {
        header("Location: http://localhost:8080/admin/users/?page=edit&id=$id&validate=false");
        exit;
    }
    header("Location: http://localhost:8080/admin/users/?success=edit");
    exit;
} catch (Exception $exception) {
    header("Location: http://localhost:8080/admin/users/?page=edit&id=$id&error=true");
}