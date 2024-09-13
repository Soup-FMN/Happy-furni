<?php
// include "../database.php";
?>

<?php

class brand {
    private $db;

    public function __construct()
    {
        $this -> db = new Database();
    }
    public function insert_brand($category_id,$brand_name){
        $query = "INSERT INTO tbl_brand (category_id,brand_name) VALUES ('$category_id','$brand_name')";
        $result = $this ->db->insert($query);
        header('location:brand_show.php');
        return $result;
    }
    public function show_category(){
        $query = "SELECT * FROM tbl_category ORDER BY category_id DESC";
        $result = $this ->db->select($query);
        return $result;
    }
    public function show_brand(){
        $query = "SELECT * FROM tbl_brand ORDER BY brand_id";
        $result = $this ->db->select($query);
        return $result;
    }
    public function get_brand($brand_id) {
        $query = "SELECT * FROM tbl_brand WHERE brand_id = '$brand_id'";
        $result = $this ->db->select($query);
        return $result;
    }
    public function update_brand($category_id,$brand_name,$brand_id) {
        $query = "UPDATE tbl_brand SET brand_name = '$brand_name',category_id = '$category_id' WHERE brand_id = '$brand_id'";
        $result = $this ->db->update($query);
        header('location:brand_show.php');
        return $result;
    }
    public function delete_brand($brand_id) {
        $query = "DELETE FROM tbl_brand WHERE brand_id = '$brand_id' ";
        $result = $this ->db->delete($query);
        header('location:brand_show.php');
        return $result;
    }
}

?>