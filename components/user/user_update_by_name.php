<?php
session_start();
include "../../admin/database.php";
include "../class/user_class.php";
?>
<?php
if(!isset($_SESSION['email']) || $_SESSION['email'] == NULL) {
    echo "<script>alert('Please Login ❗') </script>"; 
    echo "<script> window.location.href='/PHP/happy-furni-php/index.php?page=accounts'</script>";
} else if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new user;
    $user_id = $_SESSION['id'];
    $name = $_POST['name'];

    $user->update_user_by_name($user_id, $name);
    echo "<script>alert('Update Name Successfuly ☑️') </script>"; 
    echo "<script> window.location.href='/PHP/happy-furni-php/index.php?page=accounts'</script>";
}
?>