<?php
include 'layouts/header.php';

if (!isset($_GET['page'])) {
    include 'layouts/home.php';
} else {
    $file = 'components/' . $_GET['page'] . '.php';
    if (is_file($file))
        include $file;
    else
        include 'layouts/home.php';
}
include 'layouts/footer.php';
