<?php

class user
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }


    public function insert_user($POST)
    {
        $email = $POST['email'];
        $password = $POST['password'];
        $name = $POST['name'];
        $role = $POST['role'];

        $query = "INSERT INTO `tbl_user` (`email`, `password`, `name`, `role`)
            VALUES ('$email', '$password', '$name', '$role')";
        $result = $this->db->insert($query);
        header('location:user_show.php');
    }

    public function show_user() {
        $query = "SELECT * FROM tbl_user";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_data_by_id($id) {
        $query = "SELECT * FROM tbl_user WHERE `id` = ".$id;
        $result = $this->db->select($query);
        return $result;
    }

    public function update_user($id, $POST) {
        $email = $POST['email']; 
        $password = $POST['password']; 
        $name = $POST['name']; 
        $role = $POST['role']; 
        $query = "UPDATE `tbl_user` SET
        `email` = '$email',
        `password` = '$password',
        `name` = '$name',
        `role` = '$role'
        WHERE `id`='$id'";
        $result = $this->db->update($query);
        header('location:user_show.php');
    }


    public function delete_user($id) {
        $query = "DELETE FROM `tbl_user` WHERE `id` = ".$id;
        $result = $this->db->delete($query);
        header('location:user_show.php');
    }

}
