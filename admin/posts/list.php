<?php
$postsModel = new \App\core\Posts();
$posts = $postsModel->getAll();
?>
<div class="container">
    <table class="striped">
        <caption class="left-align grey lighten-2 grey-text text-darken-3">Lista de postagens</caption>
        <thead>
        <tr>
            <th>Código</th>
            <th>Título do Post</th>
            <th>Categoria</th>
            <th>Ações</th>
        </tr>
        </thead>

        <tbody>
        <?php
        if (!count($posts)) {
            echo "
            <tr>
                <td colspan=\"4\" class=\"center\">Não há dados para exibir</td>
            </tr>
            ";
        }
        foreach ($posts as $post) {
            echo "
            <tr>
                <td>$post->id</td>
                <td>$post->title</td>
                <td><span class=\"new badge\" data-badge-caption=\"$post->categoryName\"></span></td>
                <td>
                    <a class=\"waves-effect waves-light btn-flat\" href=\"/admin/posts/?page=edit&id=$post->id\"><i class=\"material-icons\">edit</i></a>
                    <a class=\"waves-effect waves-light btn-flat\" href=\"/admin/posts/delete.php?id=$post->id\"><i class=\"material-icons\">delete</i></a>
                </td>
            </tr>
            ";
        }
        if (array_key_exists('success', $_GET)) {
            include "/var/www/views/success.php";
        }
        if (array_key_exists('error', $_GET)) {
            include "/var/www/views/error.php";
        }
        ?>
        </tbody>
    </table>
</div>
