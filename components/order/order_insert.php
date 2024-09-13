<?php
session_start();
include '../../admin/database.php';
include "../class/cart_class.php";
include "../class/order_class.php";

if(isset($_SESSION['email'])) {
    $cart = new cart;
    $order = new order;
    $user_id = $_SESSION['id'];

    $address = $_POST['address'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $phone_number = $_POST['phone_number'];
    $note = $_POST['note'];
    $payment = $_POST['payment']; 
    $arr_product_name = [];
    $arr_quantity = [];
    $arr_total = [];
    

    $show_cart_detail = $cart->show_cart_detail($user_id);
    if(mysqli_num_rows($show_cart_detail) > 0) {
        while($result = mysqli_fetch_assoc($show_cart_detail)) {
            array_push($arr_product_name, $result['product_name']);
            array_push($arr_quantity, $result['quantity']);
            array_push($arr_total, $result['quantity'] * $result['product_price_new']);
        }
    }

    for($i=0;$i<count($arr_product_name);$i++) {
        $order->insert_order($user_id, $phone_number,$address, $city, $country,
        $arr_product_name[$i], $arr_quantity[$i], $arr_total[$i], $note, $payment);
    }

    $cart->delete_cart_by_user($user_id);

    echo "<script>alert('📦 Order Successfully 📦')</script>";
    echo "<script> window.location.href='/PHP/happy-furni-php/index.php?page=accounts'</script>";
}
?>