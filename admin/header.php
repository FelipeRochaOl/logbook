<?php
$datetime = new \App\core\DateFormat();
?>
<header>
    <nav class="nav-wrapper blue darken-3 nav-date">
        <div class="right">
            <?php echo $datetime->formatFullDatetime(); ?>
        </div>
    </nav>
    <ul id="slide-out" class="sidenav">
        <li>
            <div class="user-view">
                <div class="background blue darken-2"></div>
                <a href="#user"><img class="circle" src="/public/images/users/<?php echo $_SESSION['avatar']; ?>"></a>
                <a href="#name"><span class="white-text name"><?php echo $_SESSION['name']; ?></span></a>
                <a href="#email"><span class="white-text email"><?php echo $_SESSION['email']; ?></span></a>
            </div>
        </li>
        <li><a href="/admin/">v1.0.0</a></li>
        <li>
            <div class="divider"></div>
        </li>
        <li><a class="subheader">Postagens:</a></li>
        <li><a href="/admin/posts/" class="waves-effect"><i class="material-icons">list</i>Listar postagens</a></li>
        <li><a href="/admin/posts/?page=create" class="waves-effect"><i class="material-icons">add</i>Inserir nova postagem</a></li>
        <li>
            <div class="divider"></div>
        </li>
        <li><a class="subheader">Categorias:</a></li>
        <li><a href="/admin/categories/" class="waves-effect"><i class="material-icons">list</i>Listar categorias</a></li>
        <li><a href="/admin/categories/?page=create" class="waves-effect"><i class="material-icons">add</i>Inserir nova categoria</a></li>
        <li>
            <div class="divider"></div>
        </li>
        <li><a class="subheader">Usuários:</a></li>
        <li><a href="/admin/users/" class="waves-effect"><i class="material-icons">list</i>Listar usuários</a></li>
        <li><a href="/admin/users/?page=create" class="waves-effect"><i class="material-icons">add</i>Inserir novo usuário</a></li>
    </ul>
    <nav>
        <div class="nav-wrapper blue darken-3">
            <a href="#" data-target="slide-out" class="sidenav-trigger show-on-large"><i class="material-icons">menu</i></a>
            <a href="/admin/" class="logo brand-logo">Meu amiguinho sam</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="/"><i class="large material-icons">home</i></a></li>
                <li><a href="/logout/"><i class="large material-icons">exit_to_app</i></a></li>
            </ul>
        </div>
    </nav>
</header>
