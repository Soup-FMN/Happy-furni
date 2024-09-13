<?php
session_start();
if($_SESSION['role'] == 'admin' &&
(isset($_SESSION['email']))) {
    echo "<script>alert('️😽 Welcome Back Admin 😽')</script>";
    echo "<script> window.location.href='/PHP/happy-furni-php/admin/category/category_insert.php'</script>";
} else {
    echo "<script>alert('️You don't have Permission to Access')</script>";
    echo "<script> window.location.href='/PHP/happy-furni-php/index.php?brand_id=37'</script>";
}
?>