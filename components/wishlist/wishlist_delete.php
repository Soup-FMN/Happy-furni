<?php
session_start();
include '../../admin/database.php';
include "../class/wishlist_class.php";

if((isset($_GET['product_id'])) &&
(isset($_SESSION['id']))) {
    $wishlist = new wishlist;
    $user_id = $_SESSION['id'];
    $product_id = $_GET['product_id'];
    $wishlist->delete_wishlist($user_id, $product_id);
    echo "<script> window.location.href='/PHP/happy-furni-php/index.php?page=wishlist'</script>";
}
?>