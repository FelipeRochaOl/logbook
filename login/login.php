<div class="container">
    <div class="row">
        <h2>Login</h2>
    </div>
    <form class="col s6" action="/login/auth.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="input-field col s12">
                <input id="email" name="email" type="email" class="validate">
                <label for="email">E-mail</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input id="password" name="password" type="password" class="validate">
                <label for="password">Senha</label>
            </div>
        </div>
        <div class="row center">
            <button class="btn waves-effect waves-light" type="submit" name="action">Entrar
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