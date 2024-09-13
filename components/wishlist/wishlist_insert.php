<?php
session_start();
include '../../admin/database.php';
// $link = '../../';
include "../class/wishlist_class.php";

$wishlist = new wishlist;

if((!isset($_GET['product_id']) || $_GET['product_id'] == NULL) ||
(!isset($_SESSION['id']) || $_SESSION['id'] == NULL)) {
    echo "<script>alert('Please Login❗') </script>";
    echo "<script> window.location.href='/PHP/happy-furni-php/index.php?page=login-register'</script>";
} else {
    $product_id = $_GET['product_id'];
    $user_id = $_SESSION['id'];
    $result = $wishlist->insert_wishlist($user_id, $product_id);
    echo "<script> window.location.href='/PHP/happy-furni-php/index.php?page=wishlist'</script>";
} 
?>