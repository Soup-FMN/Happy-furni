<?php

class category {
    private $db;

    public function __construct()
    {
        $this -> db = new Database();
    }
    public function insert_category(){
        $category_name = $_POST['category_name'];
        $category_img = $_FILES['category_img']['name'];
        move_uploaded_file( $_FILES['category_img']['tmp_name'],"../uploads/".$_FILES['category_img']['name']);
        $query = "INSERT INTO tbl_category (
            category_name, 
            category_img) 
            VALUES (
                '$category_name',
                '$category_img')";
        $result = $this ->db->insert($query);
        header('location:category_show.php');
        return $result;
    }
    public function show_category(){
        $query = "SELECT * FROM tbl_category ORDER BY category_id";
        $result = $this ->db->select($query);
        return $result;
    }
    public function get_category($category_id) {
        $query = "SELECT * FROM tbl_category WHERE category_id = '$category_id'";
        $result = $this ->db->select($query);
        return $result;
    }
    public function update_category($category_name,$category_id) {
        $query = "UPDATE tbl_category SET category_name = '$category_name' WHERE category_id = '$category_id'";
        $result = $this ->db->update($query);
        header('location:category_show.php');
        return $result;
    }
    public function delete_category($category_id) {
        $query = "DELETE FROM tbl_category WHERE category_id = '$category_id' ";
        $result = $this ->db->delete($query);
        header('location:category_show.php');
        return $result;
    }
 
}

?>