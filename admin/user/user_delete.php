<?php
include "../layouts/header.php";
include "../layouts/slider.php";
include "../database.php";
include "../class/user_manager_class.php";
?>
<?php
$user = new user;

if($_GET['id'] == NULL || !isset($_GET['id'])) {
    echo "<script> window.location = 'user_show.php' </script>";
} else {
    $id = $_GET['id'];
}

$user->delete_user($id);

?>