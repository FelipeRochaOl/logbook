<div class="container">
<?php
try {
    $postsModel = new \App\core\Posts();
    $post = $postsModel->getOneById($_GET['id']);
    $dateFormat = new \App\core\DateFormat($post->date_publication);
    $date = $dateFormat->formatDate();
    echo "
        <div class=\"row\">
            <div class=\"col s4 z-depth-1 center valign-wrapper\" id=\"image-post\">
                <img src=\"/public/images/$post->image\" width=\"300\" height=\"300\">
            </div>
            <div class=\"col s8\">
                <b>$date - $post->title</b><br/>
                <span>$post->content</span>
            </div>
        </div>
    ";
} catch (Exception $exception) {
    include "/var/www/views/empty.php";
}
?>
</div>
