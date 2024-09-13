<?php
class wishlist {
    private $db;

    public function __construct()
    {
        $this -> db = new Database();
    }

    public function insert_wishlist($user_id, $product_id) {
        $query = "INSERT INTO `tbl_wishlist` (`user_id`, `product_id`)
        VALUES ('$user_id', '$product_id')";
        $result = $this ->db->insert($query);
    }

    public function show_wishlist($user_id, $product_id) {
        $query = "SELECT * FROM wishlist 
        WHERE `user_id` = '$user_id' AND `product_id` = '$product_id'";
        $result = $this ->db->select($query);
        return $result;
    }

    public function show_wishlist_detail($user_id) {
        $query = "SELECT a.user_id, b.* FROM `tbl_wishlist` a
        INNER JOIN tbl_product b ON a.product_id = b.product_id
        WHERE a.user_id = '$user_id'";
        $result = $this ->db->select($query);
        return $result;
    }

    public function delete_wishlist($user_id, $product_id) {
        $query = "DELETE FROM `tbl_wishlist` 
        WHERE `user_id` = '$user_id' AND `product_id` = '$product_id'";
        $result = $this ->db->delete($query);
    }

}