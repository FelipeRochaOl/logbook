<?php
$title = 'Inserir nova postagem';
$postModel = new \App\core\Posts();
$post = $postModel->getFields();
$categoryModel = new \App\core\Categories();
$categories = $categoryModel->getAll();
$action = '/admin/posts/insert.php';
$isEdit = isset($_GET['page']) && $_GET['page'] === 'edit' && array_key_exists('id', $_GET);

if ($isEdit) {
    $title = 'Alterar postagem';
    $post = $postModel->getOneById($_GET['id']);
    $action = '/admin/posts/edit.php?id=' . $_GET['id'];
    if (isset($post->title)) {
        $title .= " ID: $post->id";
    }
}
?>
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<div class="container">
    <div class="row">
        <span class="col s12 left-align grey lighten-2 grey-text text-darken-3">
            <?php echo $title; ?>
        </span>
    </div>
    <form class="col s12" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="input-field col s12">
                <input id="title" name="title" <?php echo "value=\"$post->title\""; ?> type="text" class="validate">
                <label for="title">Título</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <select name="categoryId">
                    <?php
                    foreach ($categories as $category) {
                        $isSelect = '';
                        if ($category->id == $post->category_id) $isSelect = 'selected';
                        echo "<option value=\"$category->id\" $isSelect>$category->name</option>";
                    }
                    ?>
                </select>
                <label>Categoria</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input type="text" id="date" name="datePost" <?php echo "value=\"$post->date_publication\""; ?>
                       class="datepicker">
                <label for="date">Data da publicação</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <textarea
                        id="textarea"
                        name="content"
                        class="materialize-textarea"
                        maxlength="600"
                ><?php echo trim($post->content); ?></textarea>
                <label for="textarea">Conteúdo</label>
            </div>
        </div>
        <?php if ($isEdit) :?>
        <div class="row">
            <div class="col s12 m6">
                <div class="card small horizontal">
                    <div class="card-image">
                        <?php echo "<img src=\"/public/images/$post->image\" width=\"100\" height=\"100\">"?>
                    </div>
                    <div class="card-stacked">
                        <div class="card-content grey-text text-darken-3">
                            <p>Imagem vinculada como principal na sua postagem</p>
                        </div>
                        <div class="card-action">
                            <span class="grey-text text-darken-3"><?php echo "Nome:$post->image"; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="file-field input-field">
            <div class="btn">
                <span>Arquivo</span>
                <input type="file" name="image" accept="image/png, image/jpeg">
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text" name="image" <?php echo "value=\"$post->image\""; ?>>
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

<script type="application/javascript">
    M.AutoInit();
    document.addEventListener('DOMContentLoaded', function() {
        const elems = document.querySelectorAll('.datepicker');
        const options = {
            format: 'yyyy-mm-dd'
        }
        M.Datepicker.init(elems, options);
    });
</script>