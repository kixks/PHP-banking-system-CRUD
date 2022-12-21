<?php

// Initialize the session
session_start();
// Unset all of the session variables
unset($_SESSION['admin_login']);
unset($_SESSION['admin_name']);
unset($_SESSION['admin_username']);
unset($_SESSION['application_num']);
unset($_SESSION['pend_count']);
unset($_SESSION['user_count']);

// Redirect to login page
header("Location: admin_login.php");
exit;

?>