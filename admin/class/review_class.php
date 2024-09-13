<?php

class review
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function show_review() {
        $query = "SELECT a.*, b.name, c.product_name
        FROM tbl_review a
        INNER JOIN tbl_user b on a.user_id = b.id
        INNER JOIN tbl_product c on a.product_id = c.product_id
        ORDER BY a.product_id";
        $result = $this ->db->select($query);
        return $result;
    }

    public function delete_review($product_id, $user_id) {
        $query = "DELETE FROM `tbl_review`
        WHERE `product_id` = '$product_id' AND `user_id` = '$user_id'";
        $result = $this ->db->delete($query);
        header('location:review_show.php');
    }

}