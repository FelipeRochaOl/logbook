<?php
    $title = 'Inserir nova categoria';
    $categoryName = '';
    $action = '/admin/categories/insert.php';
    $invalid = array_key_exists('validate', $_GET) && $_GET['validate'] === 'false';
    $messageInvalid = 'Dados já existem com os dados informados, verifique!';

    if ($_GET['page'] === 'edit' && array_key_exists('id', $_GET)) {
        $title = 'Alterar categoria';
        $categoryModel = new \App\core\Categories();
        $category = $categoryModel->getOneById($_GET['id']);
        $action = '/admin/categories/edit.php?id=' . $_GET['id'];
        if (isset($category->name)) {
            $categoryName = $category->name;
            $title .= " ID: $category->id";
        }
    }
?>
<div class="container">
    <div class="row">
        <span class="col s12 left-align grey lighten-2 grey-text text-darken-3">
            <?php echo $title; ?>
        </span>
    </div>
    <form class="col s12" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="input-field col s12">
                <input id="name" name="name" <?php echo "value=\"$categoryName\""; ?> type="text" class="validate">
                <label for="name">Nome da categoria</label>
                <?php if ($invalid): ?>
                    <span class="helper-text red-text text-lighten-2" data-error="wrong" data-success="right">
                        <?php echo $messageInvalid ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>
        <div class="row center">
            <button class="btn waves-effect waves-light" type="submit" name="action">Salvar
                <i class="material-icons right">send</i>
            </button>
        </div>
    </form>
    <?php
    if (array_key_exists('error', $_GET)) {
        include "/var/www/views/error.php";
    }
    ?>
</div>
