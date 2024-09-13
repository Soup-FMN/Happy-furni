<?php 
session_start();
include "../../admin/database.php";
// $link = '../../';
include "../class/cart_class.php";

$cart = new cart;
$arr_product_id = $_GET;
$user_id = $_SESSION['id'];

foreach($arr_product_id as $product_id => $quantity) {
    $cart->update_cart($user_id, $product_id, $quantity);
}
echo "<script> window.location.href='/PHP/happy-furni-php/index.php?page=cart'</script>";
?>