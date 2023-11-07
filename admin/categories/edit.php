<?php
require "/var/www/vendor/autoload.php";
include "/var/www/admin/auth.php";
$id = $_GET['id'];
try {
    $category = new \App\core\Categories();
    if (!$category->validate($_POST)) {
        throw new Exception('POST is invalid');
    }
    if (!array_key_exists('id', $_GET)) {
        throw new Exception('ID is required');
    }
    $category->setID($id);
    $category->setName($_POST['name']);
    $response = $category->edit();
    if (!$response->success) {
        header("Location: http://localhost:8080/admin/categories/?page=edit&id=$id&validate=false");
        exit;
    }
    header("Location: http://localhost:8080/admin/categories/?success=edit");
    exit;
} catch (Exception $exception) {
    header("Location: http://localhost:8080/admin/categories/?page=edit&id=$id&error=true");
}