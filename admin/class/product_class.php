<?php
// include "../database.php";
?>

<?php

class product {
    private $db;

    public function __construct()
    {
        $this -> db = new Database();
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
    public function insert_product(){
        $product_name = $_POST['product_name'];
        $category_id = $_POST['category_id'];
        $brand_id = $_POST['brand_id'];
        $product_price = $_POST['product_price'];
        $product_price_new = $_POST['product_price_new'];
        $product_desc = $_POST['product_desc'];
        $product_img = $_FILES['product_img']['name'];
        move_uploaded_file( $_FILES['product_img']['tmp_name'],"../uploads/".$_FILES['product_img']['name']);
        $query = "INSERT INTO tbl_product (
            product_name,
            category_id,
            brand_id,
            product_price,
            product_price_new,
            product_desc,
            product_img)
            VALUES (
                '$product_name',
                '$category_id',
                '$brand_id',
                '$product_price',
                '$product_price_new',
                '$product_desc',
                '$product_img')";
        $result = $this ->db->insert($query);
        if($result){
            $query = "SELECT * FROM tbl_product ORDER BY product_id DESC LIMIT 1";
            $result = $this ->db->select($query) ->fetch_assoc();
            $product_id = $result['product_id'];
            $filename = $_FILES['product_img_desc']['name'];
            $filetmp = $_FILES['product_img_desc']['tmp_name'];

            foreach ($filename as $key => $value)
            {
                move_uploaded_file( $filetmp[$key],"../uploads/".$value);
                $query = "INSERT INTO tbl_product_img_desc (product_id, product_img_desc) VALUE ('$product_id','$value')";
                $result = $this ->db->insert($query);
            }
        }

        header('location:product_show.php');
        return $result;
    }

    public function show_product() {
        $query = "SELECT a.*, b.brand_name, c.category_name
        FROM tbl_product a
        INNER JOIN tbl_brand b on a.brand_id = b.brand_id
        INNER JOIN tbl_category c on a.category_id = c.category_id
        ORDER BY a.category_id, a.brand_id";
        $result = $this ->db->select($query);
        return $result;
    }

    public function get_product_only($product_id) {
        $query = "SELECT * FROM tbl_product
        WHERE product_id = '$product_id'";
        $result = $this ->db->select($query);
        return $result;
    }


    public function get_product_img($product_id) {
        $query = "SELECT * FROM tbl_product
        WHERE product_id = '$product_id'";
        $result = $this ->db->select($query);
        return $result;
    }


    public function get_product_img_desc($product_id) {
        $query = "SELECT * FROM tbl_product_img_desc 
        WHERE product_id = '$product_id'";
        $result = $this ->db->select($query);
        return $result;
    }

    public function show_product_litmit($limit_number) {
        $query = "SELECT a.*, b.brand_name, c.category_name, d.product_img_desc
        FROM tbl_product a
        INNER JOIN tbl_brand b on a.brand_id = b.brand_id
        INNER JOIN tbl_category c on a.category_id = c.category_id
        INNER JOIN tbl_product_img_desc d on a.product_id = d.product_id
        ORDER BY a.product_id, a.category_id, a.brand_id LIMIT ".$limit_number;
        $result = $this ->db->select($query);
        return $result;
    }

    public function show_product_shop($limit_number_products_show) {
        $query = "SELECT a.*, b.brand_name, c.category_name, d.product_img_desc
        FROM tbl_product a
        INNER JOIN tbl_brand b on a.brand_id = b.brand_id
        INNER JOIN tbl_category c on a.category_id = c.category_id
        INNER JOIN tbl_product_img_desc d on a.product_id = d.product_id
        ORDER BY a.product_id, a.category_id, a.brand_id LIMIT ".$limit_number_products_show;
        $result = $this ->db->select($query);
        return $result;
    }

    public function show_product_by_category($category_id) {
        $limit_number_products_show = 16;
        $query = "SELECT tbl_product.*, tbl_category.category_name, tbl_product_img_desc.product_img_desc
        FROM tbl_product
        JOIN tbl_category on tbl_product.category_id = tbl_category.category_id
        JOIN tbl_product_img_desc on tbl_product.product_id = tbl_product_img_desc.product_id
        WHERE tbl_category.category_id = $category_id LIMIT ".$limit_number_products_show;
        $result = $this ->db->select($query);
        return $result;
    }

    public function show_product_by_brand($brand_id) {
        $limit_number_products_show = 8;
        $query = "SELECT tbl_product.*, tbl_brand.brand_name, tbl_product_img_desc.product_img_desc,tbl_category.category_name
        FROM tbl_product
        JOIN tbl_brand on tbl_product.brand_id = tbl_brand.brand_id
        JOIN tbl_category on tbl_product.category_id = tbl_category.category_id
        JOIN tbl_product_img_desc on tbl_product.product_id = tbl_product_img_desc.product_id
        WHERE tbl_brand.brand_id = $brand_id LIMIT ".$limit_number_products_show;
        $result = $this ->db->select($query);
        return $result;
    }

    public function GetDataByID($product_id) {
        $query = "SELECT * FROM tbl_product a
        INNER JOIN tbl_brand b ON a.brand_id = b.brand_id
        INNER JOIN tbl_category c ON a.category_id = c.category_id
        WHERE product_id = '$product_id'";
        $result = $this ->db->select($query);
        return $result;
    }

    public function update_product($product_id){
        $product_name = $_POST['product_name'];
        $category_id = $_POST['category_id'];
        $brand_id = $_POST['brand_id'];
        $product_price = $_POST['product_price'];
        $product_price_new = $_POST['product_price_new'];
        $product_desc = $_POST['product_desc'];
        $product_img = $_FILES['product_img']['name'];
        move_uploaded_file( $_FILES['product_img']['tmp_name'],"../uploads/".$_FILES['product_img']['name']);
        $query = "UPDATE `tbl_product` SET 
        `category_id`='$category_id',`brand_id`='$brand_id',
        `product_name`='$product_name',`product_price`='$product_price',
        `product_price_new`='$product_price_new',
        `product_desc`='$product_desc',`product_img`='$product_img' 
        WHERE `product_id`='$product_id'";
        $result = $this ->db->update($query);
        if($result){
            $GetDataImg_desc = $this->GetDataImg_desc($product_id);
            $row = mysqli_fetch_all($GetDataImg_desc);
            $filename = $_FILES['product_img_desc']['name'];
            $filetmp = $_FILES['product_img_desc']['tmp_name'];
            for($i = 0; $i < count($filename); $i++) {
                move_uploaded_file($filetmp[$i], "../uploads/".$filename[$i]);
                $query = "UPDATE `tbl_product_img_desc` 
                SET `product_img_desc`='$filename[$i]' 
                WHERE `product_id`='$product_id' AND `id_prd`=".$row[$i][2]."";
                $result = $this ->db->update($query);
            }
        }

        header('location:product_show.php');
        return $result;
    }
    public function GetDataImg_desc($product_id) {
        $query = "SELECT * FROM tbl_product_img_desc 
        WHERE product_id = '$product_id'";
        $result = $this ->db->select($query);
        return $result;
    }

    public function GetDataByImg_desc($product_img_desc) {
        $query = "SELECT * FROM `tblproduct_img_desc` a 
        WHERE a.product_img_desc = '$product_img_desc'";
        $result = $this ->db->select($query);
        return $result;
    }

    public function delete_product($product_id) {
        
        // PRODUCT_IMG_DESC
        $query = "DELETE FROM `tbl_product_img_desc` 
        WHERE product_id = '$product_id'";
        $result = $this ->db->delete($query);
        
        // PRODUCT
        $query = "DELETE FROM `tbl_product` WHERE `product_id` = '$product_id'";
        $result = $this ->db->delete($query);   
        
        header('location:product_show.php');
    }


    // public function show_product_by_category($category_id) {
    //     $query = "SELECT * FROM tbl_product WHERE (category_id) = ('$category_id')";
    //     $result = $this ->db->select($query);
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