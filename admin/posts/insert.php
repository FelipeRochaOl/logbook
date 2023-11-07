<?php
require "/var/www/vendor/autoload.php";
include "/var/www/admin/auth.php";
try {
    $post = new \App\core\Posts();
    if (!$post->validate($_POST)) {
        throw new Exception('POST is invalid');
    }
    $file = new \App\core\File($_FILES['image']);
    $file->setDestinationPath('/var/www/public/images');
    $file->save();
    $post->setID('0');
    $post->setTitle($_POST['title']);
    $post->setCategoryId($_POST['categoryId']);
    $post->setDate($_POST['datePost']);
    $post->setContent($_POST['content']);
    $post->setImage($file->getName());
    $response = $post->create();
    if (!$response->success) {
        header("Location: http://localhost:8080/admin/posts/?page=create&validate=false");
        exit;
    }
    header("Location: http://localhost:8080/admin/posts/?success=create");
    exit;
} catch (Exception $exception) {
    header("Location: http://localhost:8080/admin/posts/?page=create&error=true");
}