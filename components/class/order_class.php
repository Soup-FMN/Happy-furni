<?php

class order
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function insert_order(
        $user_id,
        $phone_number,
        $address,
        $city,
        $country,
        $product_name,
        $quantity,
        $total,
        $note,
        $payment
    ) {
        $query = "INSERT INTO `tbl_order`
        (`user_id`, `phone_number`, `address`, `city`, 
        `country`, `product_name`, `quantity`, `total`, `note`,`payment`) 
        VALUES 
        ('$user_id', '$phone_number', '$address', '$city', 
        '$country', '$product_name', '$quantity', '$total', '$note','$payment')";
        $result = $this->db->insert($query);
    }

    public function show_order($user_id) {
        $query = "SELECT tbl_order.*, tbl_user.name AS user_name FROM tbl_order
        JOIN tbl_user ON tbl_order.user_id = tbl_user.id WHERE tbl_user.id = $user_id" ;
        $result = $this->db->select($query);
        return $result;
    }

}
