<?php
$DB_SERVER = "localhost";
$DB_USER = "root";
$DB_PASS = "";
$DB = "banking_db";
$conn = new mysqli($DB_SERVER, $DB_USER, $DB_PASS, $DB);
if ($conn->connect_error) {
	die('connection failes' . $conn->connect_error);
} 
?>
