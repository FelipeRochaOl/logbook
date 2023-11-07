<?php
$categoriesModel = new \App\core\Categories();
$categories = $categoriesModel->getAll();
?>
<div class="container">
    <table class="striped">
        <caption class="left-align grey lighten-2 grey-text text-darken-3">Lista de Categorias</caption>
        <thead>
        <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
        </thead>

        <tbody>
        <?php
        if (!count($categories)) {
            echo "
            <tr>
                <td colspan=\"3\" class=\"center\">Não há dados para exibir</td>
            </tr>
            ";
        }
        foreach ($categories as $category) {
            echo "
            <tr>
                <td>$category->id</td>
                <td>$category->name</td>
                <td>
                    <a class=\"waves-effect waves-light btn-flat\" href=\"/admin/categories/?page=edit&id=$category->id\"><i class=\"material-icons\">edit</i></a>
                    <a class=\"waves-effect waves-light btn-flat\" href=\"/admin/categories/delete.php?id=$category->id\"><i class=\"material-icons\">delete</i></a>
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
