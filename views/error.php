<div class="card-panel red lighten-2 center-align">
    <h6>
        <?php
        switch ($_GET['page']) {
            case 'create':
                echo 'Ocorreu um erro ao tentar inserir os dados, tente novamente mais tarde.';
                break;
            case 'edit':
                echo 'Ocorreu um erro ao tentar editar os dados, tente novamente mais tarde.';
                break;
            case 'login':
                echo 'Erro com autenticação';
                break;
            default:
                echo 'Ocorreu um erro, tente novamente mais tarde.';
        }
        ?>
    </h6>
</div>