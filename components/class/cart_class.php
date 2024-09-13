<?php
// include $link.'admin/database.php';
?>
<?php

class cart {
    private $db;

    public function __construct()
    {
        $this -> db = new Database();
    }

    public function show_cart($user_id, $product_id) {
        $query = "SELECT * FROM tbl_cart 
        WHERE `user_id` = '$user_id' AND `product_id` = '$product_id'";
        $result = $this ->db->select($query);
        return $result;
    }

    public function show_cart_detail($user_id) {
        $query = "SELECT a.user_id, a.quantity, b.* FROM `tbl_cart` a
        INNER JOIN tbl_product b ON a.product_id = b.product_id
        WHERE a.user_id = '$user_id'";
        $result = $this ->db->select($query);
        return $result;
    }

    public function insert_cart($user_id, $product_id) {
        $show_cart = $this->show_cart($user_id, $product_id);
        if (!$show_cart || mysqli_num_rows($show_cart) == 0) {
            $query = "INSERT INTO `tbl_cart` (`user_id`, `product_id`, `quantity`)
            VALUES ('$user_id', '$product_id', '1')";
            $result = $this ->db->insert($query);
        } else {
            $row = mysqli_fetch_assoc($show_cart);
            $new_quantity = $row['quantity'] + 1;
            $query = "UPDATE `tbl_cart` SET `quantity`='$new_quantity' 
            WHERE `user_id`='$user_id' AND `product_id`='$product_id'";
            $result = $this ->db->update($query);
        }
    }

    public function update_cart($user_id, $product_id, $quantity) {       
        $query = "UPDATE `tbl_cart` SET `quantity`='$quantity' 
        WHERE `user_id`='$user_id' AND `product_id`='$product_id'";
        $result = $this ->db->update($query);
    }

    public function delete_cart($user_id, $product_id) {
        $query = "DELETE FROM `tbl_cart` 
        WHERE `user_id` = '$user_id' AND `product_id` = '$product_id'";
        $result = $this ->db->delete($query);
    }

    public function delete_cart_by_user($user_id) {
        $query = "DELETE FROM `tbl_cart` WHERE `user_id` = '$user_id'";
        $result = $this ->db->delete($query);
    }
}