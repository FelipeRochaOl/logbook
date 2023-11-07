<?php
require "/var/www/vendor/autoload.php";
include "/var/www/admin/auth.php";
try {
    $category = new \App\core\Categories();
    if (!$category->validate($_POST)) {
        throw new Exception('POST is invalid');
    }
    $category->setName($_POST['name']);
    $response = $category->create();
    if (!$response->success) {
        header("Location: http://localhost:8080/admin/categories/?page=create&validate=false");
        exit;
    }
    header("Location: http://localhost:8080/admin/categories/?success=create");
    exit;
} catch (Exception $exception) {
    header("Location: http://localhost:8080/admin/categories/?page=create&error=true");
}