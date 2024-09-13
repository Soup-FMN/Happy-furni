<?php
// include "../admin/database.php";
class count {
    private $db;

    public function __construct()
    {
        $this -> db = new Database();
    }

    public function count_cart($user_id) {
        $query = "SELECT COUNT(product_id) as 'number' FROM `tbl_cart` 
        WHERE `user_id` = ".$user_id;
        $result = $this ->db->select($query);
        return $result;
    }

    public function count_wishlist($user_id) {
        $query = "SELECT COUNT(product_id) as 'number' FROM `tbl_wishlist` 
        WHERE `user_id` = ".$user_id;
        $result = $this ->db->select($query);
        return $result;
    }
}