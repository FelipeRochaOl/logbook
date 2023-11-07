<?php
require "/var/www/vendor/autoload.php";
include "/var/www/admin/auth.php";
$id = $_GET['id'];
try {
    $post = new \App\core\Posts();
    if (!$post->validate($_POST)) {
        throw new Exception('POST is invalid');
    }
    if (!array_key_exists('id', $_GET)) {
        throw new Exception('ID is required');
    }
    $imageName = $_POST['image'];
    if (!empty($_FILES['image']['name'])) {
        $file = new \App\core\File($_FILES['image']);
        $file->setDestinationPath('/var/www/public/images');
        $file->save();
        $imageName = $file->getName();
    }
    $post->setID($id);
    $post->setTitle($_POST['title']);
    $post->setCategoryId($_POST['categoryId']);
    $post->setDate($_POST['datePost']);
    $post->setContent($_POST['content']);
    $post->setImage($imageName);
    $response = $post->edit();
    if (!$response->success) {
        header("Location: http://localhost:8080/admin/posts/?page=edit&id=$id&validate=false");
        exit;
    }
    header("Location: http://localhost:8080/admin/posts/?success=edit");
    exit;
} catch (Exception $exception) {
    header("Location: http://localhost:8080/admin/posts/?page=edit&id=$id&error=true");
}