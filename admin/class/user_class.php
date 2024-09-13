<?php
include 'admin/database.php';
?>
<?php

class user {
    private $db;

    public function __construct()
    {
        $this -> db = new Database();
    }

    public function get_user($email, $password) {
        $query = "SELECT * FROM tbl_user WHERE `email`='$email' AND `password` = '$password'";
        $result = $this ->db->select($query);
        return $result;
    }

    public function get_user_by_email($email) {
        $query = "SELECT * FROM tbl_user WHERE email = '$email'";
        $result = $this ->db->select($query);
        return $result;
    }

    public function insert_user_clients_side($POST) {
        $email = $POST['email']; 
        $password = $POST['password']; 
        $name = $POST['name']; 
        $role = "user";

        $query = "INSERT INTO `tbl_user` (`email`, `password`, `name`, `role`)
        VALUES ('$email', '$password', '$name', '$role')";
        $result = $this ->db->select($query);
        return $result;
    }

        // public function insert_user($POST) {
        //     $email = $POST['email']; 
        //     $password = $POST['password']; 
        //     $name = $POST['name']; 
        //     $role = $POST['role']; 
    
        //     $query = "INSERT INTO `tbl_user` (`email`, `password`, `name`, `role`)
        //     VALUES ('$email', '$password', '$name', '$role',)";
        //     $result = $this ->db->insert($query);
        
        // }


    // public function show_category(){
    //     $query = "SELECT * FROM tbl_category ORDER BY category_id DESC";
    //     $result = $this ->db->select($query);
    //     return $result;
    // }
    // public function show_brand(){
    //     // $query = "SELECT * FROM tbl_brand ORDER BY brand_id DESC";
    //     $query = "SELECT tbl_brand.*, tbl_category.category_name
    //     FROM tbl_brand INNER JOIN tbl_category ON tbl_brand.category_id = tbl_category.category_id
    //     ORDER BY tbl_brand.brand_id DESC";
    //     $result = $this ->db->select($query);
    //     return $result;
    // }
    // public function insert_product(){

    //     $product_name = $_POST['product_name'];
    //     $category_id = $_POST['category_id'];
    //     $brand_id = $_POST['brand_id'];
    //     $product_price = $_POST['product_price'];
    //     $product_price_new = $_POST['product_price_new'];
    //     $product_desc = $_POST['product_desc'];
    //     $product_img = $_FILES['product_img']['name'];
    //     move_uploaded_file( $_FILES['product_img']['tmp_name'],"../uploads/".$_FILES['product_img']['name']);
    //     $query = "INSERT INTO tbl_product (
    //         product_name,
    //         category_id,
    //         brand_id,
    //         product_price,
    //         product_price_new,
    //         product_desc,
    //         product_img)
    //         VALUES (
    //             '$product_name',
    //             '$category_id',
    //             '$brand_id',
    //             '$product_price',
    //             '$product_price_new',
    //             '$product_desc',
    //             '$product_img')";
    //     $result = $this ->db->insert($query);
    //     // header('location:brand_show.php');
    //     return $result;
    // }

    // public function get_brand($brand_id) {
    //     $query = "SELECT * FROM tbl_brand WHERE brand_id = '$brand_id'";
    //     $result = $this ->db->select($query);
    //     return $result;
    // }
    // public function update_brand($category_id,$brand_name,$brand_id) {
    //     $query = "UPDATE tbl_brand SET brand_name = '$brand_name',category_id = '$category_id' WHERE brand_id = '$brand_id'";
    //     $result = $this ->db->update($query);
    //     header('location:brand_show.php');
    //     return $result;
    // }
    // public function delete_brand($brand_id) {
    //     $query = "DELETE FROM tbl_brand WHERE brand_id = '$brand_id' ";
    //     $result = $this ->db->delete($query);
    //     header('location:brand_show.php');
    //     return $result;
    // }
}

?>