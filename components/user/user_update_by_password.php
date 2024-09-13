<?php
session_start();
include "../../admin/database.php";
include "../class/user_class.php";
?>
<?php
if (!isset($_SESSION['email']) || $_SESSION['email'] == NULL) {
    echo "<script>alert('Please Login') </script>";
    echo "<script> window.location.href='/PHP/happy-furni-php/index.php?page=accounts'</script>";
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new user;
    $new_password = $_POST['new_password'];
    if ($_POST['confirm_password'] == $new_password) {
        $checkOldpassword = $user->get_user_by_password($_SESSION['email'], $_POST['password']);
        if ($checkOldpassword) {
            $result = $user->update_user_by_password($_SESSION['email'], $new_password);
            echo "<script>alert('Update Password Successfuly ☑️') </script>";
        } else {
            echo "<script>alert('Curently Password Incorrect ❗') </script>";
        }
    } else {
        echo "<script>alert('New and Confirm Password do not match ❗') </script>";
    }
    echo "<script> window.location.href='/PHP/happy-furni-php/index.php?page=accounts'</script>";
}
?>