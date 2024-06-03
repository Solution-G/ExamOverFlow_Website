<?php
session_start();

// Destroy all session data
session_unset();
session_destroy();

// Remove the admin_id cookie by setting its expiration time in the past
setcookie('admin_id', '', time() - 3600, '/');

// Redirect to the login page or any other page as needed
header('location:admin_login.php');
exit();
?>