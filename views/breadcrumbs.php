<?php
    $route = new \App\core\Route('', $_GET);
    $breadcrumbs = $route->generateBreadcrumbs($_SERVER['REQUEST_URI']);
?>
<nav>
    <div class="nav-wrapper blue darken-3">
        <div class="col s11 breadcrumbs">
            <?php
                foreach ($breadcrumbs as $breadcrumb) {
                    echo "<a href=\"$breadcrumb->url\" class=\"breadcrumb\">$breadcrumb->description</a>";
                }
            ?>
        </div>
    </div>
</nav>