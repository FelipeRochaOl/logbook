<?php
require "/var/www/vendor/autoload.php";
include "/var/www/admin/auth.php";
$id = $_GET['id'];
try {
    $category = new \App\core\Categories();
    if (!array_key_exists('id', $_GET)) {
        throw new Exception('ID is required');
    }
    $category->setID($id);
    $response = $category->delete();
    if (!$response->success) {
        throw new Exception('Error with validation');
    }
    header("Location: http://localhost:8080/admin/categories/?success=delete");
    exit;
} catch (Exception $exception) {
    header("Location: http://localhost:8080/admin/categories/?page=delete&id=$id&error=true");
}