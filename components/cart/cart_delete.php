<?php
session_start();
include '../../admin/database.php';
// $link = '../../';
include "../class/cart_class.php";

if((isset($_GET['product_id'])) &&
(isset($_SESSION['id']))) {
    $cart = new cart;
    $user_id = $_SESSION['id'];
    $product_id = $_GET['product_id'];
    $cart->delete_cart($user_id, $product_id);
    echo "<script> window.location.href='/PHP/happy-furni-php/index.php?page=cart'</script>";
}
?>