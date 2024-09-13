<?php
session_start();
include "../../admin/database.php";
include "../class/review_class.php";
?>
<?php
if(!isset($_SESSION['email']) || $_SESSION['email'] == NULL) {
    echo "<script>alert('Please Login') </script>"; 
    echo "<script> window.location.href='/PHP/happy-furni-php/index.php?page=login-register'</script>";
} else {
    $review = new review;
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['id'];
    $review_data = $_POST['review_data'];

    $checkReview = $review->checkReview($product_id, $user_id);
    if($checkReview) {
        echo "<script>
        alert('You have reviewed on this product ❗')</script>"; 
        echo "<script>window.location.href = '/PHP/happy-furni-php/?page=details&product_id=".$product_id."'
        </script>"; 
    } else {
        $review->insert_review($product_id, $user_id, $review_data);
        echo "<script>alert('Review Successfully ☑️') </script>"; 
        echo "<script>window.location.href = '/PHP/happy-furni-php/?page=details&product_id=".$product_id."'
        </script>"; 
    }
}
?>