<?php
$userModel = new \App\core\Users();
$users = $userModel->getAll();
?>
<div class="container">
    <table class="striped">
        <caption class="left-align grey lighten-2 grey-text text-darken-3">Lista de Usuários</caption>
        <thead>
        <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>
        </thead>

        <tbody>
        <?php
        if (!count($users)) {
            echo "
            <tr>
                <td colspan=\"4\" class=\"center\">Não há dados para exibir</td>
            </tr>
            ";
        }
        foreach ($users as $user) {
            echo "
            <tr>
                <td>$user->id</td>
                <td>$user->name</td>
                <td>$user->email</td>
                <td>
                    <a class=\"waves-effect waves-light btn-flat\" href=\"/admin/users/?page=edit&id=$user->id\"><i class=\"material-icons\">edit</i></a>
                    <a class=\"waves-effect waves-light btn-flat\" href=\"/admin/users/delete.php?id=$user->id\"><i class=\"material-icons\">delete</i></a>
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
