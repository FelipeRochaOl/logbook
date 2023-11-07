<?php
$categoryModel= new \App\core\Categories();
$categories = $categoryModel->getAll();
$date = new \App\core\DateFormat();
$session = new \App\core\Session();
?>
<header>
    <nav class="nav-wrapper blue darken-3 nav-date">
        <div class="right">
            <?php echo $date->formatFullDatetime(); ?>
        </div>
    </nav>
    <nav>
        <div class="nav-wrapper blue darken-3">
            <a href="/" class="logo brand-logo">Meu amiguinho sam</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <?php
                foreach ($categories as $category) {
                    $isActive = '';
                    if (isset($_GET['id']) && $_GET['id'] == $category->id) {
                        $isActive = 'active';
                    }
                    echo "<li class=\"$isActive\"><a href=\"/categories/?id=$category->id\">$category->name</a></li>";
                }
                ?>
            </ul>
            <?php
                if ($session->sessionValid()) {
                    $name = $_SESSION['name'];
                    echo "<ul id=\"nav-mobile\" class=\"right hide-on-med-and-down truncate\"><a href=\"/admin/\">$name</a></ul>";
                } else {
                    echo "<ul id=\"nav-mobile\" class=\"right hide-on-med-and-down\"><a href=\"/admin/\">Admin</a></ul>";
                }
            ?>
        </div>
    </nav>
    <?php
        include '/var/www/views/search.php';
        include '/var/www/views/breadcrumbs.php';
    ?>
</header>
