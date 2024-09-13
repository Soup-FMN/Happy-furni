<?php
include "../layouts/header.php";
include "../layouts/slider.php";
include "../database.php";
include "../class/order_class.php";
?>
<?php
$order = new order;

if($_GET['id'] == NULL || !isset($_GET['id'])) {
    echo "<script> window.location = 'order_show.php' </script>";
} else {
    $id = $_GET['id'];
}

$order->delete_order($id);
?>