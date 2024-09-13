<?php
include "../admin/database.php";
include "class/user_class.php";
?>
<?php
$user = new user;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['confirm_password'] == $_POST['password']) {
        $checkRegister = $user->get_user_by_email($_POST['email']);
        if ($checkRegister) {
            echo "<script>alert('Email này đã được đăng ký')</script>";
        } else {
            $result = $user->insert_user_clients_side($_POST);
        }
        echo "<script>alert('Registered successfully 💟') </script>";
        echo "<script> window.location.href='/PHP/happy-furni-php/index.php?page=login-register'</script>";
    } else {
        echo '<script>alert("Confirmation password does not match ❗")</script>';
        echo "<script> window.location.href='/PHP/happy-furni-php/index.php?page=login-register'</script>";
    }
}
?>