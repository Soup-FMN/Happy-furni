<?php

class review {
    private $db;

    public function __construct()
    {
        $this -> db = new Database();
    }

    public function show_review($product_id) {
        $query = "SELECT * FROM `tbl_review` a 
        INNER JOIN tbl_user b on a.user_id = b.id
        WHERE a.product_id = '$product_id'";
        $result = $this ->db->select($query);
        return $result;
    }

    public function insert_review($product_id, $user_id, $review_data) {
        $query = "INSERT INTO `tbl_review`(`product_id`, `user_id`, `review_data`) 
        VALUES ('$product_id','$user_id','$review_data')";
        $result = $this ->db->insert($query);
    }

    public function checkReview($product_id, $user_id) {
        $query = "SELECT * FROM tbl_review 
        WHERE `product_id` = '$product_id' AND `user_id` = '$user_id'";
        $result = $this ->db->select($query);

        if($result > 0) {
            return true;
        } else {
            return false;
        }
    }
}
?>