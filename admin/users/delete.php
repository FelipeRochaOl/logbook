<?php
require "/var/www/vendor/autoload.php";
include "/var/www/admin/auth.php";
$id = $_GET['id'];
try {
    $user = new \App\core\Users();
    if (!array_key_exists('id', $_GET)) {
        throw new Exception('ID is required');
    }
    $user->setID($id);
    $response = $user->delete();
    if (!$response->success) {
        throw new Exception('Error with validation');
    }
    header("Location: http://localhost:8080/admin/users/?success=delete");
    exit;
} catch (Exception $exception) {
    header("Location: http://localhost:8080/admin/users/?page=delete&id=$id&error=true");
}