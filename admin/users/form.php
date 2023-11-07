<?php
$title = 'Inserir nova usuário';
$userName = '';
$userEmail = '';
$userAvatar = 'avatar.png';
$action = '/admin/users/insert.php';
$invalid = array_key_exists('validate', $_GET) && $_GET['validate'] === 'false';
$messageInvalid = 'Dados já existem com os dados informados, verifique!';
$isEdit = isset($_GET['page']) && $_GET['page'] === 'edit' && array_key_exists('id', $_GET);

if ($_GET['page'] === 'edit' && array_key_exists('id', $_GET)) {
    $title = 'Alterar usuário';
    $userModel = new \App\core\Users();
    $user = $userModel->getOneById($_GET['id']);
    $action = '/admin/users/edit.php?id=' . $_GET['id'];
    if (isset($user->name)) {
        $userName = $user->name;
        $userEmail = $user->email;
        $userAvatar = $user->avatar;
        $title .= " ID: $user->id";
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
        <?php if ($isEdit) : ?>
            <div class="col s12 m8 offset-m2 l6 offset-l3">
                <div class="card-panel grey lighten-5 z-depth-1">
                    <div class="row valign-wrapper">
                        <div class="col s2">
                            <img src="/public/images/users/<?php echo $userAvatar; ?>" alt="Avatar"
                                 class="circle responsive-img">
                        </div>
                        <div class="col s10">
                          <span class="black-text">
                            <?php echo "Nome: $userName - E-mail: $userEmail - Avatar: $userAvatar"?>
                          </span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="file-field input-field">
            <div class="btn">
                <span>Arquivo</span>
                <input type="file" name="avatar" accept="image/png, image/jpeg">
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text" name="avatar" <?php echo "value=\"$userAvatar\""; ?>>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input id="name" name="name" <?php echo "value=\"$userName\""; ?> type="text" class="validate">
                <label for="name">Nome completo</label>
                <?php if ($invalid): ?>
                    <span class="helper-text red-text text-lighten-2" data-error="wrong" data-success="right">
                        <?php echo $messageInvalid ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input id="email" name="email" <?php echo "value=\"$userEmail\""; ?> type="email" class="validate">
                <label for="email">E-mail</label>
                <?php if ($invalid): ?>
                    <span class="helper-text red-text text-lighten-2" data-error="wrong" data-success="right">
                        Verifique o e-mail
                    </span>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input id="password" name="password" type="password" class="validate">
                <label for="password">Senha</label>
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
