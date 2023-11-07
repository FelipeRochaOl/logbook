<div class="card-panel green lighten-2 center-align">
    <h6>
        <?php
        switch ($_GET['success']) {
            case 'create':
                echo 'Dados inseridos com sucesso!';
                break;
            case 'edit':
                echo 'Dados editados com sucesso!';
                break;
            case 'delete':
                echo 'Dados deletados com sucesso!';
                break;
            default:
                echo 'Sucesso!';
        }
        ?>
    </h6>
</div>