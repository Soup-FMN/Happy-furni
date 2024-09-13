<?php
session_start();

Session_destroy();
echo "<script>alert('Logout Successfully ☑️')</script>";
echo "<script> window.location.href='/PHP/happy-furni-php/index.php?page=login-register'</script>";
?>

