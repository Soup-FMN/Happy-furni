<?php

class order {
    private $db;

    public function __construct()
    {
        $this -> db = new Database();
    }

    public function show_order() {
        $query = "SELECT tbl_order.*, tbl_user.name AS user_name 
        FROM tbl_order
        JOIN tbl_user ON tbl_order.user_id = tbl_user.id" ;
        $result = $this->db->select($query);
        return $result;
    }

    public function get_order_by_id($id) {
        $query = "SELECT * FROM tbl_order WHERE `id` = ".$id;
        $result = $this->db->select($query);
        return $result;
    }

    public function update_order($id, $POST) {
        $status= $POST['status']; 
        $query = "UPDATE `tbl_order` SET
        `status` = '$status'
        WHERE `id`='$id'";
        $result = $this->db->update($query);
        header('location:order_show.php');
    }

    public function delete_order($id) {
        $query = "DELETE FROM `tbl_order` WHERE `id` = ".$id;
        $result = $this->db->delete($query);
        header('location:order_show.php');
    }
}
?>