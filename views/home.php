<?php
$postModel = new \App\core\Posts();
$posts = $postModel->getAll();
?>
<div class="container">
    <div class="row">
        <div class="col s9">
            <h2 class="header">Postagens:</h2>
            <?php
            foreach ($posts as $post) {
                $formatDate = new \App\core\DateFormat($post->date_publication);
                $date = $formatDate->formatDate();
                echo "
                <div class=\"card horizontal hoverable\">
                    <div class=\"card-image valign-wrapper\">
                        <img src=\"/public/images/$post->image\" width='100px' height='100px'>
                    </div>
                    <div class=\"card-stacked\">
                        <div class=\"card-content\">
                            <span class=\"card-title\">$date - $post->title</span>
                            <p id=\"limit-content\">$post->content</p>
                        </div>
                        <div class=\"card-action\">
                            <a href=\"/posts/?id=$post->id\">Leia mais</a>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>
        </div>
        <div class="banner col s3">
            <div class="row">
                <span>Propaganda:</span>
            </div>
            <div class="row valign-wrapper">
                <img src="https://picsum.photos/200/500.webp?random=1">
            </div>
        </div>
    </div>
</div>