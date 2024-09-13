<?php
include "../layouts/header.php";
include "../layouts/slider.php";
include "../database.php";
include "../class/review_class.php";
?>
<?php
    $review = new review;

    if((isset($_GET['product_id']) || !($_GET['product_id'] == NULL)) &&
    isset($_GET['product_id']) || !($_GET['product_id'] == NULL)) {
        $product_id = $_GET['product_id'];
        $user_id = $_GET['user_id'];
        $review->delete_review($product_id, $user_id);
    } else {
        echo "<script> window.location.href='review_show.php' </script>";
    }
?>