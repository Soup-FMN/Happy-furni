<?php
session_start();
include "../admin/database.php";
include "class/user_class.php";
?>
<?php
$user = new user;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $biensualoi = $user->get_user($_POST['email'], $_POST['password']);
    if ($biensualoi && mysqli_num_rows($biensualoi) > 0) {
        $result = mysqli_fetch_assoc($biensualoi);
        $_SESSION["id"] = $result['id'];
        $_SESSION["email"] = $result['email'];
        $_SESSION["name"] = $result['name'];
        $_SESSION["role"] = $result['role'];
        echo "<script>alert('️🎉 Login Successfully ️🎉')</script>";
        echo "<script> window.location.href='/PHP/happy-furni-php/index.php'</script>";
    } else {
        echo "<script>alert('Account or Password is incorrect ❗')</script>";
        echo "<script> window.location.href='/PHP/happy-furni-php/index.php?page=login-register'</script>";
    }
}
?>