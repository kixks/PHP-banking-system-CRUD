<?php
// Initialize the session
session_start();
 
// Unset all of the session variables

$_SESSION['client_login'] = false;
unset($_SESSION['name']);
unset($_SESSION['account_number']);

// Redirect to login page
header("location: LoginPage.php");
exit;
?>
