<div class="container">
    <div class="col s2">
        <?php
        try {
            $postModel = new \App\core\Posts();
            $search = $_POST['search'];
            $postModel->setSearch($search);
            $posts = $postModel->getBySearch();

            if (!count($posts)) {
                throw new Exception();
            }

            $categoryName = $posts[0]->categoryName;
            echo "<h2 class=\"header\">Resultado da busca por: $search</h2>";

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
        } catch (Exception $exception) {
            include "/var/www/views/empty.php";
        }
        ?>
    </div>
</div>